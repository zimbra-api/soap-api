<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\Importance;
use Zimbra\Mail\Struct\ImportanceTest;

/**
 * Testcase class for ImportanceTest.
 */
class ImportanceTestTest extends ZimbraMailTestCase
{
    public function testImportanceTest()
    {
        $index = mt_rand(1, 10);
        $importanceTest = new ImportanceTest(
            $index, Importance::HIGH(), true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $importanceTest);
        $this->assertTrue($importanceTest->getImportance()->is('high'));
        $importanceTest->setImportance(Importance::HIGH());
        $this->assertTrue($importanceTest->getImportance()->is('high'));

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<importanceTest index="' . $index . '" negative="true" imp="' . Importance::HIGH() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $importanceTest);

        $array = array(
            'importanceTest' => array(
                'index' => $index,
                'negative' => true,
                'imp' => Importance::HIGH()->value(),
            ),
        );
        $this->assertEquals($array, $importanceTest->toArray());
    }
}
