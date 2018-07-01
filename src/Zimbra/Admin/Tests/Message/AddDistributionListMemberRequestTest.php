<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\AddDistributionListMemberRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListMemberRequest.
 */
class AddDistributionListMemberRequestTest extends ZimbraStructTestCase
{
    public function testAddDistributionListMemberRequest()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;

        $req = new AddDistributionListMemberRequest($id, [$member1]);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1], $req->getMembers());

        $req = new AddDistributionListMemberRequest('', []);
        $req->setId($id)
            ->setMembers([$member1])
            ->addMember($member2);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1, $member2], $req->getMembers());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListMemberRequest id="' . $id . '">'
                . '<dlm>' . $member1 . '</dlm>'
                . '<dlm>' . $member2 . '</dlm>'
            . '</AddDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));

        $req = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddDistributionListMemberRequest', 'xml');
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1, $member2], $req->getMembers());
    }
}
