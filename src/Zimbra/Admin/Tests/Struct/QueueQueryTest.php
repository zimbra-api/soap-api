<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\QueueQuery;
use Zimbra\Admin\Struct\QueueQueryField;
use Zimbra\Admin\Struct\ValueAttrib;

/**
 * Testcase class for QueueQuery.
 */
class QueueQueryTest extends ZimbraAdminTestCase
{
    public function testQueueQuery()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $match = new ValueAttrib($value);
        $field = new QueueQueryField($name, [$match]);

        $query = new QueueQuery([$field], $limit, $offset);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field], $query->getFields()->all());

        $query->setLimit($limit)
              ->setOffset($offset)
              ->addField($field);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field, $field], $query->getFields()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<query limit="' . $limit . '" offset="' . $offset . '">'
                . '<field name="' . $name . '">'
                    . '<match value="' . $value . '" />'
                . '</field>'
                . '<field name="' . $name . '">'
                    . '<match value="' . $value . '" />'
                . '</field>'
            . '</query>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $query);

        $array = [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
                'field' => [
                    [
                        'name' => $name,
                        'match' => [
                            [
                                'value' => $value,
                            ],
                        ],
                    ],
                    [
                        'name' => $name,
                        'match' => [
                            [
                                'value' => $value,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $query->toArray());
    }
}
