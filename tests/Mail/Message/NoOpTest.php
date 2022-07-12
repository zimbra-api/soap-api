<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\NoOpEnvelope;
use Zimbra\Mail\Message\NoOpBody;
use Zimbra\Mail\Message\NoOpRequest;
use Zimbra\Mail\Message\NoOpResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NoOp.
 */
class NoOpTest extends ZimbraTestCase
{
    public function testNoOp()
    {
        $timeout = $this->faker->randomNumber;

        $request = new NoOpRequest(FALSE, FALSE, FALSE, $timeout);
        $this->assertFalse($request->getWait());
        $this->assertFalse($request->getIncludeDelegates());
        $this->assertFalse($request->getEnforceLimit());
        $this->assertSame($timeout, $request->getTimeout());
        $request = new NoOpRequest();
        $request->setWait(TRUE)
            ->setIncludeDelegates(TRUE)
            ->setEnforceLimit(TRUE)
            ->setTimeout($timeout);
        $this->assertTrue($request->getWait());
        $this->assertTrue($request->getIncludeDelegates());
        $this->assertTrue($request->getEnforceLimit());
        $this->assertSame($timeout, $request->getTimeout());

        $response = new NoOpResponse(FALSE);
        $this->assertFalse($response->getWaitDisallowed());
        $response = new NoOpResponse();
        $response->setWaitDisallowed(TRUE);
        $this->assertTrue($response->getWaitDisallowed());

        $body = new NoOpBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new NoOpBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new NoOpEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new NoOpEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:NoOpRequest wait="true" delegate="true" limitToOneBlocked="true" timeout="$timeout" />
        <urn:NoOpResponse waitDisallowed="true" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, NoOpEnvelope::class, 'xml'));
    }
}
