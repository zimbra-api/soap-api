<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CalDataSourceId;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalDataSourceId.
 */
class CalDataSourceIdTest extends ZimbraTestCase
{
    public function testCalDataSourceId()
    {
        $id = $this->faker->uuid;
        $cal = new CalDataSourceId($id);
        $this->assertTrue($cal instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cal, 'xml'));
        $this->assertEquals($cal, $this->serializer->deserialize($xml, CalDataSourceId::class, 'xml'));
    }
}
