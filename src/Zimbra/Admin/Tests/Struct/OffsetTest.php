<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\Offset;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Offset.
 */
class OffsetTest extends ZimbraStructTestCase
{
    public function testOffset()
    {
        $value = mt_rand(0, 100);
        $offset = new Offset($value);
        $this->assertSame($value, $offset->getOffset());

        $offset = new Offset(0);
        $offset->setOffset($value);
        $this->assertSame($value, $offset->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<offset offset="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($offset, 'xml'));

        $offset = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\Offset', 'xml');
        $this->assertSame($value, $offset->getOffset());
    }
}
