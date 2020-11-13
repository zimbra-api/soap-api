<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ChangePasswordBody;
use Zimbra\Account\Message\ChangePasswordRequest;
use Zimbra\Account\Message\ChangePasswordResponse;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePasswordBody.
 */
class ChangePasswordBodyTest extends ZimbraStructTestCase
{
    public function testChangePasswordBody()
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
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ChangePasswordBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAccount">'
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
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, ChangePasswordBody::class, 'xml'));

        $json = json_encode([
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
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, ChangePasswordBody::class, 'json'));
    }
}
