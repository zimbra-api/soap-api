<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\ConstraintInfoValues;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConstraintAttr.
 */
class ConstraintAttrTest extends ZimbraStructTestCase
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

        $attr = new ConstraintAttr(new ConstraintInfo(), '');
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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));

        $attr = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ConstraintAttr', 'xml');
        $constraint = $attr->getConstraint();
        $values = $constraint->getValues();
        $this->assertSame($name, $attr->getName());
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame([$value], $values->getValues());
    }
}
