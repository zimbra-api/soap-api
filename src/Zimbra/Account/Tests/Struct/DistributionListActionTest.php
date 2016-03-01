<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Operation;
use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListAction;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for DistributionListAction.
 */
class DistributionListActionTest extends ZimbraAccountTestCase
{
    public function testDistributionListAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, true);
        $owner = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value);
        $grantee = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value);

        $right = new DistributionListRightSpec($name, [$grantee]);
        $attr = new KeyValuePair($name, $value);

        $dl = new DistributionListAction(
            Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right]
        );
        $this->assertTrue($dl->getOp()->is('modify'));
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers()->all());
        $this->assertSame([$owner], $dl->getOwners()->all());
        $this->assertSame([$right], $dl->getRights()->all());

        $dl = new DistributionListAction(Operation::MODIFY());
        $dl->setOp(Operation::DELETE())
           ->setNewName($name)
           ->setSubsReq($subsReq)
           ->addMember($member)
           ->addOwner($owner)
           ->addRight($right)
           ->addAttr($attr);

        $this->assertTrue($dl->getOp()->is('delete'));
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers()->all());
        $this->assertSame([$owner], $dl->getOwners()->all());
        $this->assertSame([$right], $dl->getRights()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<action op="' . Operation::DELETE() . '">'
                . '<newName>' . $name . '</newName>'
                . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>'
                . '<a n="' . $name . '">' . $value . '</a>'
                . '<dlm>' . $member . '</dlm>'
                . '<owner type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value . '</owner>'
                . '<right right="' . $name . '">'
                    . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>'
                . '</right>'
            . '</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = [
            'action' => [
                'op' => Operation::DELETE()->value(),
                'newName' => $name,
                'subsReq' => [
                    'op' => DLSubscribeOp::SUBSCRIBE()->value(),
                    '_content' => $value,
                    'bccOwners' => true,
                ],
                'dlm' => [$member],
                'owner' => [
                    [
                        'type' => GranteeType::USR()->value(),
                        '_content' => $value,
                        'by' => DLGranteeBy::ID()->value(),
                    ],
                ],
                'right' => [
                    [
                        'right' => $name,
                        'grantee' => [
                            [
                                'type' => GranteeType::ALL()->value(),
                                '_content' => $value,
                                'by' => DLGranteeBy::NAME()->value(),
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
            ],
        ];
        $this->assertEquals($array, $dl->toArray());
    }
}
