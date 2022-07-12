<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\PurgeRevisionEnvelope;
use Zimbra\Mail\Message\PurgeRevisionBody;
use Zimbra\Mail\Message\PurgeRevisionRequest;
use Zimbra\Mail\Message\PurgeRevisionResponse;

use Zimbra\Mail\Struct\PurgeRevisionSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PurgeRevision.
 */
class PurgeRevisionTest extends ZimbraTestCase
{
    public function testPurgeRevision()
    {
        $id = $this->faker->uuid;
        $version = $this->faker->randomNumber;

        $revision = new PurgeRevisionSpec(
            $id, $version, TRUE
        );

        $request = new PurgeRevisionRequest($revision);
        $this->assertSame($revision, $request->getRevision());
        $request = new PurgeRevisionRequest(new PurgeRevisionSpec());
        $request->setRevision($revision);
        $this->assertSame($revision, $request->getRevision());

        $response = new PurgeRevisionResponse();

        $body = new PurgeRevisionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new PurgeRevisionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new PurgeRevisionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new PurgeRevisionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:PurgeRevisionRequest>
            <urn:revision id="$id" ver="$version" includeOlderRevisions="true" />
        </urn:PurgeRevisionRequest>
        <urn:PurgeRevisionResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, PurgeRevisionEnvelope::class, 'xml'));
    }
}
