<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Account\Struct\CheckRightsTargetSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightsTargetSpec.
 */
class CheckRightsTargetSpecTest extends ZimbraStructTestCase
{
    public function testCheckRightsTargetSpec()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;
        $right3 = $this->faker->word;

        $target = new CheckRightsTargetSpec(
            TargetType::DOMAIN()->value(), TargetBy::ID()->value(), $key, [$right1, $right2]
        );
        $this->assertSame(TargetType::DOMAIN()->value(), $target->getTargetType());
        $this->assertSame(TargetBy::ID()->value(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2], $target->getRights());

        $target->setTargetType(TargetType::ACCOUNT()->value())
               ->setTargetBy(TargetBy::NAME()->value())
               ->setTargetKey($key)
               ->addRight($right3);

        $this->assertSame(TargetType::ACCOUNT()->value(), $target->getTargetType());
        $this->assertSame(TargetBy::NAME()->value(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2, $right3], $target->getRights());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key . '">'
                . '<right>' . $right1 . '</right>'
                . '<right>' . $right2 . '</right>'
                . '<right>' . $right3 . '</right>'
            . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));

        $target = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\CheckRightsTargetSpec', 'xml');
        $this->assertSame(TargetType::ACCOUNT()->value(), $target->getTargetType());
        $this->assertSame(TargetBy::NAME()->value(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2, $right3], $target->getRights());
    }
}
