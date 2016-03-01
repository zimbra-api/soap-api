<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AddDistributionListMember;

/**
 * Testcase class for AddDistributionListMember.
 */
class AddDistributionListMemberTest extends ZimbraAdminApiTestCase
{
    public function testAddDistributionListMemberRequest()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;

        $req = new AddDistributionListMember($id, [$member1]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1], $req->getMembers()->all());

        $req->setId($id)
            ->addMember($member2);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1, $member2], $req->getMembers()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListMemberRequest id="' . $id . '">'
                . '<dlm>' . $member1 . '</dlm>'
                . '<dlm>' . $member2 . '</dlm>'
            . '</AddDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddDistributionListMemberRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dlm' => [
                    $member1,
                    $member2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddDistributionListMemberApi()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;
        $this->api->addDistributionListMember(
            $id, [$member1, $member2]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddDistributionListMemberRequest id="' . $id . '">'
                        . '<urn1:dlm>' . $member1 . '</urn1:dlm>'
                        . '<urn1:dlm>' . $member2 . '</urn1:dlm>'
                    . '</urn1:AddDistributionListMemberRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
