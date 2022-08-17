<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\ConvActionOp;
use Zimbra\Mail\Struct\ConvActionSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConvActionSelector.
 */
class ConvActionSelectorTest extends ZimbraTestCase
{
    public function testConvActionSelector()
    {
        $operation = $this->faker->randomElement(ConvActionOp::values())->getValue();
        $ids = $this->faker->uuid;
        $acctRelativePath = $this->faker->word;

        $action = new StubConvActionSelector(
            $operation, $ids, $acctRelativePath
        );
        $this->assertSame($acctRelativePath, $action->getAcctRelativePath());
        $action = new StubConvActionSelector($operation, $ids);
        $action->setAcctRelativePath($acctRelativePath);
        $this->assertSame($acctRelativePath, $action->getAcctRelativePath());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation" xmlns:urn="urn:zimbraMail">
    <urn:acctRelPath>$acctRelativePath</urn:acctRelPath>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubConvActionSelector::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubConvActionSelector extends ConvActionSelector
{
}
