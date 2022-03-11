<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckAuthConfigBody;
use Zimbra\Admin\Message\CheckAuthConfigEnvelope;
use Zimbra\Admin\Message\CheckAuthConfigRequest;
use Zimbra\Admin\Message\CheckAuthConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckAuthConfig.
 */
class CheckAuthConfigTest extends ZimbraTestCase
{
    public function testCheckAuthConfig()
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
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());

        $request = new CheckAuthConfigRequest('', '');
        $request->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());

        $response = new CheckAuthConfigResponse(
            $code,
            $bindDn,
            $message
        );
        $this->assertSame($code, $response->getCode());
        $this->assertSame($bindDn, $response->getBindDn());
        $this->assertSame($message, $response->getMessage());

        $response = new CheckAuthConfigResponse('', '');
        $response->setCode($code)
            ->setBindDn($bindDn)
            ->setMessage($message);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($bindDn, $response->getBindDn());
        $this->assertSame($message, $response->getMessage());

        $body = new CheckAuthConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckAuthConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckAuthConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckAuthConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckAuthConfigRequest name="$name" password="$password">
            <a n="$key">$value</a>
        </urn:CheckAuthConfigRequest>
        <urn:CheckAuthConfigResponse>
            <code>$code</code>
            <bindDn>$bindDn</bindDn>
            <message>$message</message>
        </urn:CheckAuthConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;
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
                    'bindDn' => [
                        '_content' => $bindDn,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckAuthConfigEnvelope::class, 'json'));
    }
}
