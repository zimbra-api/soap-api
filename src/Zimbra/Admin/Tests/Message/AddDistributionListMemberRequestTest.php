<?php declare(strict_types=1);

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
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddDistributionListMemberRequest::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'dlm' => [
                [
                    '_content' => $member1,
                ],
                [
                    '_content' => $member2,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddDistributionListMemberRequest::class, 'json'));
    }
}
