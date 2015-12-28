<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;

/**
 * Testcase class for EffectiveRightsTargetSelector.
 */
class EffectiveRightsTargetSelectorTest extends ZimbraAdminTestCase
{
    public function testEffectiveRightsTargetSelector()
    {
        $value = $this->faker->word;
        $target = new EffectiveRightsTargetSelector(
            TargetType::DOMAIN(), TargetBy::ID(), $value
        );
        $this->assertTrue($target->getType()->is('domain'));
        $this->assertSame($value, $target->getValue());
        $this->assertSame('id', $target->getBy()->value());

        $target->setType(TargetType::ACCOUNT())
               ->setBy(TargetBy::NAME());

        $this->assertSame('account', $target->getType()->value());
        $this->assertSame('name', $target->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = [
            'target' => [
                'type' => TargetType::ACCOUNT()->value(),
                '_content' => $value,
                'by' => TargetBy::NAME()->value(),
            ],
        ];
        $this->assertEquals($array, $target->toArray());
    }
}
