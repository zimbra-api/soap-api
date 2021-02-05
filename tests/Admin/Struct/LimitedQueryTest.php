<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\LimitedQuery;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LimitedQuery.
 */
class LimitedQueryTest extends ZimbraTestCase
{
    public function testLimitedQuery()
    {
        $limit = mt_rand(0, 10);
        $value = $this->faker->word;

        $query = new LimitedQuery($limit, $value);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($value, $query->getValue());

        $query = new LimitedQuery();
        $query->setLimit($limit)
              ->setValue($value);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($value, $query->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<query limit="$limit">$value</query>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($query, 'xml'));
        $this->assertEquals($query, $this->serializer->deserialize($xml, LimitedQuery::class, 'xml'));

        $json = json_encode([
            'limit' => $limit,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($query, 'json'));
        $this->assertEquals($query, $this->serializer->deserialize($json, LimitedQuery::class, 'json'));
    }
}