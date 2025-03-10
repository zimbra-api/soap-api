<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Message\ChangePasswordEnvelope;
use Zimbra\Account\Message\ChangePasswordBody;
use Zimbra\Account\Message\ChangePasswordRequest;
use Zimbra\Account\Message\ChangePasswordResponse;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for ChangePassword.
 */
class ChangePasswordTest extends ZimbraTestCase
{
    public function testChangePassword()
    {
        $value = $this->faker->word;
        $oldPassword = $this->faker->word;
        $newPassword = $this->faker->word;
        $virtualHost = $this->faker->domainName;
        $authToken = $this->faker->sha256;
        $lifetime = $this->faker->randomNumber;
        $account = new AccountSelector(AccountBy::NAME, $value);
        $token = new AuthToken($authToken, TRUE, $lifetime);

        $request = new ChangePasswordRequest(
            $account,
            $oldPassword,
            $newPassword,
            $virtualHost,
            FALSE,
            $token
        );
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($oldPassword, $request->getOldPassword());
        $this->assertSame($newPassword, $request->getPassword());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertFalse($request->isDryRun());
        $this->assertSame($token, $request->getAuthToken());

        $request = new ChangePasswordRequest(new AccountSelector());
        $request->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($newPassword)
            ->setVirtualHost($virtualHost)
            ->setDryRun(TRUE)
            ->setAuthToken($token);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($oldPassword, $request->getOldPassword());
        $this->assertSame($newPassword, $request->getPassword());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertTrue($request->isDryRun());
        $this->assertSame($token, $request->getAuthToken());

        $response = new ChangePasswordResponse(
            $authToken,
            $lifetime
        );
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());

        $response = new ChangePasswordResponse();
        $response->setAuthToken($authToken)
            ->setLifetime($lifetime);
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());

        $body = new ChangePasswordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ChangePasswordBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ChangePasswordEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ChangePasswordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $by = AccountBy::NAME->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ChangePasswordRequest>
            <urn:account by="$by">$value</urn:account>
            <urn:oldPassword>$oldPassword</urn:oldPassword>
            <urn:password>$newPassword</urn:password>
            <urn:virtualHost>$virtualHost</urn:virtualHost>
            <urn:dryRun>true</urn:dryRun>
            <urn:authToken verifyAccount="true" lifetime="$lifetime">$authToken</urn:authToken>
        </urn:ChangePasswordRequest>
        <urn:ChangePasswordResponse>
            <urn:authToken>$authToken</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
        </urn:ChangePasswordResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ChangePasswordEnvelope::class, 'xml'));
    }
}
