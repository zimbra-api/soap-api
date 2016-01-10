<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\XParam;
use Zimbra\Mail\Struct\XProp;

/**
 * Testcase class for XProp.
 */
class XPropTest extends ZimbraMailTestCase
{
    public function testXProp()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $xparam = new XParam($name, $value);

        $xprop = new XProp($name, $value, [$xparam]);

        $this->assertSame([$xparam], $xprop->getXParams()->all());
        $this->assertSame($name, $xprop->getName());
        $this->assertSame($value, $xprop->getValue());

        $xprop = new XProp('', '');
        $xprop->addXParam($xparam);
        $xprop->setName($name)
              ->setValue($value);
        $this->assertSame([$xparam], $xprop->getXParams()->all());
        $this->assertSame($name, $xprop->getName());
        $this->assertSame($value, $xprop->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<xprop name="' . $name . '" value="' . $value . '">'
                .'<xparam name="' . $name . '" value="' . $value . '" />'
            .'</xprop>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xprop);

        $array = array(
            'xprop' => array(
                'name' => $name,
                'value' => $value,
                'xparam' => array(
                    array(
                        'name' => $name,
                        'value' => $value,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $xprop->toArray());
    }
}
