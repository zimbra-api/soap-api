<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\SimpleSearchHit;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SimpleSearchHit.
 */
class SimpleSearchHitTest extends ZimbraTestCase
{
    public function testSimpleSearchHit()
    {
        $id = $this->faker->uuid;
        $sortField = $this->faker->word;

        $hit = new SimpleSearchHit($id, $sortField);
        $this->assertSame($id, $hit->getId());
        $this->assertSame($sortField, $hit->getSortField());

        $hit = new SimpleSearchHit();
        $hit->setId($id)
            ->setSortField($sortField);
        $this->assertSame($id, $hit->getId());
        $this->assertSame($sortField, $hit->getSortField());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" sf="$sortField" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, SimpleSearchHit::class, 'xml'));
    }
}
