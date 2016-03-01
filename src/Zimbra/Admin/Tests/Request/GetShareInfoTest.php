<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetShareInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\GranteeChooser;

/**
 * Testcase class for GetShareInfo.
 */
class GetShareInfoTest extends ZimbraAdminApiTestCase
{
    public function testGetShareInfoRequest()
    {
        $value = $this->faker->word;
        $type = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;

        $owner = new AccountSelector(AccountBy::NAME(), $value);
        $grantee = new GranteeChooser($type, $id, $name);
     
        $req = new GetShareInfo($owner, $grantee);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($owner, $req->getOwner());
        $this->assertSame($grantee, $req->getGrantee());

        $req->setOwner($owner)
            ->setGrantee($grantee);
        $this->assertSame($owner, $req->getOwner());
        $this->assertSame($grantee, $req->getGrantee());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetShareInfoRequest>'
                . '<owner by="' . AccountBy::NAME() . '">' . $value . '</owner>'
                . '<grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
            . '</GetShareInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetShareInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'owner' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'grantee' => [
                    'type' => $type,
                    'id' => $id,
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareInfoApi()
    {
        $value = $this->faker->word;
        $type = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;

        $owner = new AccountSelector(AccountBy::NAME(), $value);
        $grantee = new GranteeChooser($type, $id, $name);

        $this->api->getShareInfo($owner, $grantee);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetShareInfoRequest>'
                        . '<urn1:owner by="' . AccountBy::NAME() . '">' . $value . '</urn1:owner>'
                        . '<urn1:grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
                    . '</urn1:GetShareInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
