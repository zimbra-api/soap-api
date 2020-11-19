<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeleteZimletBody;
use Zimbra\Admin\Message\DeleteZimletEnvelope;
use Zimbra\Admin\Message\DeleteZimletRequest;
use Zimbra\Admin\Message\DeleteZimletResponse;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeleteZimlet.
 */
class DeleteZimletTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:DeleteZimletRequest>'
                        . '<zimlet name="' . $name . '" />'
                    . '</urn:DeleteZimletRequest>'
                    . '<urn:DeleteZimletResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteZimletEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteZimletRequest' => [
                    'zimlet' => [
                        'name' => $name,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteZimletResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteZimletEnvelope::class, 'json'));
    }
}
