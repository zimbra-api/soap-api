<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FilterVariable;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FilterVariable.
 */
class FilterVariableTest extends ZimbraTestCase
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
<result name="$name" value="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($variable, 'xml'));
        $this->assertEquals($variable, $this->serializer->deserialize($xml, FilterVariable::class, 'xml'));
    }
}
