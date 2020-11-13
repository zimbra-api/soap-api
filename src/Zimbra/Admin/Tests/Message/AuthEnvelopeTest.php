<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AuthEnvelope;
use Zimbra\Admin\Message\AuthBody;
use Zimbra\Admin\Message\AuthRequest;
use Zimbra\Admin\Message\AuthResponse;
use Zimbra\Enum\AccountBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthEnvelope.
 */
class AuthEnvelopeTest extends ZimbraStructTestCase
{
    public function testAuthEnvelope()
    {
        $name = $this->faker->word;
        $password = $this->faker->uuid;
        $value = $this->faker->word;
        $authToken = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $csrfToken = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new AuthRequest(
            $name,
            $password,
            $authToken,
            $account,
            $virtualHost,
            TRUE,
            TRUE,
            $twoFactorCode
        );
        $response = new AuthResponse(
            $authToken,
            $csrfToken,
            $lifetime
        );
        $body = new AuthBody($request, $response);

        $envelope = new AuthEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true" csrfTokenSecured="true">'
                        . '<authToken>' . $authToken . '</authToken>'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<virtualHost>' . $virtualHost . '</virtualHost>'
                        . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
                    . '</urn:AuthRequest>'
                    . '<urn:AuthResponse>'
                        . '<authToken>' . $authToken . '</authToken>'
                        . '<csrfToken>' . $csrfToken . '</csrfToken>'
                        . '<lifetime>' . $lifetime . '</lifetime>'
                    . '</urn:AuthResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AuthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AuthRequest' => [
                    'name' => $name,
                    'password' => $password,
                    'authToken' => [
                        '_content' => $authToken,
                    ],
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $value,
                    ],
                    'virtualHost' => [
                        '_content' => $virtualHost,
                    ],
                    'persistAuthTokenCookie' => TRUE,
                    'csrfTokenSecured' => TRUE,
                    'twoFactorCode' => [
                        '_content' => $twoFactorCode,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AuthResponse' => [
                    'authToken' => [
                        '_content' => $authToken,
                    ],
                    'csrfToken' => [
                        '_content' => $csrfToken,
                    ],
                    'lifetime' => [
                        '_content' => $lifetime,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AuthEnvelope::class, 'json'));
    }
}
