<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ContactRankingTest;

/**
 * Testcase class for ContactRankingTest.
 */
class ContactRankingTestTest extends ZimbraMailTestCase
{
    public function testContactRankingTest()
    {
        $index = mt_rand(1, 10);
        $header = $this->faker->word;

        $contactRankingTest = new ContactRankingTest(
            $index, $header, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $contactRankingTest);
        $this->assertSame($header, $contactRankingTest->getHeader());
        $contactRankingTest->setHeader($header);
        $this->assertSame($header, $contactRankingTest->getHeader());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<contactRankingTest index="' . $index . '" negative="true" header="' . $header . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $contactRankingTest);

        $array = array(
            'contactRankingTest' => array(
                'index' => $index,
                'negative' => true,
                'header' => $header,
            ),
        );
        $this->assertEquals($array, $contactRankingTest->toArray());
    }
}
