<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\XParam;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for XParam.
 */
class XParamTest extends ZimbraStructTestCase
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
<xparam name="$name" value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xparam, 'xml'));
        $this->assertEquals($xparam, $this->serializer->deserialize($xml, XParam::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'value' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($xparam, 'json'));
        $this->assertEquals($xparam, $this->serializer->deserialize($json, XParam::class, 'json'));
    }
}
