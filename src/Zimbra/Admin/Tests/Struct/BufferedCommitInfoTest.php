<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\BufferedCommitInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BufferedCommitInfo.
 */
class BufferedCommitInfoTest extends ZimbraStructTestCase
{
    public function testBufferedCommitInfo()
    {
        $aid = $this->faker->uuid;
        $cid = $this->faker->uuid;
        $commit = new BufferedCommitInfo($aid, $cid);
        $this->assertSame($aid, $commit->getAid());
        $this->assertSame($cid, $commit->getCid());

        $commit = new BufferedCommitInfo('', '');
        $commit->setAid($aid)
            ->setCid($cid);
        $this->assertSame($aid, $commit->getAid());
        $this->assertSame($cid, $commit->getCid());

        $xml = <<<EOT
<?xml version="1.0"?>
<commit aid="$aid" cid="$cid" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($commit, 'xml'));
        $this->assertEquals($commit, $this->serializer->deserialize($xml, BufferedCommitInfo::class, 'xml'));

        $json = json_encode([
            'aid' => $aid,
            'cid' => $cid,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($commit, 'json'));
        $this->assertEquals($commit, $this->serializer->deserialize($json, BufferedCommitInfo::class, 'json'));
    }
}
