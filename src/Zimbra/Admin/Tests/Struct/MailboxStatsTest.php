<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MailboxStats;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailboxStats.
 */
class MailboxStatsTest extends ZimbraStructTestCase
{
    public function testMailboxStats()
    {
        $numMboxes = mt_rand(1, 100);
        $totalSize = mt_rand(1, 100);

        $stats = new MailboxStats(
            $numMboxes, $totalSize
        );
        $this->assertSame($numMboxes, $stats->getNumMboxes());
        $this->assertSame($totalSize, $stats->getTotalSize());

        $stats = new MailboxStats(0, 0);
        $stats->setNumMboxes($numMboxes)
             ->setTotalSize($totalSize);
        $this->assertSame($numMboxes, $stats->getNumMboxes());
        $this->assertSame($totalSize, $stats->getTotalSize());

        $xml = <<<EOT
<?xml version="1.0"?>
<stats numMboxes="$numMboxes" totalSize="$totalSize" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, MailboxStats::class, 'xml'));

        $json = json_encode([
            'numMboxes' => $numMboxes,
            'totalSize' => $totalSize,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stats, 'json'));
        $this->assertEquals($stats, $this->serializer->deserialize($json, MailboxStats::class, 'json'));
    }
}
