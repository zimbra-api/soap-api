<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetAccountDistributionLists;
use Zimbra\Enum\MemberOfSelector as MemberOf;

/**
 * Testcase class for GetAccountDistributionLists.
 */
class GetAccountDistributionListsTest extends ZimbraAccountApiTestCase
{
    public function testGetAccountDistributionListsRequest()
    {
        $attrs = $this->faker->word;

        $req = new GetAccountDistributionLists(false, MemberOf::DIRECT_ONLY(), [$attrs]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertFalse($req->getOwnerOf());
        $this->assertSame('directOnly', $req->getMemberOf()->value());
        $this->assertSame($attrs, $req->getAttrs());

        $req->setOwnerOf(true)
            ->setMemberOf(MemberOf::ALL());
        $this->assertTrue($req->getOwnerOf());
        $this->assertSame('all', $req->getMemberOf()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountDistributionListsRequest ownerOf="true" memberOf="' . MemberOf::ALL() . '" attrs="' . $attrs . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountDistributionListsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'ownerOf' => true,
                'memberOf' => MemberOf::ALL()->value(),
                'attrs' => $attrs,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountDistributionListsApi()
    {
        $attrs = $this->faker->word;
        $this->api->getAccountDistributionLists(true, MemberOf::DIRECT_ONLY(), [$attrs]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetAccountDistributionListsRequest ownerOf="true" memberOf="' . MemberOf::DIRECT_ONLY() . '" attrs="' . $attrs . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
