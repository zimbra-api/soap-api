<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\IndexStats;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for IndexStats.
 */
class IndexStatsTest extends ZimbraStructTestCase
{
    public function testIndexStats()
    {
        $maxDocs = mt_rand(1, 100);
        $numDeletedDocs = mt_rand(1, 100);

        $stats = new IndexStats($maxDocs, $numDeletedDocs);
        $this->assertSame($maxDocs, $stats->getMaxDocs());
        $this->assertSame($numDeletedDocs, $stats->getNumDeletedDocs());

        $stats = new IndexStats(0, 0);
        $stats->setMaxDocs($maxDocs)
             ->setNumDeletedDocs($numDeletedDocs);
        $this->assertSame($maxDocs, $stats->getMaxDocs());
        $this->assertSame($numDeletedDocs, $stats->getNumDeletedDocs());

        $xml = <<<EOT
<?xml version="1.0"?>
<stats maxDocs="$maxDocs" deletedDocs="$numDeletedDocs" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, IndexStats::class, 'xml'));

        $json = json_encode([
            'maxDocs' => $maxDocs,
            'deletedDocs' => $numDeletedDocs,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stats, 'json'));
        $this->assertEquals($stats, $this->serializer->deserialize($json, IndexStats::class, 'json'));
    }
}
