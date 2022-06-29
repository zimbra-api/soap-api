<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ExportContactsEnvelope;
use Zimbra\Mail\Message\ExportContactsBody;
use Zimbra\Mail\Message\ExportContactsRequest;
use Zimbra\Mail\Message\ExportContactsResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExportContacts.
 */
class ExportContactsTest extends ZimbraTestCase
{
    public function testExportContacts()
    {
        $contentType = $this->faker->mimeType;
        $folderId = $this->faker->uuid;
        $csvFormat = $this->faker->name;
        $csvLocale = $this->faker->locale;
        $csvDelimiter = $this->faker->name;
        $content = $this->faker->text;

        $request = new ExportContactsRequest(
            $contentType, $folderId, $csvFormat, $csvLocale, $csvDelimiter
        );
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($csvFormat, $request->getCsvFormat());
        $this->assertSame($csvLocale, $request->getCsvLocale());
        $this->assertSame($csvDelimiter, $request->getCsvDelimiter());
        $request = new ExportContactsRequest('');
        $request->setContentType($contentType)
                ->setFolderId($folderId)
                ->setCsvFormat($csvFormat)
                ->setCsvLocale($csvLocale)
                ->setCsvDelimiter($csvDelimiter);
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($csvFormat, $request->getCsvFormat());
        $this->assertSame($csvLocale, $request->getCsvLocale());
        $this->assertSame($csvDelimiter, $request->getCsvDelimiter());

        $response = new ExportContactsResponse($content);
        $this->assertSame($content, $response->getContent());
        $response = new ExportContactsResponse('');
        $response->setContent($content);
        $this->assertSame($content, $response->getContent());

        $body = new ExportContactsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ExportContactsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ExportContactsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ExportContactsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ExportContactsRequest ct="$contentType" l="$folderId" csvfmt="$csvFormat" csvlocale="$csvLocale" csvsep="$csvDelimiter" />
        <urn:ExportContactsResponse>
            <urn:content>$content</urn:content>
        </urn:ExportContactsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ExportContactsEnvelope::class, 'xml'));
    }
}
