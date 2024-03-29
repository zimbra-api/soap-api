<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ConvActionOp;

use Zimbra\Mail\Message\ConvActionEnvelope;
use Zimbra\Mail\Message\ConvActionBody;
use Zimbra\Mail\Message\ConvActionRequest;
use Zimbra\Mail\Message\ConvActionResponse;

use Zimbra\Mail\Struct\ConvActionSelector;
use Zimbra\Mail\Struct\ActionResult;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConvAction.
 */
class ConvActionTest extends ZimbraTestCase
{
    public function testConvAction()
    {
        $id = $this->faker->uuid;
        $operation = $this->faker->randomElement(ConvActionOp::cases())->value;
        $nonExistentIds = $this->faker->uuid;
        $newlyCreatedIds = $this->faker->uuid;
        $acctRelativePath = $this->faker->word;

        $action = new ConvActionSelector($operation, $id, $acctRelativePath);
        $request = new ConvActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new ConvActionRequest(new ConvActionSelector($operation, $id));
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $action = new ActionResult(
            $id, $operation, $nonExistentIds, $newlyCreatedIds
        );
        $response = new ConvActionResponse($action);
        $this->assertSame($action, $response->getAction());
        $response = new ConvActionResponse();
        $response->setAction($action);
        $this->assertSame($action, $response->getAction());

        $body = new ConvActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ConvActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ConvActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ConvActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ConvActionRequest>
            <urn:action id="$id" op="$operation">
                <urn:acctRelPath>$acctRelativePath</urn:acctRelPath>
            </urn:action>
        </urn:ConvActionRequest>
        <urn:ConvActionResponse>
            <urn:action id="$id" op="$operation" nei="$nonExistentIds" nci="$newlyCreatedIds" />
        </urn:ConvActionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ConvActionEnvelope::class, 'xml'));
    }
}
