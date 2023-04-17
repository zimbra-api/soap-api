<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{TagActionOp, Type};

use Zimbra\Mail\Message\TagActionEnvelope;
use Zimbra\Mail\Message\TagActionBody;
use Zimbra\Mail\Message\TagActionRequest;
use Zimbra\Mail\Message\TagActionResponse;

use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\TagActionSelector;
use Zimbra\Mail\Struct\TagActionInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TagAction.
 */
class TagActionTest extends ZimbraTestCase
{
    public function testTagAction()
    {
        $operation = $this->faker->randomElement(TagActionOp::cases())->value;
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;
        $successes = $this->faker->uuid;
        $successNames = $this->faker->word;

        $action = new TagActionSelector(
            $operation, new RetentionPolicy(
                [new Policy(Type::SYSTEM, $id, $name, $lifetime)],
                [new Policy(Type::USER, $id, $name, $lifetime)]
            )
        );
        $request = new TagActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new TagActionRequest(new TagActionSelector());
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $action = new TagActionInfo(
            $successes, $successNames, $operation
        );
        $response = new TagActionResponse($action);
        $this->assertSame($action, $response->getAction());
        $response = new TagActionResponse();
        $response->setAction($action);
        $this->assertSame($action, $response->getAction());

        $body = new TagActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new TagActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new TagActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new TagActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:TagActionRequest>
            <urn:action op="$operation">
                <urn:retentionPolicy>
                    <urn:keep>
                        <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:keep>
                    <urn:purge>
                        <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:purge>
                </urn:retentionPolicy>
            </urn:action>
        </urn:TagActionRequest>
        <urn:TagActionResponse>
            <urn:action id="$successes" tn="$successNames" op="$operation" />
        </urn:TagActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, TagActionEnvelope::class, 'xml'));
    }
}
