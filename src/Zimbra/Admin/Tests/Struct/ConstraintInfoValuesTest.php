<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ConstraintInfoValues;

/**
 * Testcase class for ConstraintInfoValues.
 */
class ConstraintInfoValuesTest extends ZimbraAdminTestCase
{
    public function testConstraintInfoValues()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;

        $values = new ConstraintInfoValues([$value1]);
        $this->assertSame([$value1], $values->getValues()->all());
        $values->addValue($value2);
        $this->assertSame([$value1, $value2], $values->getValues()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
                . '<values>'
                    . '<v>' . $value1 . '</v>'
                    . '<v>' . $value2 . '</v>'
                . '</values>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $values);

        $array = [
            'values' => [
                'v' => [
                    $value1,
                    $value2,
                ],
            ],
        ];
        $this->assertEquals($array, $values->toArray());
    }
}
