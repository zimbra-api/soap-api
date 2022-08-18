<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListInfo.
 */
class DistributionListInfoTest extends ZimbraTestCase
{
    public function testDistributionListInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $member1 = $this->faker->email;
        $member2 = $this->faker->email;

        $owner = new GranteeInfo(
            $id, $name, GranteeType::USR
        );

        $dl = new StubDistributionListInfo($name, $id, [$member1], [], [$owner], FALSE);
        $this->assertFalse($dl->isDynamic());
        $this->assertSame([$member1], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());

        $dl = new StubDistributionListInfo($name, $id);
        $dl->setDynamic(TRUE)
           ->setMembers([$member1, $member2])
           ->setOwners([$owner, $owner]);
        $this->assertTrue($dl->isDynamic());
        $this->assertSame([$member1, $member2], $dl->getMembers());
        $this->assertSame([$owner, $owner], $dl->getOwners());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" dynamic="true" xmlns:urn="urn:zimbraAdmin">
    <urn:dlm>$member1</urn:dlm>
    <urn:dlm>$member2</urn:dlm>
    <urn:owners>
        <urn:owner id="$id" name="$name" type="usr" />
        <urn:owner id="$id" name="$name" type="usr" />
    </urn:owners>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, StubDistributionListInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubDistributionListInfo extends DistributionListInfo
{
}
