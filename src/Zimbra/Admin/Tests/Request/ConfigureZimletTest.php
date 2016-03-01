<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ConfigureZimlet;
use Zimbra\Admin\Struct\AttachmentIdAttrib;

/**
 * Testcase class for ConfigureZimlet.
 */
class ConfigureZimletTest extends ZimbraAdminApiTestCase
{
    public function testConfigureZimletRequest()
    {
        $aid = $this->faker->word;
        $content = new AttachmentIdAttrib($aid);
        $req = new ConfigureZimlet($content);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($content, $req->getContent());

        $req->setContent($content);
        $this->assertSame($content, $req->getContent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ConfigureZimletRequest>'
                . '<content aid="' . $aid . '" />'
            . '</ConfigureZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ConfigureZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'content' => [
                    'aid' => $aid,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testConfigureZimletApi()
    {
        $aid = $this->faker->word;
        $content = new AttachmentIdAttrib($aid);

        $this->api->configureZimlet(
            $content
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ConfigureZimletRequest>'
                        . '<urn1:content aid="' . $aid . '" />'
                    . '</urn1:ConfigureZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
