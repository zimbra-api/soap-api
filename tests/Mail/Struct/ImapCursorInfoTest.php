<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ImapCursorInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImapCursorInfo.
 */
class ImapCursorInfoTest extends ZimbraTestCase
{
    public function testImapCursorInfo()
    {
        $id = $this->faker->word;

        $cursor = new ImapCursorInfo($id);
        $this->assertSame($id, $cursor->getId());

        $cursor = new ImapCursorInfo();
        $cursor->setId($id);
        $this->assertSame($id, $cursor->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cursor, 'xml'));
        $this->assertEquals($cursor, $this->serializer->deserialize($xml, ImapCursorInfo::class, 'xml'));
    }
}
