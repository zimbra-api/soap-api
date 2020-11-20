<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListRightSpec.
 */
class DistributionListRightSpecTest extends ZimbraStructTestCase
{
    public function testDistributionListRightSpec()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $grantee1 = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value1);
        $grantee2 = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value2);

        $right = new DistributionListRightSpec($name, [$grantee1]);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1], $right->getGrantees());

        $right = new DistributionListRightSpec('');
        $right->setRight($name)
              ->setGrantees([$grantee1])
              ->addGrantee($grantee2);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1, $grantee2], $right->getGrantees());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right right="' . $name . '">'
                . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value1 . '</grantee>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value2 . '</grantee>'
            . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, DistributionListRightSpec::class, 'xml'));

        $json = json_encode([
            'right' => $name,
            'grantee' => [
                [
                    'type' => (string) GranteeType::ALL(),
                    'by' => (string) DLGranteeBy::NAME(),
                    '_content' => $value1,
                ],
                [
                    'type' => (string) GranteeType::USR(),
                    'by' => (string) DLGranteeBy::ID(),
                    '_content' => $value2,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, DistributionListRightSpec::class, 'json'));
    }
}
