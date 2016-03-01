<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\ConstraintInfoValues;

/**
 * Testcase class for ConstraintInfo.
 */
class ConstraintInfoTest extends ZimbraAdminTestCase
{
    public function testConstraintInfo()
    {
        $value = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $values = new ConstraintInfoValues([$value]);
        $constraint = new ConstraintInfo($max, $min, $values);
        $this->assertSame($max, $constraint->getMin());
        $this->assertSame($min, $constraint->getMax());
        $this->assertSame($values, $constraint->getValues());

        $constraint->setMin($min)
            ->setMax($max)
            ->setValues($values);
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame($values, $constraint->getValues());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<constraint>'
                . '<min>' . $min . '</min>'
                . '<max>' . $max . '</max>'
                . '<values>'
                    . '<v>' . $value . '</v>'
                . '</values>'
            . '</constraint>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $constraint);

        $array = [
            'constraint' => [
                'min' => $min,
                'max' => $max,
                'values' => [
                    'v' => [
                        $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $constraint->toArray());
    }
}
