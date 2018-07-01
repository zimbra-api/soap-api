<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfoValues;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConstraintInfoValues.
 */
class ConstraintInfoValuesTest extends ZimbraStructTestCase
{
    public function testConstraintInfoValues()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;

        $values = new ConstraintInfoValues([$value1]);
        $this->assertSame([$value1], $values->getValues());
        $values->addValue($value2);
        $this->assertSame([$value1, $value2], $values->getValues());

        $xml = '<?xml version="1.0"?>' . "\n"
                . '<values>'
                    . '<v>' . $value1 . '</v>'
                    . '<v>' . $value2 . '</v>'
                . '</values>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($values, 'xml'));

        $values = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ConstraintInfoValues', 'xml');
        $this->assertSame([$value1, $value2], $values->getValues());
    }
}
