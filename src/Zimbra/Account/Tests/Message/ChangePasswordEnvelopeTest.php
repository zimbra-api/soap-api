<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ChangePasswordEnvelope;
use Zimbra\Account\Message\ChangePasswordBody;
use Zimbra\Account\Message\ChangePasswordRequest;
use Zimbra\Account\Message\ChangePasswordResponse;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for ChangePasswordEnvelope.
 */
class ChangePasswordEnvelopeTest extends ZimbraStructTestCase
{
    public function testChangePasswordEnvelope()
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
            $virtualHost
        );
        $response = new ChangePasswordResponse(
            $authToken,
            $lifetime
        );
        $body = new ChangePasswordBody($request, $response);

        $envelope = new ChangePasswordEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ChangePasswordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:ChangePasswordRequest>'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<oldPassword>' . $oldPassword . '</oldPassword>'
                        . '<password>' . $newPassword . '</password>'
                        . '<virtualHost>' . $virtualHost . '</virtualHost>'
                    . '</urn:ChangePasswordRequest>'
                    . '<urn:ChangePasswordResponse>'
                        . '<authToken>' . $authToken . '</authToken>'
                        . '<lifetime>' . $lifetime . '</lifetime>'
                    . '</urn:ChangePasswordResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ChangePasswordEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ChangePasswordRequest' => [
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ChangePasswordEnvelope::class, 'json'));
    }
}
