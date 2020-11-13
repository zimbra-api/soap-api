<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ConfigureZimletRequest;
use Zimbra\Admin\Struct\AttachmentIdAttrib;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConfigureZimletRequest.
 */
class ConfigureZimletRequestTest extends ZimbraStructTestCase
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
}
