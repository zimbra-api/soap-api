<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FilterTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FilterTest.
 */
class FilterTestTest extends ZimbraTestCase
{
    public function testFilterTest()
    {
        $index = mt_rand(1, 99);

        $test = new FilterTest($index, FALSE);
        $this->assertSame($index, $test->getIndex());
        $this->assertFalse($test->isNegative());

        $test = new FilterTest();
        $test->setIndex($index)
            ->setNegative(TRUE);
        $this->assertSame($index, $test->getIndex());
        $this->assertTrue($test->isNegative());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, FilterTest::class, 'xml'));
    }
}
