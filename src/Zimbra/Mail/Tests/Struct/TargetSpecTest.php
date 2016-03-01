<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\TargetType;
use Zimbra\Mail\Struct\TargetSpec;

/**
 * Testcase class for TargetSpec.
 */
class TargetSpecTest extends ZimbraMailTestCase
{
    public function testTargetSpec()
    {
        $value = $this->faker->word;
        $target = new TargetSpec(
            TargetType::DL(), AccountBy::ID(), $value
        );
        $this->assertTrue($target->getTargetType()->is('dl'));
        $this->assertTrue($target->getAccountBy()->is('id'));

        $target->setTargetType(TargetType::ACCOUNT())
               ->setAccountBy(AccountBy::NAME());
        $this->assertTrue($target->getTargetType()->is('account'));
        $this->assertTrue($target->getAccountBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<target type="' . TargetType::ACCOUNT() . '" by="' . AccountBy::NAME() . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = array(
            'target' => array(
                'type' => TargetType::ACCOUNT()->value(),
                'by' => AccountBy::NAME()->value(),
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $target->toArray());
    }
}
