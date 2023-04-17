<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\RankingActionOp;

use Zimbra\Mail\Message\RankingActionEnvelope;
use Zimbra\Mail\Message\RankingActionBody;
use Zimbra\Mail\Message\RankingActionRequest;
use Zimbra\Mail\Message\RankingActionResponse;

use Zimbra\Mail\Struct\RankingActionSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RankingAction.
 */
class RankingActionTest extends ZimbraTestCase
{
    public function testRankingAction()
    {
        $operation = RankingActionOp::RESET;
        $email = $this->faker->email;

        $action = new RankingActionSpec(
            $operation, $email
        );

        $request = new RankingActionRequest($action);
        $this->assertSame($action, $request->getAction());
        $request = new RankingActionRequest(new RankingActionSpec());
        $request->setAction($action);
        $this->assertSame($action, $request->getAction());

        $response = new RankingActionResponse();

        $body = new RankingActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RankingActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RankingActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RankingActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RankingActionRequest>
            <urn:action op="reset" email="$email" />
        </urn:RankingActionRequest>
        <urn:RankingActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RankingActionEnvelope::class, 'xml'));
    }
}
