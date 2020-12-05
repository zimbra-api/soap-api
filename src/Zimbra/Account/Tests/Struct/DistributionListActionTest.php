<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Operation;
use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListAction;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListAction.
 */
class DistributionListActionTest extends ZimbraStructTestCase
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

        $opDelete = Operation::DELETE()->getValue();
        $opSubscribe = DLSubscribeOp::SUBSCRIBE()->getValue();
        $type = GranteeType::USR()->getValue();
        $by = DLGranteeBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<action op="$opDelete">
    <a n="$name">$value</a>
    <newName>$name</newName>
    <subsReq op="$opSubscribe" bccOwners="true">$value</subsReq>
    <dlm>$member</dlm>
    <owner type="$type" by="$by">$value</owner>
    <right right="$name">
        <grantee type="$type" by="$by">$value</grantee>
    </right>
</action>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListAction::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $name,
                    '_content' => $value,
                ],
            ],
            'op' => $opDelete,
            'newName' => [
                '_content' => $name,
            ],
            'subsReq' => [
                'op' => $opSubscribe,
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
                    'type' => $type,
                    'by' => $by,
                    '_content' => $value,
                ],
            ],
            'right' => [
                [
                    'right' => $name,
                    'grantee' => [
                        [
                            'type' => $type,
                            'by' => $by,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListAction::class, 'json'));
    }
}
