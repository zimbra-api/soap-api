<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ImportAppointmentsEnvelope;
use Zimbra\Mail\Message\ImportAppointmentsBody;
use Zimbra\Mail\Message\ImportAppointmentsRequest;
use Zimbra\Mail\Message\ImportAppointmentsResponse;

use Zimbra\Mail\Struct\ContentSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImportAppointments.
 */
class ImportAppointmentsTest extends ZimbraTestCase
{
    public function testImportAppointments()
    {
        $contentType = $this->faker->word;
        $folderId = $this->faker->word;
        $attachmentId = $this->faker->word;
        $messageId = $this->faker->uuid;
        $part = $this->faker->word;
        $text = $this->faker->text;
        $ids = $this->faker->word;
        $num = $this->faker->randomNumber;

        $content = new ContentSpec($attachmentId, $messageId, $part, $text);
        $request = new ImportAppointmentsRequest($content, $contentType, $folderId);
        $this->assertSame($content, $request->getContent());
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($folderId, $request->getFolderId());
        $request = new ImportAppointmentsRequest(new ContentSpec());
        $request->setContent($content)
            ->setContentType($contentType)
            ->setFolderId($folderId);
        $this->assertSame($content, $request->getContent());
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($folderId, $request->getFolderId());

        $response = new ImportAppointmentsResponse($ids, $num);
        $this->assertSame($ids, $response->getIds());
        $this->assertSame($num, $response->getNum());
        $response = new ImportAppointmentsResponse();
        $response->setIds($ids)
            ->setNum($num);
        $this->assertSame($ids, $response->getIds());
        $this->assertSame($num, $response->getNum());

        $body = new ImportAppointmentsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ImportAppointmentsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ImportAppointmentsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ImportAppointmentsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ImportAppointmentsRequest l="$folderId" ct="$contentType">
            <urn:content aid="$attachmentId" mid="$messageId" part="$part">$text</urn:content>
        </urn:ImportAppointmentsRequest>
        <urn:ImportAppointmentsResponse ids="$ids" n="$num" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ImportAppointmentsEnvelope::class, 'xml'));
    }
}
