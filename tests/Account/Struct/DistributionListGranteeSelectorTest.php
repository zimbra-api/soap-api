<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListGranteeSelector.
 */
class DistributionListGranteeSelectorTest extends ZimbraTestCase
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

        $type = GranteeType::USR()->getValue();
        $by = DLGranteeBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<grantee type="$type" by="$by">$value</grantee>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, DistributionListGranteeSelector::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'by' => $by,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, DistributionListGranteeSelector::class, 'json'));
    }
}
