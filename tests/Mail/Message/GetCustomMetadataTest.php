<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\SectionAttr;

use Zimbra\Mail\Message\GetCustomMetadataEnvelope;
use Zimbra\Mail\Message\GetCustomMetadataBody;
use Zimbra\Mail\Message\GetCustomMetadataRequest;
use Zimbra\Mail\Message\GetCustomMetadataResponse;

use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetCustomMetadata.
 */
class GetCustomMetadataTest extends ZimbraTestCase
{
    public function testGetCustomMetadata()
    {
        $id = $this->faker->uuid;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new SectionAttr($section);
        $request = new GetCustomMetadataRequest($id, $meta);
        $this->assertSame($id, $request->getId());
        $this->assertSame($meta, $request->getMetadata());
        $request = new GetCustomMetadataRequest();
        $request->setId($id)
            ->setMetadata($meta);
        $this->assertSame($id, $request->getId());
        $this->assertSame($meta, $request->getMetadata());

        $meta = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $response = new GetCustomMetadataResponse($id, $meta);
        $this->assertSame($id, $response->getId());
        $this->assertSame($meta, $response->getMetadata());
        $response = new GetCustomMetadataResponse();
        $response->setId($id)
            ->setMetadata($meta);
        $this->assertSame($id, $response->getId());
        $this->assertSame($meta, $response->getMetadata());

        $body = new GetCustomMetadataBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetCustomMetadataBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetCustomMetadataEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetCustomMetadataEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetCustomMetadataRequest id="$id">
            <urn:meta section="$section" />
        </urn:GetCustomMetadataRequest>
        <urn:GetCustomMetadataResponse id="$id">
            <urn:meta section="$section">
                <urn:a n="$key">$value</urn:a>
            </urn:meta>
        </urn:GetCustomMetadataResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCustomMetadataEnvelope::class, 'xml'));
    }
}
