<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailboxStats;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailboxStats.
 */
class MailboxStatsTest extends ZimbraTestCase
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

        $stats = new MailboxStats();
        $stats->setNumMboxes($numMboxes)
             ->setTotalSize($totalSize);
        $this->assertSame($numMboxes, $stats->getNumMboxes());
        $this->assertSame($totalSize, $stats->getTotalSize());

        $xml = <<<EOT
<?xml version="1.0"?>
<result numMboxes="$numMboxes" totalSize="$totalSize" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stats, 'xml'));
        $this->assertEquals($stats, $this->serializer->deserialize($xml, MailboxStats::class, 'xml'));
    }
}
