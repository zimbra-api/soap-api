<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SetLocalServerOnlineBody;
use Zimbra\Admin\Message\SetLocalServerOnlineEnvelope;
use Zimbra\Admin\Message\SetLocalServerOnlineRequest;
use Zimbra\Admin\Message\SetLocalServerOnlineResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetLocalServerOnlineTest.
 */
class SetLocalServerOnlineTest extends ZimbraTestCase
{
    public function testSetLocalServerOnline()
    {
        $request = new SetLocalServerOnlineRequest();
        $response = new SetLocalServerOnlineResponse();

        $body = new SetLocalServerOnlineBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetLocalServerOnlineBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetLocalServerOnlineEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetLocalServerOnlineEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SetLocalServerOnlineRequest />
        <urn:SetLocalServerOnlineResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetLocalServerOnlineEnvelope::class, 'xml'));
    }
}
