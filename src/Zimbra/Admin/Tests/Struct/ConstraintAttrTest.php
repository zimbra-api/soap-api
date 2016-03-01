<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\ConstraintInfoValues;

/**
 * Testcase class for ConstraintAttr.
 */
class ConstraintAttrTest extends ZimbraAdminTestCase
{
    public function testConstraintAttr()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $values = new ConstraintInfoValues([$value]);
        $constraint = new ConstraintInfo($min, $max, $values);
        $attr = new ConstraintAttr($constraint, $name);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $attr->setName($name)
            ->setConstraint($constraint);

        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a name="' . $name . '">'
                . '<constraint>'
                    . '<min>' . $min . '</min>'
                    . '<max>' . $max . '</max>'
                    . '<values>'
                        . '<v>' . $value . '</v>'
                    . '</values>'
                . '</constraint>'
            . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'a' => [
                'name' => $name,
                'constraint' => [
                    'min' => $min,
                    'max' => $max,
                    'values' => [
                        'v' => [
                            $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }
}
