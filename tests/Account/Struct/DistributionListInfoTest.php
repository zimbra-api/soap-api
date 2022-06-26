<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\DistributionListInfo;
use Zimbra\Account\Struct\DistributionListRightInfo;
use Zimbra\Account\Struct\DistributionListGranteeInfo;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListInfo.
 */
class DistributionListInfoTest extends ZimbraTestCase
{
    public function testDistributionListInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $member1 = $this->faker->email;
        $member2 = $this->faker->email;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $owner = new DistributionListGranteeInfo(
            GranteeType::USR(), $id, $name
        );
        $right = new DistributionListRightInfo(
            $name, [$owner]
        );

        $dl = new MockDistributionListInfo($name, $id, [], [$member1, $member2], [$owner], [$right], FALSE, FALSE, FALSE);
        $this->assertSame([$member1, $member2], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());
        $this->assertSame([$right], $dl->getRights());
        $this->assertFalse($dl->isOwner());
        $this->assertFalse($dl->isMember());
        $this->assertFalse($dl->isDynamic());

        $dl = new MockDistributionListInfo($name, $id, [new KeyValuePair($key, $value)], [], [], [], FALSE, FALSE, FALSE);
        $dl->setMembers([$member1])
            ->addMember($member2)
            ->setOwners([$owner])
            ->addOwner($owner)
            ->setRights([$right])
            ->addRight($right)
            ->setIsOwner(TRUE)
            ->setIsMember(TRUE)
            ->setDynamic(TRUE);
        $this->assertSame([$member1, $member2], $dl->getMembers());
        $this->assertSame([$owner, $owner], $dl->getOwners());
        $this->assertSame([$right, $right], $dl->getRights());
        $this->assertTrue($dl->isOwner());
        $this->assertTrue($dl->isMember());
        $this->assertTrue($dl->isDynamic());
        $dl->setOwners([$owner])->setRights([$right]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" isOwner="true" isMember="true" dynamic="true" xmlns:urn="urn:zimbraAccount">
    <urn:a n="$key">$value</urn:a>
    <urn:dlm>$member1</urn:dlm>
    <urn:dlm>$member2</urn:dlm>
    <urn:owners>
        <urn:owner type="usr" id="$id" name="$name" />
    </urn:owners>
    <urn:rights>
        <urn:right right="$name">
            <urn:grantee type="usr" id="$id" name="$name" />
        </urn:right>
    </urn:rights>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, MockDistributionListInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
class MockDistributionListInfo extends DistributionListInfo
{
}
