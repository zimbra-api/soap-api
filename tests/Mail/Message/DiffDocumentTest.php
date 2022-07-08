<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\DiffDocumentEnvelope;
use Zimbra\Mail\Message\DiffDocumentBody;
use Zimbra\Mail\Message\DiffDocumentRequest;
use Zimbra\Mail\Message\DiffDocumentResponse;

use Zimbra\Mail\Struct\DiffDocumentVersionSpec;
use Zimbra\Mail\Struct\DispositionAndText;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DiffDocument.
 */
class DiffDocumentTest extends ZimbraTestCase
{
    public function testDiffDocument()
    {
        $id = $this->faker->uuid;
        $version1 = $this->faker->randomNumber;
        $version2 = $this->faker->randomNumber;
        $disposition = $this->faker->word;
        $text = $this->faker->text;

        $doc = new DiffDocumentVersionSpec($id, $version1, $version2);
        $request = new DiffDocumentRequest($doc);
        $this->assertSame($doc, $request->getDoc());
        $request = new DiffDocumentRequest();
        $request->setDoc($doc);
        $this->assertSame($doc, $request->getDoc());

        $chunk = new DispositionAndText($disposition, $text);
        $response = new DiffDocumentResponse([$chunk]);
        $this->assertSame([$chunk], $response->getChunks());
        $response = new DiffDocumentResponse();
        $response->setChunks([$chunk])->addChunk($chunk);
        $this->assertSame([$chunk, $chunk], $response->getChunks());
        $response->setChunks([$chunk]);

        $body = new DiffDocumentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DiffDocumentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DiffDocumentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DiffDocumentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DiffDocumentRequest>
            <urn:doc id="$id" v1="$version1" v2="$version2" />
        </urn:DiffDocumentRequest>
        <urn:DiffDocumentResponse>
            <urn:chunk disp="$disposition">$text</urn:chunk>
        </urn:DiffDocumentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DiffDocumentEnvelope::class, 'xml'));
    }
}
