<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\Id;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\GetNoteEnvelope;
use Zimbra\Mail\Message\GetNoteBody;
use Zimbra\Mail\Message\GetNoteRequest;
use Zimbra\Mail\Message\GetNoteResponse;

use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\NoteInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetNote.
 */
class GetNoteTest extends ZimbraTestCase
{
    public function testGetNote()
    {
        $id = $this->faker->uuid;
        $parentId = $this->faker->uuid;
        $revision =  $this->faker->randomNumber;
        $folder = $this->faker->uuid;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $bounds = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $changeDate =  $this->faker->unixTime;
        $modifiedSequence =  $this->faker->randomNumber;
        $content = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $note = new Id($id);
        $request = new GetNoteRequest($note);
        $this->assertSame($note, $request->getNote());
        $request = new GetNoteRequest(new Id());
        $request->setNote($note);
        $this->assertSame($note, $request->getNote());

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $note = new NoteInfo(
            $id,
            $revision,
            $folder,
            $date,
            $flags,
            $tags,
            $tagNames,
            $bounds,
            $color,
            $rgb,
            $changeDate,
            $modifiedSequence,
            $content,
            [$metadata]
        );
        $response = new GetNoteResponse($note);
        $this->assertSame($note, $response->getNote());
        $response = new GetNoteResponse();
        $response->setNote($note);
        $this->assertSame($note, $response->getNote());

        $body = new GetNoteBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetNoteBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetNoteEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetNoteEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetNoteRequest>
            <urn:note id="$id" />
        </urn:GetNoteRequest>
        <urn:GetNoteResponse>
            <urn:note id="$id" rev="$revision" l="$folder" d="$date" f="$flags" t="$tags" tn="$tagNames" pos="$bounds" color="$color" rgb="$rgb" md="$changeDate" ms="$modifiedSequence">
                <urn:content>$content</urn:content>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:note>
        </urn:GetNoteResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetNoteEnvelope::class, 'xml'));
    }
}
