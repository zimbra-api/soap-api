<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetMailQueueInfoBody, GetMailQueueInfoEnvelope, GetMailQueueInfoRequest, GetMailQueueInfoResponse};

use Zimbra\Admin\Struct\ServerQueues;
use Zimbra\Admin\Struct\MailQueueCount;
use Zimbra\Common\Struct\NamedElement;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMailQueueInfo.
 */
class GetMailQueueInfoTest extends ZimbraTestCase
{
    public function testGetMailQueueInfo()
    {
        $name = $this->faker->word;
        $count = $this->faker->randomNumber;

        $server = new NamedElement($name);
        $request = new GetMailQueueInfoRequest($server);
        $this->assertSame($server, $request->getServer());
        $request = new GetMailQueueInfoRequest(new NamedElement());
        $request->setServer($server);
        $this->assertSame($server, $request->getServer());

        $server = new ServerQueues($name, [new MailQueueCount($name, $count)]);
        $response = new GetMailQueueInfoResponse($server);
        $this->assertSame($server, $response->getServer());

        $response = new GetMailQueueInfoResponse();
        $response->setServer($server);
        $this->assertSame($server, $response->getServer());

        $body = new GetMailQueueInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetMailQueueInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMailQueueInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetMailQueueInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailQueueInfoRequest>
            <urn:server name="$name" />
        </urn:GetMailQueueInfoRequest>
        <urn:GetMailQueueInfoResponse>
            <urn:server name="$name">
                <urn:queue name="$name" n="$count" />
            </urn:server>
        </urn:GetMailQueueInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMailQueueInfoEnvelope::class, 'xml'));
    }
}
