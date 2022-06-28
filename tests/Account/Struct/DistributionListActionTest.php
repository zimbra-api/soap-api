<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListAction;
use Zimbra\Common\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Common\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Common\Enum\{GranteeType, Operation};
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

        $dl = new MockDistributionListAction(
            Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right]
        );
        $this->assertEquals(Operation::MODIFY(), $dl->getOp());
        $this->assertSame($name, $dl->getNewName());
        $this->assertSame($subsReq, $dl->getSubsReq());
        $this->assertSame([$member], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());
        $this->assertSame([$right], $dl->getRights());

        $dl = new MockDistributionListAction();
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
<result op="delete" xmlns:urn="urn:zimbraAccount">
    <urn:a n="$name">$value</urn:a>
    <urn:newName>$name</urn:newName>
    <urn:subsReq op="subscribe" bccOwners="true">$value</urn:subsReq>
    <urn:dlm>$member</urn:dlm>
    <urn:owner type="usr" by="name">$value</urn:owner>
    <urn:right right="$name">
        <urn:grantee type="usr" by="name">$value</urn:grantee>
    </urn:right>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, MockDistributionListAction::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
class MockDistributionListAction extends DistributionListAction
{
}
