<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ImapDataSourceId;
use Zimbra\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImapDataSourceId.
 */
class ImapDataSourceIdTest extends ZimbraTestCase
{
    public function testImapDataSourceId()
    {
        $id = $this->faker->uuid;
        $imap = new ImapDataSourceId($id);
        $this->assertTrue($imap instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($imap, 'xml'));
        $this->assertEquals($imap, $this->serializer->deserialize($xml, ImapDataSourceId::class, 'xml'));

        $json = json_encode([
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($imap, 'json'));
        $this->assertEquals($imap, $this->serializer->deserialize($json, ImapDataSourceId::class, 'json'));
    }
}
