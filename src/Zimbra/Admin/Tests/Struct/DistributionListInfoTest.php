<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListInfo.
 */
class DistributionListInfoTest extends ZimbraStructTestCase
{
    public function testDistributionListInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;

        $owner1 = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $owner2 = new GranteeInfo(
            $id, $name, GranteeType::USR()
        );

        $dl = new DistributionListInfo($name, $id, [$member1], [], [$owner1], FALSE);
        $this->assertFalse($dl->isDynamic());
        $this->assertSame([$member1], $dl->getMembers());
        $this->assertSame([$owner1], $dl->getOwners());

        $dl = new DistributionListInfo($name, $id);
        $dl->setDynamic(TRUE)
           ->setMembers([$member1])
           ->addMember($member2)
           ->setOwners([$owner1])
           ->addOwner($owner2);
        $this->assertTrue($dl->isDynamic());
        $this->assertSame([$member1, $member2], $dl->getMembers());
        $this->assertSame([$owner1, $owner2], $dl->getOwners());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dl name="' . $name . '" id="' . $id . '" dynamic="true">'
                . '<dlm>' . $member1 . '</dlm>'
                . '<dlm>' . $member2 . '</dlm>'
                . '<owners>'
                    . '<owner id="' . $id . '" name="' . $name . '" type="' . GranteeType::ALL() . '" />'
                    . '<owner id="' . $id . '" name="' . $name . '" type="' . GranteeType::USR() . '" />'
                . '</owners>'
            . '</dl>';
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
                        'type' => (string) GranteeType::ALL(),
                    ],
                    [
                        'id' => $id,
                        'name' => $name,
                        'type' => (string) GranteeType::USR(),
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListInfo::class, 'json'));
    }
}
