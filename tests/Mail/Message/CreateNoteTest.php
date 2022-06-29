<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\CreateNoteEnvelope;
use Zimbra\Mail\Message\CreateNoteBody;
use Zimbra\Mail\Message\CreateNoteRequest;
use Zimbra\Mail\Message\CreateNoteResponse;

use Zimbra\Mail\Struct\NewNoteSpec;
use Zimbra\Mail\Struct\NoteInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateNote.
 */
class CreateNoteTest extends ZimbraTestCase
{
    public function testCreateNote()
    {
        $folder = $this->faker->uuid;
        $content = $this->faker->uuid;
        $id = $this->faker->uuid;
        $revision =  $this->faker->randomNumber;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $bounds = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $changeDate =  $this->faker->unixTime;
        $modifiedSequence =  $this->faker->randomNumber;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $newNote = new NewNoteSpec(
            $folder,
            $content,
            $color,
            $bounds
        );
        $request = new CreateNoteRequest($newNote);
        $this->assertSame($newNote, $request->getNote());
        $request = new CreateNoteRequest(new NewNoteSpec('', ''));
        $request->setNote($newNote);
        $this->assertSame($newNote, $request->getNote());

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $noteInfo = new NoteInfo(
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
        $response = new CreateNoteResponse($noteInfo);
        $this->assertSame($noteInfo, $response->getNote());
        $response = new CreateNoteResponse(new NoteInfo());
        $response->setNote($noteInfo);
        $this->assertSame($noteInfo, $response->getNote());

        $body = new CreateNoteBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateNoteBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateNoteEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateNoteEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateNoteRequest>
            <urn:note l="$folder" content="$content" color="$color" pos="$bounds" />
        </urn:CreateNoteRequest>
        <urn:CreateNoteResponse>
            <urn:note id="$id" rev="$revision" l="$folder" d="$date" f="$flags" t="$tags" tn="$tagNames" pos="$bounds" color="$color" rgb="$rgb" md="$changeDate" ms="$modifiedSequence">
                <urn:content>$content</urn:content>
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:note>
        </urn:CreateNoteResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateNoteEnvelope::class, 'xml'));
    }
}
