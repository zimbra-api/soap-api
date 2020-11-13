<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckAuthConfigBody;
use Zimbra\Admin\Message\CheckAuthConfigRequest;
use Zimbra\Admin\Message\CheckAuthConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckAuthConfigBody.
 */
class CheckAuthConfigBodyTest extends ZimbraStructTestCase
{
    public function testCheckAuthConfigBody()
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
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckAuthConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CheckAuthConfigRequest>'
                . '<urn:CheckAuthConfigResponse>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                    . '<bindDn>' . $bindDn . '</bindDn>'
                . '</urn:CheckAuthConfigResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckAuthConfigBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckAuthConfigBody::class, 'json'));
    }
}
