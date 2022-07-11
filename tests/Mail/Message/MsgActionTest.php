<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\MsgActionEnvelope;
use Zimbra\Mail\Message\MsgActionBody;
use Zimbra\Mail\Message\MsgActionRequest;
use Zimbra\Mail\Message\MsgActionResponse;

use Zimbra\Mail\Struct\ActionResult;
use Zimbra\Mail\Struct\ActionSelector;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MsgAction.
 */
class MsgActionTest extends ZimbraTestCase
{
    public function testMsgAction()
    {
        $operation = $this->faker->word;
        $ids = $this->faker->uuid;
        $constraint = $this->faker->word;
        $tag = $this->faker->numberBetween(1, 100);
        $folder = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = $this->faker->numberBetween(0, 127);
        $name = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;

        $id = $this->faker->uuid;
        $operation = $this->faker->word;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;

        $action = new ActionSelector(
            $operation, $ids, $constraint, $tag, $folder, $rgb, $color, $name, $flags, $tags, $tagNames, TRUE, TRUE
        );
        $request = new MsgActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new MsgActionRequest(new ActionSelector());
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $action = new ActionResult($id, $operation, $nonExistentIds, $newlyCreatedIds);
        $response = new MsgActionResponse($action);
        $this->assertSame($action, $response->getAction());
        $response = new MsgActionResponse();
        $response->setAction($action);
        $this->assertSame($action, $response->getAction());

        $body = new MsgActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new MsgActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new MsgActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new MsgActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:MsgActionRequest>
            <urn:action id="$ids" op="$operation" tcon="$constraint" tag="$tag" l="$folder" rgb="$rgb" color="$color" name="$name" f="$flags" t="$tags" tn="$tagNames" nei="true" nci="true" />
        </urn:MsgActionRequest>
        <urn:MsgActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
        </urn:MsgActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, MsgActionEnvelope::class, 'xml'));
    }
}
