<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\UndeployZimletBody;
use Zimbra\Admin\Message\UndeployZimletEnvelope;
use Zimbra\Admin\Message\UndeployZimletRequest;
use Zimbra\Admin\Message\UndeployZimletResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for UndeployZimletTest.
 */
class UndeployZimletTest extends ZimbraTestCase
{
    public function testUndeployZimlet()
    {
        $name = $this->faker->name;
        $action = $this->faker->word;

        $request = new UndeployZimletRequest($name, $action);
        $this->assertSame($name, $request->getName());
        $this->assertSame($action, $request->getAction());

        $request = new UndeployZimletRequest('');
        $request->setName($name)
            ->setAction($action);
        $this->assertSame($name, $request->getName());
        $this->assertSame($action, $request->getAction());

        $response = new UndeployZimletResponse();

        $body = new UndeployZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new UndeployZimletBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new UndeployZimletEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new UndeployZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:UndeployZimletRequest name="$name" action="$action" />
        <urn:UndeployZimletResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, UndeployZimletEnvelope::class, 'xml'));
    }
}
