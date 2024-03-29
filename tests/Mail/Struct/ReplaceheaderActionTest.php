<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ComparisonComparator, MatchType, RelationalComparator};
use Zimbra\Mail\Struct\ReplaceheaderAction;
use Zimbra\Mail\Struct\EditheaderTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ReplaceheaderAction.
 */
class ReplaceheaderActionTest extends ZimbraTestCase
{
    public function testReplaceheaderAction()
    {
        $index = mt_rand(1, 99);
        $offset = mt_rand(1, 99);
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $test = new EditheaderTest(
            MatchType::CONTAINS, TRUE, TRUE, RelationalComparator::EQUAL, ComparisonComparator::ASCII_NUMERIC, $headerName, [$headerValue]
        );

        $action = new StubReplaceheaderAction($index, TRUE, $offset, $test, $newName, $newValue);
        $this->assertSame($newName, $action->getNewName());
        $this->assertSame($newValue, $action->getNewValue());

        $action = new StubReplaceheaderAction($index, TRUE, $offset, $test);
        $action->setNewName($newName)
            ->setNewValue($newValue);
        $this->assertSame($newName, $action->getNewName());
        $this->assertSame($newValue, $action->getNewValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" last="true" offset="$offset" xmlns:urn="urn:zimbraMail">
    <urn:test matchType="contains" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;ascii-numeric">
        <urn:headerName>$headerName</urn:headerName>
        <urn:headerValue>$headerValue</urn:headerValue>
    </urn:test>
    <urn:newName>$newName</urn:newName>
    <urn:newValue>$newValue</urn:newValue>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubReplaceheaderAction::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubReplaceheaderAction extends ReplaceheaderAction
{
}
