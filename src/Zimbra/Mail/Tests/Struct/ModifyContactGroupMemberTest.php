<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\MemberType;
use Zimbra\Mail\Struct\ModifyContactGroupMember;

/**
 * Testcase class for ModifyContactGroupMember.
 */
class ModifyContactGroupMemberTest extends ZimbraMailTestCase
{
    public function testModifyContactGroupMember()
    {
        $value = $this->faker->word;
        $op = $this->faker->randomElement(['+', '-', 'reset']);

        $m = new ModifyContactGroupMember(
            MemberType::CONTACT(), $value, $op
        );
        $this->assertSame('C', $m->getType()->value());
        $this->assertSame($value, $m->getValue());
        $this->assertSame($op, $m->getOperation());

        $m->setType(MemberType::CONTACT())
          ->setValue($value)
          ->setOperation($op);
        $this->assertSame('C', $m->getType()->value());
        $this->assertSame($value, $m->getValue());
        $this->assertSame($op, $m->getOperation());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m type="' . MemberType::CONTACT() . '" value="' . $value . '" op="' . $op . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'type' => MemberType::CONTACT()->value(),
                'value' => $value,
                'op' => $op,
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
