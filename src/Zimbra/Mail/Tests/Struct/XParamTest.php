<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\XParam;

/**
 * Testcase class for XParam.
 */
class XParamTest extends ZimbraMailTestCase
{
    public function testXParam()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $xparam = new XParam($name, $value);
        $this->assertSame($name, $xparam->getName());
        $this->assertSame($value, $xparam->getValue());

        $xparam = new XParam('', '');
        $xparam->setName($name)
              ->setValue($value);
        $this->assertSame($name, $xparam->getName());
        $this->assertSame($value, $xparam->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<xparam name="' . $name . '" value="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xparam);

        $array = array(
            'xparam' => array(
                'name' => $name,
                'value' => $value,
            ),
        );
        $this->assertEquals($array, $xparam->toArray());
    }
}
