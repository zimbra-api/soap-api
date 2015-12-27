<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetShareInfo;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\GranteeChooser;
use Zimbra\Enum\AccountBy;

/**
 * Testcase class for GetShareInfo.
 */
class GetShareInfoTest extends ZimbraAccountApiTestCase
{
    public function testGetShareInfoRequest()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $type = $this->faker->word;
        $id = $this->faker->word;

        $owner = new AccountSelector(AccountBy::NAME(), $value);
        $grantee = new GranteeChooser($type, $id, $name);

        $req = new GetShareInfo($grantee, $owner, true, false);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($owner, $req->getOwner());
        $this->assertTrue($req->getInternal());
        $this->assertFalse($req->getIncludeSelf());

        $req->setGrantee($grantee)
            ->setOwner($owner)
            ->setInternal(false)
            ->setIncludeSelf(true);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($owner, $req->getOwner());
        $this->assertFalse($req->getInternal());
        $this->assertTrue($req->getIncludeSelf());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetShareInfoRequest internal="false" includeSelf="true" >'
                . '<grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
                . '<owner by="' . AccountBy::NAME() . '">' . $value . '</owner>'
            . '</GetShareInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetShareInfoRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'internal' => false,
                'includeSelf' => true,
                'grantee' => [
                    'type' => $type,
                    'id' => $id,
                    'name' => $name,
                ],
                'owner' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareInfoApi()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $type = $this->faker->word;
        $id = $this->faker->word;
        $owner = new AccountSelector(AccountBy::NAME(), $value);
        $grantee = new GranteeChooser($type, $id, $name);

        $this->api->getShareInfo($grantee, $owner, true, false);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetShareInfoRequest internal="true" includeSelf="false" >'
                        . '<urn1:grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
                        . '<urn1:owner by="' . AccountBy::NAME() . '">' . $value . '</urn1:owner>'
                    . '</urn1:GetShareInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
