<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FilterTest;

/**
 * Testcase class for FilterTest.
 */
class FilterTestTest extends ZimbraMailTestCase
{
    public function testFilterTest()
    {
        $index = mt_rand(1, 10);
        $filterTest = new FilterTest(
            $index, true
        );
        $this->assertSame($index, $filterTest->getIndex());
        $this->assertTrue($filterTest->getNegative());

        $filterTest->setIndex($index)
                   ->setNegative(true);
        $this->assertSame($index, $filterTest->getIndex());
        $this->assertTrue($filterTest->getNegative());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<filterTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterTest);

        $array = array(
            'filterTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $filterTest->toArray());
    }
}
