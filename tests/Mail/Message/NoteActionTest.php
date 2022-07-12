<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\NoteActionEnvelope;
use Zimbra\Mail\Message\NoteActionBody;
use Zimbra\Mail\Message\NoteActionRequest;
use Zimbra\Mail\Message\NoteActionResponse;

use Zimbra\Mail\Struct\ActionResult;
use Zimbra\Mail\Struct\NoteActionSelector;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NoteAction.
 */
class NoteActionTest extends ZimbraTestCase
{
    public function testNoteAction()
    {
        $operation = $this->faker->word;
        $id = $this->faker->uuid;
        $content = $this->faker->word;
        $bounds = $this->faker->word;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $action = new NoteActionSelector(
            $operation, $id, $content, $bounds
        );
        $request = new NoteActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new NoteActionRequest(new NoteActionSelector());
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $action = new ActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $response = new NoteActionResponse($action);
        $this->assertSame($action, $response->getAction());
        $response = new NoteActionResponse();
        $response->setAction($action);
        $this->assertSame($action, $response->getAction());

        $body = new NoteActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new NoteActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new NoteActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new NoteActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:NoteActionRequest>
            <urn:action id="$id" op="$operation" content="$content" pos="$bounds" />
        </urn:NoteActionRequest>
        <urn:NoteActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
        </urn:NoteActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, NoteActionEnvelope::class, 'xml'));
    }
}
