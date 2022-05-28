<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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
            $id, $name, GranteeType::USR()
        );

        $dl = new DistributionListInfo($name, $id, [$member1], [], [$owner], FALSE);
        $this->assertFalse($dl->isDynamic());
        $this->assertSame([$member1], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());

        $dl = new DistributionListInfo($name, $id);
        $dl->setDynamic(TRUE)
           ->setMembers([$member1])
           ->addMember($member2)
           ->setOwners([$owner])
           ->addOwner($owner);
        $this->assertTrue($dl->isDynamic());
        $this->assertSame([$member1, $member2], $dl->getMembers());
        $this->assertSame([$owner, $owner], $dl->getOwners());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" dynamic="true">
    <dlm>$member1</dlm>
    <dlm>$member2</dlm>
    <owners>
        <owner id="$id" name="$name" type="usr" />
        <owner id="$id" name="$name" type="usr" />
    </owners>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'dynamic' => TRUE,
            'dlm' => [
                ['_content' => $member1],
                ['_content' => $member2],
            ],
            'owners' => [
                'owner' => [
                    [
                        'id' => $id,
                        'name' => $name,
                        'type' => 'usr',
                    ],
                    [
                        'id' => $id,
                        'name' => $name,
                        'type' => 'usr',
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListInfo::class, 'json'));
    }
}
