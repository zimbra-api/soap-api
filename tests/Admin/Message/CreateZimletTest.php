<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateZimletBody;
use Zimbra\Admin\Message\CreateZimletEnvelope;
use Zimbra\Admin\Message\CreateZimletRequest;
use Zimbra\Admin\Message\CreateZimletResponse;
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateZimlet.
 */
class CreateZimletTest extends ZimbraTestCase
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

        $request = new CreateZimletRequest();
        $request->setName($name)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $request->getName());

        $zimlet = new ZimletInfo($name, $id, [new Attr($key, $value)], $hasKeyword);
        $response = new CreateZimletResponse($zimlet);
        $this->assertSame($zimlet, $response->getZimlet());
        $response = new CreateZimletResponse();
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
            <urn:a n="$key">$value</urn:a>
        </urn:CreateZimletRequest>
        <urn:CreateZimletResponse>
            <urn:zimlet name="$name" id="$id" hasKeyword="$hasKeyword">
                <urn:a n="$key">$value</urn:a>
            </urn:zimlet>
        </urn:CreateZimletResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateZimletEnvelope::class, 'xml'));
    }
}
