<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ImportContactsEnvelope;
use Zimbra\Mail\Message\ImportContactsBody;
use Zimbra\Mail\Message\ImportContactsRequest;
use Zimbra\Mail\Message\ImportContactsResponse;

use Zimbra\Mail\Struct\Content;
use Zimbra\Mail\Struct\ImportContact;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImportContacts.
 */
class ImportContactsTest extends ZimbraTestCase
{
    public function testImportContacts()
    {
        $contentType = $this->faker->word;
        $folderId = $this->faker->word;
        $csvFormat = $this->faker->word;
        $csvLocale = $this->faker->word;
        $attachUploadId = $this->faker->word;
        $value = $this->faker->text;
        $listOfCreatedIds = $this->faker->word;
        $numImported = $this->faker->randomNumber;

        $content = new Content($attachUploadId, $value);
        $request = new ImportContactsRequest($content, $contentType, $folderId, $csvFormat, $csvLocale);
        $this->assertSame($content, $request->getContent());
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($csvFormat, $request->getCsvFormat());
        $this->assertSame($csvLocale, $request->getCsvLocale());
        $request = new ImportContactsRequest(new Content());
        $request->setContent($content)
            ->setContentType($contentType)
            ->setFolderId($folderId)
            ->setCsvFormat($csvFormat)
            ->setCsvLocale($csvLocale);
        $this->assertSame($content, $request->getContent());
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($csvFormat, $request->getCsvFormat());
        $this->assertSame($csvLocale, $request->getCsvLocale());

        $contact = new ImportContact($listOfCreatedIds, $numImported);
        $response = new ImportContactsResponse($contact);
        $this->assertSame($contact, $response->getContact());
        $response = new ImportContactsResponse();
        $response->setContact($contact);
        $this->assertSame($contact, $response->getContact());

        $body = new ImportContactsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ImportContactsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ImportContactsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ImportContactsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ImportContactsRequest ct="$contentType" l="$folderId" csvfmt="$csvFormat" csvlocale="$csvLocale">
            <urn:content aid="$attachUploadId">$value</urn:content>
        </urn:ImportContactsRequest>
        <urn:ImportContactsResponse>
            <urn:cn ids="$listOfCreatedIds" n="$numImported" />
        </urn:ImportContactsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ImportContactsEnvelope::class, 'xml'));
    }
}
