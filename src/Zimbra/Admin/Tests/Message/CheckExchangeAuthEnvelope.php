<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckExchangeAuthBody;
use Zimbra\Admin\Message\CheckExchangeAuthEnvelope;
use Zimbra\Admin\Message\CheckExchangeAuthRequest;
use Zimbra\Admin\Message\CheckExchangeAuthResponse;
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Enum\AuthScheme;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckExchangeAuthEnvelope.
 */
class CheckExchangeAuthEnvelopeTest extends ZimbraStructTestCase
{
    public function testCheckExchangeAuthEnvelope()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $request = new CheckExchangeAuthRequest(
            new ExchangeAuthSpec($url, $user, $pass, AuthScheme::FORM(), $type)
        );
        $response = new CheckExchangeAuthResponse(
            $code,
            $message
        );
        $body = new CheckExchangeAuthBody($request, $response);

        $envelope = new CheckExchangeAuthEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckExchangeAuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckExchangeAuthRequest>'
                        . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
                    . '</urn:CheckExchangeAuthRequest>'
                    . '<urn:CheckExchangeAuthResponse>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                    . '</urn:CheckExchangeAuthResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckExchangeAuthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckExchangeAuthRequest' => [
                    'auth' => [
                        'url' => $url,
                        'user' => $user,
                        'pass' => $pass,
                        'scheme' => (string) AuthScheme::FORM(),
                        'type' => $type,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckExchangeAuthResponse' => [
                    'code' => [
                        '_content' => $code,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckExchangeAuthEnvelope::class, 'json'));
    }
}
