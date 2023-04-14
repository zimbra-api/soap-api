<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SetServerOfflineBody;
use Zimbra\Admin\Message\SetServerOfflineEnvelope;
use Zimbra\Admin\Message\SetServerOfflineRequest;
use Zimbra\Admin\Message\SetServerOfflineResponse;

use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Enum\ServerBy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetServerOfflineTest.
 */
class SetServerOfflineTest extends ZimbraTestCase
{
    public function testSetServerOffline()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME, $value);

        $request = new SetServerOfflineRequest($server, $attrs);
        $this->assertSame($server, $request->getServer());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new SetServerOfflineRequest();
        $request->setServer($server)
            ->setAttrs($attrs);
        $this->assertSame($server, $request->getServer());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new SetServerOfflineResponse();

        $body = new SetServerOfflineBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetServerOfflineBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetServerOfflineEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetServerOfflineEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SetServerOfflineRequest attrs="$attrs">
            <urn:server by="name">$value</urn:server>
        </urn:SetServerOfflineRequest>
        <urn:SetServerOfflineResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetServerOfflineEnvelope::class, 'xml'));
    }
}
