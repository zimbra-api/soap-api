<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ReindexProgressInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ReindexProgressInfo.
 */
class ReindexProgressInfoTest extends ZimbraTestCase
{
    public function testReindexProgressInfo()
    {
        $numSucceeded = mt_rand(1, 100);
        $numFailed = mt_rand(1, 100);
        $numRemaining = mt_rand(1, 100);

        $progress = new ReindexProgressInfo($numSucceeded, $numFailed, $numRemaining);
        $this->assertSame($numSucceeded, $progress->getNumSucceeded());
        $this->assertSame($numFailed, $progress->getNumFailed());
        $this->assertSame($numRemaining, $progress->getNumRemaining());

        $progress = new ReindexProgressInfo(0, 0, 0);
        $progress->setNumSucceeded($numSucceeded)
             ->setNumFailed($numFailed)
             ->setNumRemaining($numRemaining);
        $this->assertSame($numSucceeded, $progress->getNumSucceeded());
        $this->assertSame($numFailed, $progress->getNumFailed());
        $this->assertSame($numRemaining, $progress->getNumRemaining());

        $xml = <<<EOT
<?xml version="1.0"?>
<progress numSucceeded="$numSucceeded" numFailed="$numFailed" numRemaining="$numRemaining" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($progress, 'xml'));
        $this->assertEquals($progress, $this->serializer->deserialize($xml, ReindexProgressInfo::class, 'xml'));

        $json = json_encode([
            'numSucceeded' => $numSucceeded,
            'numFailed' => $numFailed,
            'numRemaining' => $numRemaining,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($progress, 'json'));
        $this->assertEquals($progress, $this->serializer->deserialize($json, ReindexProgressInfo::class, 'json'));
    }
}
