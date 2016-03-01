<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\MemberType;
use Zimbra\Mail\Struct\ModifyContactSpec;
use Zimbra\Mail\Struct\ModifyContactAttr;
use Zimbra\Mail\Struct\ModifyContactGroupMember;

/**
 * Testcase class for ModifyContactSpec.
 */
class ModifyContactSpecTest extends ZimbraMailTestCase
{
    public function testModifyContactSpec()
    {
        $id = mt_rand(1, 10);
        $name = $this->faker->word;
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $part = $this->faker->word;
        $op = $this->faker->randomElement(['+', '-', 'reset']);
        $tn = $this->faker->word;

        $a = new ModifyContactAttr(
            $name, $value, $aid, $id, $part, $op
        );
        $m = new ModifyContactGroupMember(
            MemberType::CONTACT(), $value, $op
        );

        $cn = new ModifyContactSpec(
            $id, $tn, [$a], [$m]
        );
        $this->assertSame(array($a), $cn->getAttrs()->all());
        $this->assertSame(array($m), $cn->getMembers()->all());
        $this->assertSame($id, $cn->getId());
        $this->assertSame($tn, $cn->getTagNames());

        $cn->addAttr($a)
           ->addMember($m)
           ->setId($id)
           ->setTagNames($tn);
        $this->assertSame(array($a, $a), $cn->getAttrs()->all());
        $this->assertSame(array($m, $m), $cn->getMembers()->all());
        $this->assertSame($id, $cn->getId());
        $this->assertSame($tn, $cn->getTagNames());

        $cn = new ModifyContactSpec(
            $id, $tn, [$a], [$m]
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<cn id="' . $id . '" tn="' . $tn . '">'
                .'<a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '" op="' . $op . '">' . $value . '</a>'
                .'<m type="' . MemberType::CONTACT() . '" value="' . $value . '" op="' . $op . '" />'
            .'</cn>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cn);

        $array = array(
            'cn' => array(
                'id' => $id,
                'tn' => $tn,
                'a' => array(
                    array(
                        'n' => $name,
                        '_content' => $value,
                        'aid' => $aid,
                        'id' => $id,
                        'part' => $part,
                        'op' => $op,
                    ),
                ),
                'm' => array(
                    array(
                        'type' => MemberType::CONTACT()->value(),
                        'value' => $value,
                        'op' => $op,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $cn->toArray());
    }
}
