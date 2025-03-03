<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\NewFileCreationTypes;
use Zimbra\Common\Struct\Id;

use Zimbra\Mail\Message\SaveDocumentEnvelope;
use Zimbra\Mail\Message\SaveDocumentBody;
use Zimbra\Mail\Message\SaveDocumentRequest;
use Zimbra\Mail\Message\SaveDocumentResponse;

use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Mail\Struct\MessagePartSpec;
use Zimbra\Mail\Struct\IdVersion;
use Zimbra\Mail\Struct\IdVersionName;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SaveDocument.
 */
class SaveDocumentTest extends ZimbraTestCase
{
    public function testSaveDocument()
    {
        $name = $this->faker->name;
        $contentType = $this->faker->word;
        $description = $this->faker->word;
        $folderId = $this->faker->word;
        $id = $this->faker->uuid;
        $version = $this->faker->randomNumber;
        $content = $this->faker->word;
        $flags = $this->faker->word;
        $action = $this->faker->word;
        $type = NewFileCreationTypes::DOCUMENT;
        $part = $this->faker->uuid;
        $nodeId = $this->faker->uuid;

        $upload = new Id($id);
        $messagePart = new MessagePartSpec($part, $id);
        $docRevision = new IdVersion($id, $version);
        $doc = new DocumentSpec(
            $name, $contentType, $description, $folderId, $id, $version, $content, TRUE, $flags, $action, $type, $upload, $messagePart, $docRevision, $nodeId
        );

        $request = new SaveDocumentRequest($doc);
        $this->assertSame($doc, $request->getDoc());
        $request = new SaveDocumentRequest(new DocumentSpec());
        $request->setDoc($doc);
        $this->assertSame($doc, $request->getDoc());

        $doc = new IdVersionName(
            $id, $version, $name
        );
        $response = new SaveDocumentResponse($doc);
        $this->assertSame($doc, $response->getDoc());
        $response = new SaveDocumentResponse();
        $response->setDoc($doc);
        $this->assertSame($doc, $response->getDoc());

        $body = new SaveDocumentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SaveDocumentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SaveDocumentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SaveDocumentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SaveDocumentRequest>
            <urn:doc name="$name" ct="$contentType" desc="$description" l="$folderId" id="$id" ver="$version" content="$content" descEnabled="true" f="$flags" action="$action" type="document" nodeId="$nodeId">
                <urn:upload id="$id" />
                <urn:m part="$part" id="$id" />
                <urn:doc id="$id" ver="$version" />
            </urn:doc>
        </urn:SaveDocumentRequest>
        <urn:SaveDocumentResponse>
            <urn:doc id="$id" ver="$version" name="$name" />
        </urn:SaveDocumentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SaveDocumentEnvelope::class, 'xml'));
    }
}
