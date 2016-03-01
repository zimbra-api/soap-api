<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\ValueAttrib;

/**
 * Testcase class for QueueQueryField.
 */
class QueueQueryFieldTest extends ZimbraAdminTestCase
{
    public function testQueueQueryField()
    {
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $name = $this->faker->word;

        $match1 = new ValueAttrib($value1);
        $match2 = new ValueAttrib($value2);

        $field = new QueueQueryField($name, [$match1]);
        $this->assertSame($name, $field->getName());
        $this->assertSame([$match1], $field->getMatches()->all());

        $field->setName($name)
              ->addMatch($match2);
        $this->assertSame($name, $field->getName());
        $this->assertSame([$match1, $match2], $field->getMatches()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<field name="' . $name . '">'
                . '<match value="' . $value1 . '" />'
                . '<match value="' . $value2 . '" />'
            . '</field>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $field);

        $array = [
            'field' => [
                'name' => $name,
                'match' => [
                    [
                        'value' => $value1,
                    ],
                    [
                        'value' => $value2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $field->toArray());
    }
}
