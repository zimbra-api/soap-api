<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Common\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Common\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Common\Enum\Operation;
use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListAction;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListAction.
 */
class DistributionListActionTest extends ZimbraTestCase
{
    public function testDistributionListAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, TRUE);
        $owner = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::NAME(), $value);
        $grantee = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::NAME(), $value);

        $right = new DistributionListRightSpec($name, [$grantee]);
        $attr = new KeyValuePair($name, $value);

        $dl = new DistributionListAction(
            Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right]
        );
        $this->assertEquals(Operation::MODIFY(), $dl->getOp());
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());
        $this->assertSame([$right], $dl->getRights());

        $dl = new DistributionListAction(Operation::MODIFY());
        $dl->setOp(Operation::DELETE())
           ->setNewName($name)
           ->setSubsReq($subsReq)
           ->addMember($member)
           ->addOwner($owner)
           ->addRight($right)
           ->addKeyValuePair($attr);

        $this->assertEquals(Operation::DELETE(), $dl->getOp());
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());
        $this->assertSame([$right], $dl->getRights());

        $xml = <<<EOT
<?xml version="1.0"?>
<result op="delete">
    <a n="$name">$value</a>
    <newName>$name</newName>
    <subsReq op="subscribe" bccOwners="true">$value</subsReq>
    <dlm>$member</dlm>
    <owner type="usr" by="name">$value</owner>
    <right right="$name">
        <grantee type="usr" by="name">$value</grantee>
    </right>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListAction::class, 'xml'));

        $json = json_encode([
            'op' => 'delete',
            'newName' => [
                '_content' => $name,
            ],
            'subsReq' => [
                'op' => 'subscribe',
                '_content' => $value,
                'bccOwners' => TRUE,
            ],
            'dlm' => [
                [
                    '_content' => $member,
                ],
            ],
            'owner' => [
                [
                    'type' => 'usr',
                    'by' => 'name',
                    '_content' => $value,
                ],
            ],
            'right' => [
                [
                    'right' => $name,
                    'grantee' => [
                        [
                            'type' => 'usr',
                            'by' => 'name',
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
            'a' => [
                [
                    'n' => $name,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListAction::class, 'json'));
    }
}
