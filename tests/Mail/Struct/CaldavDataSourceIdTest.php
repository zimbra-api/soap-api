<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CaldavDataSourceId;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CaldavDataSourceId.
 */
class CaldavDataSourceIdTest extends ZimbraTestCase
{
    public function testCaldavDataSourceId()
    {
        $id = $this->faker->uuid;
        $caldav = new CaldavDataSourceId($id);
        $this->assertTrue($caldav instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($caldav, 'xml'));
        $this->assertEquals($caldav, $this->serializer->deserialize($xml, CaldavDataSourceId::class, 'xml'));
    }
}
