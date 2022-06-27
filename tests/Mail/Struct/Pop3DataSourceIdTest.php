<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Pop3DataSourceId;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Pop3DataSourceId.
 */
class Pop3DataSourceIdTest extends ZimbraTestCase
{
    public function testPop3DataSourceId()
    {
        $id = $this->faker->uuid;
        $pop3 = new Pop3DataSourceId($id);
        $this->assertTrue($pop3 instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($pop3, 'xml'));
        $this->assertEquals($pop3, $this->serializer->deserialize($xml, Pop3DataSourceId::class, 'xml'));
    }
}
