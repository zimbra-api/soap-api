<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteZimletBody;
use Zimbra\Admin\Message\DeleteZimletEnvelope;
use Zimbra\Admin\Message\DeleteZimletRequest;
use Zimbra\Admin\Message\DeleteZimletResponse;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteZimlet.
 */
class DeleteZimletTest extends ZimbraTestCase
{
    public function testDeleteZimlet()
    {
        $name = $this->faker->word;
        $zimlet = new NamedElement($name);

        $request = new DeleteZimletRequest($zimlet);
        $this->assertSame($zimlet, $request->getZimlet());
        $request = new DeleteZimletRequest(new NamedElement(''));
        $request->setZimlet($zimlet);
        $this->assertSame($zimlet, $request->getZimlet());

        $response = new DeleteZimletResponse();

        $body = new DeleteZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteZimletBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteZimletEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteZimletRequest>
            <urn:zimlet name="$name" />
        </urn:DeleteZimletRequest>
        <urn:DeleteZimletResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteZimletEnvelope::class, 'xml'));
    }
}
