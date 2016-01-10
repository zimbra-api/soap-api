<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\SizeTest;

/**
 * Testcase class for SizeTest.
 */
class SizeTestTest extends ZimbraMailTestCase
{
    public function testSizeTest()
    {
        $index = mt_rand(1, 10);
        $numberComparison = $this->faker->word;
        $s = $this->faker->word;
        $sizeTest = new SizeTest(
            $index, $numberComparison, $s, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $sizeTest);
        $this->assertSame($numberComparison, $sizeTest->getNumberComparison());
        $this->assertSame($s, $sizeTest->getSize());

        $sizeTest = new SizeTest(
            $index, '', '', true
        );
        $sizeTest->setNumberComparison($numberComparison)
                 ->setSize($s);
        $this->assertSame($numberComparison, $sizeTest->getNumberComparison());
        $this->assertSame($s, $sizeTest->getSize());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<sizeTest index="' . $index . '" negative="true" numberComparison="' . $numberComparison . '" s="' . $s . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sizeTest);

        $array = array(
            'sizeTest' => array(
                'index' => $index,
                'negative' => true,
                'numberComparison' => $numberComparison,
                's' => $s,
            ),
        );
        $this->assertEquals($array, $sizeTest->toArray());
    }
}
