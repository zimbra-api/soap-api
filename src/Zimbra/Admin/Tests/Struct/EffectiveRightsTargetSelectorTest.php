<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for EffectiveRightsTargetSelector.
 */
class EffectiveRightsTargetSelectorTest extends ZimbraStructTestCase
{
    public function testEffectiveRightsTargetSelector()
    {
        $value = $this->faker->word;
        $target = new EffectiveRightsTargetSelector(
            TargetType::DOMAIN()->value(), TargetBy::ID()->value(), $value
        );
        $this->assertSame(TargetType::DOMAIN()->value(), $target->getType());
        $this->assertSame(TargetBy::ID()->value(), $target->getBy());
        $this->assertSame($value, $target->getValue());

        $target = new EffectiveRightsTargetSelector('', '');
        $target->setType(TargetType::ACCOUNT()->value())
               ->setBy(TargetBy::NAME()->value())
               ->setValue($value);
        $this->assertSame(TargetType::ACCOUNT()->value(), $target->getType());
        $this->assertSame(TargetBy::NAME()->value(), $target->getBy());
        $this->assertSame($value, $target->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));

        $target = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\EffectiveRightsTargetSelector', 'xml');
        $this->assertSame(TargetType::ACCOUNT()->value(), $target->getType());
        $this->assertSame(TargetBy::NAME()->value(), $target->getBy());
        $this->assertSame($value, $target->getValue());
    }
}
