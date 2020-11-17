<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ConfigureZimletBody;
use Zimbra\Admin\Message\ConfigureZimletEnvelope;
use Zimbra\Admin\Message\ConfigureZimletRequest;
use Zimbra\Admin\Message\ConfigureZimletResponse;
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConfigureZimlet.
 */
class ConfigureZimletTest extends ZimbraStructTestCase
{
    public function testConfigureZimletRequest()
    {
        $aid = $this->faker->uuid;
        $content = new AttachmentIdAttrib($aid);

        $req = new ConfigureZimletRequest($content);
        $this->assertSame($content, $req->getContent());

        $req = new ConfigureZimletRequest(new AttachmentIdAttrib(''));
        $req->setContent($content);
        $this->assertSame($content, $req->getContent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ConfigureZimletRequest>'
                . '<content aid="' . $aid . '" />'
            . '</ConfigureZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, ConfigureZimletRequest::class, 'xml'));

        $json = json_encode([
            'content' => [
                'aid' => $aid,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, ConfigureZimletRequest::class, 'json'));
    }

    public function testConfigureZimletResponse()
    {
        $res = new ConfigureZimletResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ConfigureZimletResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ConfigureZimletResponse::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ConfigureZimletResponse::class, 'json'));
    }

    public function testConfigureZimletBody()
    {
        $aid = $this->faker->uuid;
        $content = new AttachmentIdAttrib($aid);
        $request = new ConfigureZimletRequest($content);
        $response = new ConfigureZimletResponse();

        $body = new ConfigureZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ConfigureZimletBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:ConfigureZimletRequest>'
                    . '<content aid="' . $aid . '" />'
                . '</urn:ConfigureZimletRequest>'
                . '<urn:ConfigureZimletResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, ConfigureZimletBody::class, 'xml'));

        $json = json_encode([
            'ConfigureZimletRequest' => [
                'content' => [
                    'aid' => $aid,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'ConfigureZimletResponse' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, ConfigureZimletBody::class, 'json'));
    }

    public function testConfigureZimletEnvelope()
    {
        $aid = $this->faker->uuid;
        $content = new AttachmentIdAttrib($aid);
        $request = new ConfigureZimletRequest($content);
        $response = new ConfigureZimletResponse();
        $body = new ConfigureZimletBody($request, $response);

        $envelope = new ConfigureZimletEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ConfigureZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:ConfigureZimletRequest>'
                        . '<content aid="' . $aid . '" />'
                    . '</urn:ConfigureZimletRequest>'
                    . '<urn:ConfigureZimletResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ConfigureZimletEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ConfigureZimletRequest' => [
                    'content' => [
                        'aid' => $aid,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ConfigureZimletResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ConfigureZimletEnvelope::class, 'json'));
    }
}
