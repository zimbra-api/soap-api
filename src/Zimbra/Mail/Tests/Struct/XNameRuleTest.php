<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\XNameRule;

/**
 * Testcase class for XNameRule.
 */
class XNameRuleTest extends ZimbraMailTestCase
{
    public function testXNameRule()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $xname = new XNameRule($name, $value);
        $this->assertSame($name, $xname->getName());
        $this->assertSame($value, $xname->getValue());

        $xname = new XNameRule();
        $xname->setName($name)
              ->setValue($value);
        $this->assertSame($name, $xname->getName());
        $this->assertSame($value, $xname->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<rule-x-name name="' . $name . '" value="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xname);

        $array = array(
            'rule-x-name' => array(
                'name' => $name,
                'value' => $value,
            ),
        );
        $this->assertEquals($array, $xname->toArray());
    }
}
