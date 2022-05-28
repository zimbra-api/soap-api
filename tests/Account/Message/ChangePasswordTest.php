<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

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
        $newPassword = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $authToken = $this->faker->word;
        $lifetime = mt_rand(1, 100);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new ChangePasswordRequest(
            $account,
            $oldPassword,
            $newPassword,
            $virtualHost,
            FALSE
        );
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($oldPassword, $request->getOldPassword());
        $this->assertSame($newPassword, $request->getPassword());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertFalse($request->isDryRun());

        $request = new ChangePasswordRequest(new AccountSelector(AccountBy::ID(), ''), '', '');
        $request->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($newPassword)
            ->setVirtualHost($virtualHost)
            ->setDryRun(TRUE);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($oldPassword, $request->getOldPassword());
        $this->assertSame($newPassword, $request->getPassword());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertTrue($request->isDryRun());

        $response = new ChangePasswordResponse(
            $authToken,
            $lifetime
        );
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());

        $response = new ChangePasswordResponse('', 0);
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

        $by = AccountBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ChangePasswordRequest>
            <account by="$by">$value</account>
            <oldPassword>$oldPassword</oldPassword>
            <password>$newPassword</password>
            <virtualHost>$virtualHost</virtualHost>
            <dryRun>true</dryRun>
        </urn:ChangePasswordRequest>
        <urn:ChangePasswordResponse>
            <authToken>$authToken</authToken>
            <lifetime>$lifetime</lifetime>
        </urn:ChangePasswordResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ChangePasswordEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ChangePasswordRequest' => [
                    'account' => [
                        'by' => $by,
                        '_content' => $value,
                    ],
                    'oldPassword' => [
                        '_content' => $oldPassword,
                    ],
                    'password' => [
                        '_content' => $newPassword,
                    ],
                    'virtualHost' => [
                        '_content' => $virtualHost,
                    ],
                    'dryRun' => [
                        '_content' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'ChangePasswordResponse' => [
                    'authToken' => [
                        '_content' => $authToken,
                    ],
                    'lifetime' => [
                        '_content' => $lifetime,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ChangePasswordEnvelope::class, 'json'));
    }
}
