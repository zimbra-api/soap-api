<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateZimletBody;
use Zimbra\Admin\Message\CreateZimletEnvelope;
use Zimbra\Admin\Message\CreateZimletRequest;
use Zimbra\Admin\Message\CreateZimletResponse;
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateZimlet.
 */
class CreateZimletTest extends ZimbraStructTestCase
{
    public function testCreateZimlet()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $hasKeyword = $this->faker->word;

        $request = new CreateZimletRequest($name);
        $this->assertSame($name, $request->getName());

        $request = new CreateZimletRequest('');
        $request->setName($name)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $request->getName());

        $zimlet = new ZimletInfo($name, $id, [new Attr($key, $value)], $hasKeyword);
        $response = new CreateZimletResponse($zimlet);
        $this->assertSame($zimlet, $response->getZimlet());
        $response = new CreateZimletResponse(new ZimletInfo('', ''));
        $response->setZimlet($zimlet);
        $this->assertSame($zimlet, $response->getZimlet());

        $body = new CreateZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateZimletBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateZimletEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateZimletRequest name="$name">
            <a n="$key">$value</a>
        </urn:CreateZimletRequest>
        <urn:CreateZimletResponse>
            <zimlet name="$name" id="$id" hasKeyword="$hasKeyword">
            <a n="$key">$value</a>
        </zimlet>
        </urn:CreateZimletResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateZimletEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateZimletRequest' => [
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateZimletResponse' => [
                    'zimlet' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'hasKeyword' => $hasKeyword,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateZimletEnvelope::class, 'json'));
    }
}
