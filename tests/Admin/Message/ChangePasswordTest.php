<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Account\Struct\AuthToken;
use Zimbra\Admin\Message\ChangePasswordEnvelope;
use Zimbra\Admin\Message\ChangePasswordBody;
use Zimbra\Admin\Message\ChangePasswordRequest;
use Zimbra\Admin\Message\ChangePasswordResponse;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ChangePassword.
 */
class ChangePasswordResponseTest extends ZimbraTestCase
{
    public function testChangePassword()
    {
        $name = $this->faker->word;
        $oldPassword = $this->faker->uuid;
        $password = $this->faker->uuid;
        $token = $this->faker->sha256;
        $virtualHost = $this->faker->word;
        $lifetime = $this->faker->randomNumber;

        $account = new AccountSelector(AccountBy::NAME, $name);
        $authToken = new AuthToken($token, TRUE, $lifetime);

        $request = new ChangePasswordRequest(
            $account,
            $oldPassword,
            $password,
            $virtualHost,
            FALSE,
            $authToken
        );
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($oldPassword, $request->getOldPassword());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertFalse($request->getDryRun());
        $this->assertSame($authToken, $request->getAuthToken());

        $request = new ChangePasswordRequest(new AccountSelector(AccountBy::ID, $name));
        $request->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($password)
            ->setVirtualHost($virtualHost)
            ->setDryRun(TRUE)
            ->setAuthToken($authToken);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($oldPassword, $request->getOldPassword());
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertTrue($request->getDryRun());
        $this->assertSame($authToken, $request->getAuthToken());

        $response = new ChangePasswordResponse(
            $token,
            $lifetime
        );
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());

        $response = new ChangePasswordResponse();
        $response->setAuthToken($token)
            ->setLifetime($lifetime);
        $this->assertSame($token, $response->getAuthToken());
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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ChangePasswordRequest>
            <urn:account by="name">$name</urn:account>
            <urn:oldPassword>$oldPassword</urn:oldPassword>
            <urn:password>$password</urn:password>
            <urn:virtualHost>$virtualHost</urn:virtualHost>
            <urn:dryRun>true</urn:dryRun>
            <urn:authToken verifyAccount="true" lifetime="$lifetime">$token</urn:authToken>
        </urn:ChangePasswordRequest>
        <urn:ChangePasswordResponse>
            <urn:authToken>$token</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
        </urn:ChangePasswordResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ChangePasswordEnvelope::class, 'xml'));
    }
}
