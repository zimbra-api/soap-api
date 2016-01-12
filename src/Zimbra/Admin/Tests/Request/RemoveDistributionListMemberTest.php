<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RemoveDistributionListMember;

/**
 * Testcase class for RemoveDistributionListMember.
 */
class RemoveDistributionListMemberTest extends ZimbraAdminApiTestCase
{
    public function testRemoveDistributionListMemberRequest()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;

        $req = new RemoveDistributionListMember($id, [$member1]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals([$member1], $req->getMembers()->all());

        $req = new RemoveDistributionListMember('', [$this->faker->word]);
        $req->setId($id)
            ->setMembers([$member1])
            ->addMember($member2);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals([$member1, $member2], $req->getMembers()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveDistributionListMemberRequest id="' . $id . '">'
                . '<dlm>' . $member1 . '</dlm>'
                . '<dlm>' . $member2 . '</dlm>'
            . '</RemoveDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveDistributionListMemberRequest' => [
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

    public function testRemoveDistributionListMemberApi()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;
        $this->api->removeDistributionListMember($id, [$member1, $member2]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveDistributionListMemberRequest id="' . $id . '">'
                        . '<urn1:dlm>' . $member1 . '</urn1:dlm>'
                        . '<urn1:dlm>' . $member2 . '</urn1:dlm>'
                    . '</urn1:RemoveDistributionListMemberRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
