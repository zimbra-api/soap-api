<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\YabDataSourceId;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for YabDataSourceId.
 */
class YabDataSourceIdTest extends ZimbraTestCase
{
    public function testYabDataSourceId()
    {
        $id = $this->faker->uuid;
        $yab = new YabDataSourceId($id);
        $this->assertTrue($yab instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($yab, 'xml'));
        $this->assertEquals($yab, $this->serializer->deserialize($xml, YabDataSourceId::class, 'xml'));
    }
}
