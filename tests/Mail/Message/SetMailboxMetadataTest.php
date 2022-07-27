<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\SetMailboxMetadataEnvelope;
use Zimbra\Mail\Message\SetMailboxMetadataBody;
use Zimbra\Mail\Message\SetMailboxMetadataRequest;
use Zimbra\Mail\Message\SetMailboxMetadataResponse;

use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetMailboxMetadata.
 */
class SetMailboxMetadataTest extends ZimbraTestCase
{
    public function testSetMailboxMetadata()
    {
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);

        $request = new SetMailboxMetadataRequest($meta);
        $this->assertSame($meta, $request->getMetadata());
        $request = new SetMailboxMetadataRequest(new MailCustomMetadata());
        $request->setMetadata($meta);
        $this->assertSame($meta, $request->getMetadata());

        $response = new SetMailboxMetadataResponse();

        $body = new SetMailboxMetadataBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetMailboxMetadataBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetMailboxMetadataEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetMailboxMetadataEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetMailboxMetadataRequest>
            <urn:meta section="$section">
                <urn:a n="$key">$value</urn:a>
            </urn:meta>
        </urn:SetMailboxMetadataRequest>
        <urn:SetMailboxMetadataResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetMailboxMetadataEnvelope::class, 'xml'));
    }
}
