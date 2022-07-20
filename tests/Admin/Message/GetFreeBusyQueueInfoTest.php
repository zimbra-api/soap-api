<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetFreeBusyQueueInfoBody;
use Zimbra\Admin\Message\GetFreeBusyQueueInfoEnvelope;
use Zimbra\Admin\Message\GetFreeBusyQueueInfoRequest;
use Zimbra\Admin\Message\GetFreeBusyQueueInfoResponse;

use Zimbra\Admin\Struct\FreeBusyQueueProvider;
use Zimbra\Common\Struct\Id;
use Zimbra\Common\Struct\NamedElement;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetFreeBusyQueueInfo.
 */
class GetFreeBusyQueueInfoTest extends ZimbraTestCase
{
    public function testGetFreeBusyQueueInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $provider = new NamedElement($name);
        $request = new GetFreeBusyQueueInfoRequest($provider);
        $this->assertSame($provider, $request->getProvider());
        $request = new GetFreeBusyQueueInfoRequest();
        $request->setProvider($provider);
        $this->assertSame($provider, $request->getProvider());

        $provider = new FreeBusyQueueProvider($name, [new Id($id)]);
        $response = new GetFreeBusyQueueInfoResponse([$provider]);
        $this->assertSame([$provider], $response->getProviders());
        $response = new GetFreeBusyQueueInfoResponse();
        $response->setProviders([$provider])
            ->addProvider($provider);
        $this->assertSame([$provider, $provider], $response->getProviders());
        $response->setProviders([$provider]);

        $body = new GetFreeBusyQueueInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetFreeBusyQueueInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetFreeBusyQueueInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetFreeBusyQueueInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetFreeBusyQueueInfoRequest>
            <urn:provider name="$name" />
        </urn:GetFreeBusyQueueInfoRequest>
        <urn:GetFreeBusyQueueInfoResponse>
            <urn:provider name="$name">
                <urn:account id="$id" />
            </urn:provider>
        </urn:GetFreeBusyQueueInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetFreeBusyQueueInfoEnvelope::class, 'xml'));
    }
}
