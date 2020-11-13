<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ConfigureZimletBody;
use Zimbra\Admin\Message\ConfigureZimletRequest;
use Zimbra\Admin\Message\ConfigureZimletResponse;
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConfigureZimletBody.
 */
class ConfigureZimletBodyTest extends ZimbraStructTestCase
{
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
}
