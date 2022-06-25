<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\EndSessionEnvelope;
use Zimbra\Account\Message\EndSessionBody;
use Zimbra\Account\Message\EndSessionRequest;
use Zimbra\Account\Message\EndSessionResponse;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for EndSession.
 */
class EndSessionTest extends ZimbraTestCase
{
    public function testEndSession()
    {
        $sessionId = $this->faker->uuid;

        $request = new EndSessionRequest(
            FALSE,
            FALSE,
            FALSE,
            $sessionId
        );
        $this->assertFalse($request->isLogOff());
        $this->assertFalse($request->isClearAllSoapSessions());
        $this->assertFalse($request->isExcludeCurrentSession());
        $this->assertSame($sessionId, $request->getSessionId());

        $request = new EndSessionRequest();
        $request->setLogOff(TRUE)
            ->setClearAllSoapSessions(TRUE)
            ->setExcludeCurrentSession(TRUE)
            ->setSessionId($sessionId);
        $this->assertTrue($request->isLogOff());
        $this->assertTrue($request->isClearAllSoapSessions());
        $this->assertTrue($request->isExcludeCurrentSession());
        $this->assertSame($sessionId, $request->getSessionId());

        $response = new EndSessionResponse();

        $body = new EndSessionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new EndSessionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new EndSessionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new EndSessionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:EndSessionRequest logoff="true" all="true" excludeCurrent="true" sessionId="$sessionId" />
        <urn:EndSessionResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, EndSessionEnvelope::class, 'xml'));
    }
}
