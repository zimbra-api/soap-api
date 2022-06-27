<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\XParam;
use Zimbra\Mail\Struct\XProp;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for XProp.
 */
class XPropTest extends ZimbraTestCase
{
    public function testXProp()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $xparam = new XParam($name, $value);

        $xprop = new XProp($name, $value, [$xparam]);
        $this->assertSame($name, $xprop->getName());
        $this->assertSame($value, $xprop->getValue());
        $this->assertSame([$xparam], $xprop->getXParams());

        $xprop = new XProp('', '');
        $xprop->setName($name)
            ->setValue($value)
            ->setXParams([$xparam])
            ->addXParam($xparam);
        $this->assertSame($name, $xprop->getName());
        $this->assertSame($value, $xprop->getValue());
        $this->assertSame([$xparam, $xparam], $xprop->getXParams());
        $xprop->setXParams([$xparam]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" value="$value">
    <xparam name="$name" value="$value" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xprop, 'xml'));
        $this->assertEquals($xprop, $this->serializer->deserialize($xml, XProp::class, 'xml'));
    }
}
