<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\SectionAttr;

use Zimbra\Mail\Message\GetMailboxMetadataEnvelope;
use Zimbra\Mail\Message\GetMailboxMetadataBody;
use Zimbra\Mail\Message\GetMailboxMetadataRequest;
use Zimbra\Mail\Message\GetMailboxMetadataResponse;

use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMailboxMetadata.
 */
class GetMailboxMetadataTest extends ZimbraTestCase
{
    public function testGetMailboxMetadata()
    {
        $section = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new SectionAttr($section);
        $request = new GetMailboxMetadataRequest($meta);
        $this->assertSame($meta, $request->getMetadata());
        $request = new GetMailboxMetadataRequest();
        $request->setMetadata($meta);
        $this->assertSame($meta, $request->getMetadata());

        $meta = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $response = new GetMailboxMetadataResponse($meta);
        $this->assertSame($meta, $response->getMetadata());
        $response = new GetMailboxMetadataResponse();
        $response->setMetadata($meta);
        $this->assertSame($meta, $response->getMetadata());

        $body = new GetMailboxMetadataBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetMailboxMetadataBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMailboxMetadataEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetMailboxMetadataEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMailboxMetadataRequest>
            <meta section="$section" />
        </urn:GetMailboxMetadataRequest>
        <urn:GetMailboxMetadataResponse>
            <meta section="$section">
                <a n="$key">$value</a>
            </meta>
        </urn:GetMailboxMetadataResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMailboxMetadataEnvelope::class, 'xml'));
    }
}
