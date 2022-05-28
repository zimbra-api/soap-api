<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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

        $action = new ConvActionSelector(
            $operation, $ids, $acctRelativePath
        );
        $this->assertSame($acctRelativePath, $action->getAcctRelativePath());
        $action = new ConvActionSelector($operation, $ids);
        $action->setAcctRelativePath($acctRelativePath);
        $this->assertSame($acctRelativePath, $action->getAcctRelativePath());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation">
    <acctRelPath>$acctRelativePath</acctRelPath>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ConvActionSelector::class, 'xml'));

        $json = json_encode([
            'id' => $ids,
            'op' => $operation,
            'acctRelPath' => [
                '_content' => $acctRelativePath,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, ConvActionSelector::class, 'json'));
    }
}
