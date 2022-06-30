<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ComparisonComparator, MatchType, RelationalComparator};
use Zimbra\Mail\Struct\DeleteheaderAction;
use Zimbra\Mail\Struct\EditheaderTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteheaderAction.
 */
class DeleteheaderActionTest extends ZimbraTestCase
{
    public function testDeleteheaderAction()
    {
        $index = mt_rand(1, 99);
        $offset = mt_rand(1, 99);
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;

        $test = new EditheaderTest(
            MatchType::CONTAINS(), TRUE, TRUE, RelationalComparator::EQUAL(), ComparisonComparator::ASCII_NUMERIC(), $headerName, [$headerValue]
        );

        $action = new StubDeleteheaderAction($index, FALSE, $offset, $test);
        $this->assertFalse($action->getLast());
        $this->assertSame($offset, $action->getOffset());
        $this->assertSame($test, $action->getTest());

        $action = new StubDeleteheaderAction($index);
        $action->setLast(TRUE)
            ->setOffset($offset)
            ->setTest($test);
        $this->assertTrue($action->getLast());
        $this->assertSame($offset, $action->getOffset());
        $this->assertSame($test, $action->getTest());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" last="true" offset="$offset" xmlns:urn="urn:zimbraMail">
    <urn:test matchType="contains" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;ascii-numeric">
        <urn:headerName>$headerName</urn:headerName>
        <urn:headerValue>$headerValue</urn:headerValue>
    </urn:test>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubDeleteheaderAction::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubDeleteheaderAction extends DeleteheaderAction
{
}
