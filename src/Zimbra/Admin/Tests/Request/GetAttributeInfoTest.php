<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAttributeInfo;
use Zimbra\Enum\EntryType;

/**
 * Testcase class for GetAttributeInfo.
 */
class GetAttributeInfoTest extends ZimbraAdminApiTestCase
{
    public function testGetAttributeInfoRequest()
    {
        $attrs = $this->faker->word;
        $req = new GetAttributeInfo(
            $attrs, [EntryType::ACCOUNT(), EntryType::ACL_TARGET()]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame('account,aclTarget', $req->getEntryTypes());

        $req->setAttrs($attrs)
            ->addEntryType(EntryType::ALIAS());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame('account,aclTarget,alias', $req->getEntryTypes());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAttributeInfoRequest attrs="' . $attrs . '" entryTypes="account,aclTarget,alias" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAttributeInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'entryTypes' => 'account,aclTarget,alias',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAttributeInfoApi()
    {
        $attrs = $this->faker->word;
        $this->api->getAttributeInfo($attrs, [EntryType::ACCOUNT(), EntryType::ACL_TARGET()]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAttributeInfoRequest attrs="' . $attrs  .'" entryTypes="account,aclTarget" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
