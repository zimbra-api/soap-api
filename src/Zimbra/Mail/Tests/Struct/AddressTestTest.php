<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AddressTest;

/**
 * Testcase class for AddressTest.
 */
class AddressTestTest extends ZimbraMailTestCase
{
    public function testAddressTest()
    {
        $index = mt_rand(1, 100);
        $header = $this->faker->word;
        $part = $this->faker->word;
        $comparison = $this->faker->word;
        $value = $this->faker->word;

        $addressTest = new AddressTest(
            $index, $header, $part, $comparison, $value, true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $addressTest);
        $this->assertSame($header, $addressTest->getHeader());
        $this->assertSame($part, $addressTest->getPart());
        $this->assertSame($comparison, $addressTest->getComparison());
        $this->assertSame($value, $addressTest->getValue());
        $this->assertTrue($addressTest->getCaseSensitive());

        $addressTest->setHeader($header)
                    ->setPart($part)
                    ->setComparison($comparison)
                    ->setValue($value)
                    ->setCaseSensitive(true);
        $this->assertSame($header, $addressTest->getHeader());
        $this->assertSame($part, $addressTest->getPart());
        $this->assertSame($comparison, $addressTest->getComparison());
        $this->assertSame($value, $addressTest->getValue());
        $this->assertTrue($addressTest->getCaseSensitive());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<addressTest index="' . $index . '" negative="true" header="' . $header . '" part="' . $part . '" stringComparison="' . $comparison . '" value="' . $value . '" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $addressTest);

        $array = array(
            'addressTest' => array(
                'index' => $index,
                'negative' => true,
                'header' => $header,
                'part' => $part,
                'stringComparison' => $comparison,
                'value' => $value,
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $addressTest->toArray());
    }
}
