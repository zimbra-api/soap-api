<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetAttributeInfoBody, GetAttributeInfoEnvelope, GetAttributeInfoRequest, GetAttributeInfoResponse};
use Zimbra\Admin\Struct\AttributeDescription;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAttributeInfo.
 */
class GetAttributeInfoTest extends ZimbraTestCase
{
    public function testGetAttributeInfo()
    {
        $name = $this->faker->word;
        $description = $this->faker->word;

        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);
        $entryTypes = $this->faker->word;

        $attr = new AttributeDescription($name, $description);

        $request = new GetAttributeInfoRequest($attrs, $entryTypes);
        $this->assertSame($attrs, $request->getAttrs());
        $this->assertSame($entryTypes, $request->getEntryTypes());

        $request = new GetAttributeInfoRequest();
        $request->setAttrs($attrs)
            ->setEntryTypes($entryTypes);
        $this->assertSame($attrs, $request->getAttrs());
        $this->assertSame($entryTypes, $request->getEntryTypes());

        $response = new GetAttributeInfoResponse([$attr]);
        $this->assertSame([$attr], $response->getAttrs());
        $response = new GetAttributeInfoResponse();
        $response->setAttrs([$attr]);
        $this->assertSame([$attr], $response->getAttrs());

        $body = new GetAttributeInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAttributeInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAttributeInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAttributeInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAttributeInfoRequest attrs="$attrs" entryTypes="$entryTypes" />
        <urn:GetAttributeInfoResponse>
            <urn:a n="$name" desc="$description" />
        </urn:GetAttributeInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAttributeInfoEnvelope::class, 'xml'));
    }
}
