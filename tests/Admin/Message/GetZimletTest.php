<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetZimletBody, GetZimletEnvelope, GetZimletRequest, GetZimletResponse};

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Common\Struct\NamedElement;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetZimlet.
 */
class GetZimletTest extends ZimbraTestCase
{
    public function testGetZimlet()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $hasKeyword = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);

        $zimlet = new NamedElement($name);
        $zimletInfo = new ZimletInfo($name, $id, [new Attr($key, $value)], $hasKeyword);

        $request = new GetZimletRequest($zimlet, $attrs);
        $this->assertSame($zimlet, $request->getZimlet());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetZimletRequest(new NamedElement(''));
        $request->setZimlet($zimlet)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($zimlet, $request->getZimlet());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetZimletResponse($zimletInfo);
        $this->assertSame($zimletInfo, $response->getZimlet());
        $response = new GetZimletResponse(new ZimletInfo('', ''));
        $response->setZimlet($zimletInfo);
        $this->assertSame($zimletInfo, $response->getZimlet());

        $body = new GetZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetZimletBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetZimletEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetZimletRequest attrs="$attrs">
            <zimlet name="$name" />
        </urn:GetZimletRequest>
        <urn:GetZimletResponse>
            <zimlet name="$name" id="$id" hasKeyword="$hasKeyword">
                <a n="$key">$value</a>
            </zimlet>
        </urn:GetZimletResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetZimletEnvelope::class, 'xml'));
    }
}
