<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListGranteeSelector.
 */
class DistributionListGranteeSelectorTest extends ZimbraStructTestCase
{
    public function testDistributionListGranteeSelector()
    {
        $value = $this->faker->word;
        $grantee = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::ID(), $value);
        $this->assertEquals(GranteeType::ALL(), $grantee->getType());
        $this->assertEquals(DLGranteeBy::ID(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());

        $grantee = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::ID());
        $grantee->setType(GranteeType::USR())
                ->setBy(DLGranteeBy::NAME())
                ->setValue($value);
        $this->assertEquals(GranteeType::USR(), $grantee->getType());
        $this->assertEquals(DLGranteeBy::NAME(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, DistributionListGranteeSelector::class, 'xml'));

        $json = json_encode([
            'type' => (string) GranteeType::USR(),
            'by' => (string) DLGranteeBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, DistributionListGranteeSelector::class, 'json'));
    }
}
