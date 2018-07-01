<?php

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

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, true);
        $owner = new DistributionListGranteeSelector(GranteeType::USR()->value(), DLGranteeBy::ID()->value(), $value);
        $grantee = new DistributionListGranteeSelector(GranteeType::ALL()->value(), DLGranteeBy::NAME()->value(), $value);

        $right = new DistributionListRightSpec($name, [$grantee]);
        $attr = new KeyValuePair($name, $value);

        $dl = new DistributionListAction(
            Operation::MODIFY()->value(), $name, $subsReq, [$member], [$owner], [$right]
        );
        $this->assertSame(Operation::MODIFY()->value(), $dl->getOp());
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());
        $this->assertSame([$right], $dl->getRights());

        $dl = new DistributionListAction('');
        $dl->setOp(Operation::DELETE()->value())
           ->setNewName($name)
           ->setSubsReq($subsReq)
           ->addMember($member)
           ->addOwner($owner)
           ->addRight($right)
           ->addAttr($attr);

        $this->assertSame(Operation::DELETE()->value(), $dl->getOp());
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());
        $this->assertSame([$right], $dl->getRights());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<action op="' . Operation::DELETE() . '">'
                . '<a n="' . $name . '">' . $value . '</a>'
                . '<newName>' . $name . '</newName>'
                . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>'
                . '<dlm>' . $member . '</dlm>'
                . '<owner type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value . '</owner>'
                . '<right right="' . $name . '">'
                    . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>'
                . '</right>'
            . '</action>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));

        $dl = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\DistributionListAction', 'xml');
        $this->assertSame(Operation::DELETE()->value(), $dl->getOp());
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame([$member], $dl->getMembers());

        $subsReq = $dl->getSubsReq();
        $this->assertSame(DLSubscribeOp::SUBSCRIBE()->value(), $subsReq->getOp());
        $this->assertSame($value, $subsReq->getValue());
        $this->assertTrue($subsReq->getBccOwners());

        $owner = $dl->getOwners()[0];
        $this->assertSame(GranteeType::USR()->value(), $owner->getType());
        $this->assertSame(DLGranteeBy::ID()->value(), $owner->getBy());
        $this->assertSame($value, $owner->getValue());

        $right = $dl->getRights()[0];
        $this->assertSame($name, $right->getRight());
        $grantee = $right->getGrantees()[0];
        $this->assertSame(GranteeType::ALL()->value(), $grantee->getType());
        $this->assertSame(DLGranteeBy::NAME()->value(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());
    }
}
