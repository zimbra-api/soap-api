<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Common\Enum\TargetBy;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EffectiveRightsTargetSelector.
 */
class EffectiveRightsTargetSelectorTest extends ZimbraTestCase
{
    public function testEffectiveRightsTargetSelector()
    {
        $value = $this->faker->word;
        $target = new EffectiveRightsTargetSelector(
            TargetType::DOMAIN, TargetBy::ID, $value
        );
        $this->assertEquals(TargetType::DOMAIN, $target->getType());
        $this->assertEquals(TargetBy::ID, $target->getBy());
        $this->assertSame($value, $target->getValue());

        $target = new EffectiveRightsTargetSelector();
        $target->setType(TargetType::ACCOUNT)
               ->setBy(TargetBy::NAME)
               ->setValue($value);
        $this->assertEquals(TargetType::ACCOUNT, $target->getType());
        $this->assertEquals(TargetBy::NAME, $target->getBy());
        $this->assertSame($value, $target->getValue());

        $type = TargetType::ACCOUNT->value;
        $by = TargetBy::NAME->value;
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" by="$by">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, EffectiveRightsTargetSelector::class, 'xml'));
    }
}
