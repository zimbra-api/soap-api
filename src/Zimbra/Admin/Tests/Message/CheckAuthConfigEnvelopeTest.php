<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckAuthConfigBody;
use Zimbra\Admin\Message\CheckAuthConfigEnvelope;
use Zimbra\Admin\Message\CheckAuthConfigRequest;
use Zimbra\Admin\Message\CheckAuthConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckAuthConfigEnvelope.
 */
class CheckAuthConfigEnvelopeTest extends ZimbraStructTestCase
{
    public function testCheckAuthConfigEnvelope()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;
        $code = $this->faker->uuid;
        $bindDn = $this->faker->uuid;
        $message = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $request = new CheckAuthConfigRequest(
            $name, $password, [$attr]
        );
        $response = new CheckAuthConfigResponse(
            $code,
            $bindDn,
            $message
        );
        $body = new CheckAuthConfigBody($request, $response);

        $envelope = new CheckAuthConfigEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckAuthConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CheckAuthConfigRequest>'
                    . '<urn:CheckAuthConfigResponse>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                        . '<bindDn>' . $bindDn . '</bindDn>'
                    . '</urn:CheckAuthConfigResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckAuthConfigEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckAuthConfigRequest' => [
                    'name' => $name,
                    'password' => $password,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckAuthConfigResponse' => [
                    'code' => [
                        '_content' => $code,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    'bindDn' => [
                        '_content' => $bindDn,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckAuthConfigEnvelope::class, 'json'));
    }
}
