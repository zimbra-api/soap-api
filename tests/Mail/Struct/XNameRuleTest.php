<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\XNameRule;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for XNameRule.
 */
class XNameRuleTest extends ZimbraTestCase
{
    public function testXNameRule()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;

        $xname = new XNameRule($name, $value);
        $this->assertSame($name, $xname->getName());
        $this->assertSame($value, $xname->getValue());

        $xname = new XNameRule();
        $xname->setName($name)
            ->setValue($value);
        $this->assertSame($name, $xname->getName());
        $this->assertSame($value, $xname->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($xname, 'xml'));
        $this->assertEquals($xname, $this->serializer->deserialize($xml, XNameRule::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'value' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($xname, 'json'));
        $this->assertEquals($xname, $this->serializer->deserialize($json, XNameRule::class, 'json'));
    }
}
