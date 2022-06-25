<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\Offset;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Offset.
 */
class OffsetTest extends ZimbraTestCase
{
    public function testOffset()
    {
        $value = mt_rand(0, 100);
        $offset = new Offset($value);
        $this->assertSame($value, $offset->getOffset());

        $offset = new Offset(0);
        $offset->setOffset($value);
        $this->assertSame($value, $offset->getOffset());

        $xml = <<<EOT
<?xml version="1.0"?>
<result offset="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($offset, 'xml'));
        $this->assertEquals($offset, $this->serializer->deserialize($xml, Offset::class, 'xml'));
    }
}
