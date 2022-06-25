<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\PurgeFreeBusyQueueBody;
use Zimbra\Admin\Message\PurgeFreeBusyQueueEnvelope;
use Zimbra\Admin\Message\PurgeFreeBusyQueueRequest;
use Zimbra\Admin\Message\PurgeFreeBusyQueueResponse;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PurgeFreeBusyQueueTest.
 */
class PurgeFreeBusyQueueTest extends ZimbraTestCase
{
    public function testPurgeFreeBusyQueue()
    {
        $name = $this->faker->word;
        $provider = new NamedElement($name);

        $request = new PurgeFreeBusyQueueRequest($provider);
        $this->assertSame($provider, $request->getProvider());
        $request = new PurgeFreeBusyQueueRequest();
        $request->setProvider($provider);
        $this->assertSame($provider, $request->getProvider());

        $response = new PurgeFreeBusyQueueResponse();

        $body = new PurgeFreeBusyQueueBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new PurgeFreeBusyQueueBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new PurgeFreeBusyQueueEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new PurgeFreeBusyQueueEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PurgeFreeBusyQueueRequest>
            <provider name="$name" />
        </urn:PurgeFreeBusyQueueRequest>
        <urn:PurgeFreeBusyQueueResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, PurgeFreeBusyQueueEnvelope::class, 'xml'));
    }
}
