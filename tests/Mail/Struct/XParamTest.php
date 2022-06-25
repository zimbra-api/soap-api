<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\XParam;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for XParam.
 */
class XParamTest extends ZimbraTestCase
{
    public function testXParam()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;

        $xparam = new XParam($name, $value);
        $this->assertSame($name, $xparam->getName());
        $this->assertSame($value, $xparam->getValue());

        $xparam = new XParam('', '');
        $xparam->setName($name)
            ->setValue($value);
        $this->assertSame($name, $xparam->getName());
        $this->assertSame($value, $xparam->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xparam, 'xml'));
        $this->assertEquals($xparam, $this->serializer->deserialize($xml, XParam::class, 'xml'));
    }
}
