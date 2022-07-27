<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\SetCustomMetadataEnvelope;
use Zimbra\Mail\Message\SetCustomMetadataBody;
use Zimbra\Mail\Message\SetCustomMetadataRequest;
use Zimbra\Mail\Message\SetCustomMetadataResponse;

use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetCustomMetadata.
 */
class SetCustomMetadataTest extends ZimbraTestCase
{
    public function testSetCustomMetadata()
    {
        $id = $this->faker->uuid;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);

        $request = new SetCustomMetadataRequest($meta, $id);
        $this->assertSame($id, $request->getId());
        $this->assertSame($meta, $request->getMetadata());
        $request = new SetCustomMetadataRequest(new MailCustomMetadata());
        $request->setId($id)->setMetadata($meta);
        $this->assertSame($id, $request->getId());
        $this->assertSame($meta, $request->getMetadata());

        $response = new SetCustomMetadataResponse($id);
        $this->assertSame($id, $response->getId());
        $response = new SetCustomMetadataResponse();
        $response->setId($id);
        $this->assertSame($id, $response->getId());

        $body = new SetCustomMetadataBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetCustomMetadataBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetCustomMetadataEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetCustomMetadataEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetCustomMetadataRequest id="$id">
            <urn:meta section="$section">
                <urn:a n="$key">$value</urn:a>
            </urn:meta>
        </urn:SetCustomMetadataRequest>
        <urn:SetCustomMetadataResponse id="$id" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetCustomMetadataEnvelope::class, 'xml'));
    }
}
