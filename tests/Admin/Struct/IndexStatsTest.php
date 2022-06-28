<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\IndexStats;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IndexStats.
 */
class IndexStatsTest extends ZimbraTestCase
{
    public function testIndexStats()
    {
        $maxDocs = mt_rand(1, 100);
        $numDeletedDocs = mt_rand(1, 100);

        $stats = new IndexStats($maxDocs, $numDeletedDocs);
        $this->assertSame($maxDocs, $stats->getMaxDocs());
        $this->assertSame($numDeletedDocs, $stats->getNumDeletedDocs());

        $stats = new IndexStats();
        $stats->setMaxDocs($maxDocs)
             ->setNumDeletedDocs($numDeletedDocs);
        $this->assertSame($maxDocs, $stats->getMaxDocs());
        $this->assertSame($numDeletedDocs, $stats->getNumDeletedDocs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result maxDocs="$maxDocs" deletedDocs="$numDeletedDocs" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, IndexStats::class, 'xml'));
    }
}
