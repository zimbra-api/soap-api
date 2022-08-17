<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\FilterVariable;
use Zimbra\Mail\Struct\FilterVariables;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FilterVariables.
 */
class FilterVariablesTest extends ZimbraTestCase
{
    public function testFilterVariables()
    {
        $index = mt_rand(1, 99);
        $name = $this->faker->word;
        $value = $this->faker->word;

        $variable = new FilterVariable($name, $value);
        $action = new StubFilterVariables($index, [$variable]);
        $this->assertSame([$variable], $action->getVariables());
        $action = new StubFilterVariables($index);
        $action->setVariables([$variable])
           ->addVariable($variable);
        $this->assertSame([$variable, $variable], $action->getVariables());
        $action->setVariables([$variable]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" xmlns:urn="urn:zimbraMail">
    <urn:filterVariable name="$name" value="$value" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubFilterVariables::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubFilterVariables extends FilterVariables
{
}
