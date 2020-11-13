<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckExchangeAuthBody;
use Zimbra\Admin\Message\CheckExchangeAuthRequest;
use Zimbra\Admin\Message\CheckExchangeAuthResponse;
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Enum\AuthScheme;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckExchangeAuthBody.
 */
class CheckExchangeAuthBodyTest extends ZimbraStructTestCase
{
    public function testCheckExchangeAuthBody()
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
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckExchangeAuthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckExchangeAuthRequest>'
                    . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
                . '</urn:CheckExchangeAuthRequest>'
                . '<urn:CheckExchangeAuthResponse>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                . '</urn:CheckExchangeAuthResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckExchangeAuthBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckExchangeAuthBody::class, 'json'));
    }
}
