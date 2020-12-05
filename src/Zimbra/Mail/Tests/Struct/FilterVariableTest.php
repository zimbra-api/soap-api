<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\FilterVariable;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FilterVariable.
 */
class FilterVariableTest extends ZimbraStructTestCase
{
    public function testFilterVariable()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $variable = new FilterVariable($name, $value);
        $this->assertSame($name, $variable->getName());
        $this->assertSame($value, $variable->getValue());

        $variable = new FilterVariable('', '');
        $variable->setName($name)
           ->setValue($value);
        $this->assertSame($name, $variable->getName());
        $this->assertSame($value, $variable->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<filterVariable name="$name" value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($variable, 'xml'));
        $this->assertEquals($variable, $this->serializer->deserialize($xml, FilterVariable::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'value' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($variable, 'json'));
        $this->assertEquals($variable, $this->serializer->deserialize($json, FilterVariable::class, 'json'));
    }
}
