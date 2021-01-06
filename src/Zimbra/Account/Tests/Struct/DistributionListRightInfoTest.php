<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\DistributionListRightInfo;
use Zimbra\Account\Struct\DistributionListGranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListRightInfo.
 */
class DistributionListRightInfoTest extends ZimbraStructTestCase
{
    public function testDistributionListRightInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $right = $this->faker->word;
        $type = GranteeType::USR();

        $grantee = new DistributionListGranteeInfo(
            $type, $id, $name
        );

        $info = new DistributionListRightInfo(
            $right, [$grantee]
        );
        $this->assertSame($right, $info->getRight());
        $this->assertSame([$grantee], $info->getGrantees());

        $info = new DistributionListRightInfo('');
        $info->setRight($right)
            ->setGrantees([$grantee])
            ->addGrantee($grantee);
        $this->assertSame($right, $info->getRight());
        $this->assertSame([$grantee, $grantee], $info->getGrantees());
        $info->setGrantees([$grantee]);

        $xml = <<<EOT
<?xml version="1.0"?>
<info right="$right">
    <grantee type="usr" id="$id" name="$name" />
</info>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, DistributionListRightInfo::class, 'xml'));

        $json = json_encode([
            'right' => $right,
            'grantee' => [
                [
                    'type' => 'usr',
                    'id' => $id,
                    'name' => $name,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, DistributionListRightInfo::class, 'json'));
    }
}
