<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\BufferedCommitInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BufferedCommitInfo.
 */
class BufferedCommitInfoTest extends ZimbraTestCase
{
    public function testBufferedCommitInfo()
    {
        $aid = $this->faker->uuid;
        $cid = $this->faker->uuid;
        $commit = new BufferedCommitInfo($aid, $cid);
        $this->assertSame($aid, $commit->getAid());
        $this->assertSame($cid, $commit->getCid());

        $commit = new BufferedCommitInfo();
        $commit->setAid($aid)
            ->setCid($cid);
        $this->assertSame($aid, $commit->getAid());
        $this->assertSame($cid, $commit->getCid());

        $xml = <<<EOT
<?xml version="1.0"?>
<result aid="$aid" cid="$cid" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($commit, 'xml'));
        $this->assertEquals($commit, $this->serializer->deserialize($xml, BufferedCommitInfo::class, 'xml'));
    }
}
