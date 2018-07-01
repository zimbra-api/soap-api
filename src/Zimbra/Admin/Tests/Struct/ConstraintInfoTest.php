<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\ConstraintInfoValues;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConstraintInfo.
 */
class ConstraintInfoTest extends ZimbraStructTestCase
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

        $constraint = new ConstraintInfo();
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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($constraint, 'xml'));

        $constraint = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ConstraintInfo', 'xml');
        $values = $constraint->getValues();
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame([$value], $values->getValues());
    }
}
