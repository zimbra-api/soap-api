<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\ModifyMailboxMetadataEnvelope;
use Zimbra\Mail\Message\ModifyMailboxMetadataBody;
use Zimbra\Mail\Message\ModifyMailboxMetadataRequest;
use Zimbra\Mail\Message\ModifyMailboxMetadataResponse;

use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyMailboxMetadata.
 */
class ModifyMailboxMetadataTest extends ZimbraTestCase
{
    public function testModifyMailboxMetadata()
    {
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $request = new ModifyMailboxMetadataRequest($meta);
        $this->assertSame($meta, $request->getMetadata());
        $request = new ModifyMailboxMetadataRequest();
        $request->setMetadata($meta);
        $this->assertSame($meta, $request->getMetadata());

        $response = new ModifyMailboxMetadataResponse($meta);

        $body = new ModifyMailboxMetadataBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyMailboxMetadataBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyMailboxMetadataEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyMailboxMetadataEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyMailboxMetadataRequest>
            <urn:meta section="$section">
                <urn:a n="$key">$value</urn:a>
            </urn:meta>
        </urn:ModifyMailboxMetadataRequest>
        <urn:ModifyMailboxMetadataResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyMailboxMetadataEnvelope::class, 'xml'));
    }
}
