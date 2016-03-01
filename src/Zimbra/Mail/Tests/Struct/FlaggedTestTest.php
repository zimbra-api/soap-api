<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FlaggedTest;

/**
 * Testcase class for FlaggedTest.
 */
class FlaggedTestTest extends ZimbraMailTestCase
{
    public function testFlaggedTest()
    {
        $index = mt_rand(1, 10);
        $flag = $this->faker->word;
        $flaggedTest = new FlaggedTest(
            $index, $flag, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $flaggedTest);
        $this->assertSame($flag, $flaggedTest->getFlag());
        $flaggedTest->setFlag($flag);
        $this->assertSame($flag, $flaggedTest->getFlag());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<flaggedTest index="' . $index . '" negative="true" flagName="' . $flag . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $flaggedTest);

        $array = array(
            'flaggedTest' => array(
                'index' => $index,
                'negative' => true,
                'flagName' => $flag,
            ),
        );
        $this->assertEquals($array, $flaggedTest->toArray());
    }
}
