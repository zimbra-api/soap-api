<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\{ComparisonComparator, MatchType, RelationalComparator};
use Zimbra\Mail\Struct\DeleteheaderAction;
use Zimbra\Mail\Struct\EditheaderTest;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for DeleteheaderAction.
 */
class DeleteheaderActionTest extends ZimbraStructTestCase
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

        $action = new DeleteheaderAction($index, FALSE, $offset, $test);
        $this->assertFalse($action->getLast());
        $this->assertSame($offset, $action->getOffset());
        $this->assertSame($test, $action->getTest());

        $action = new DeleteheaderAction($index);
        $action->setLast(TRUE)
            ->setOffset($offset)
            ->setTest($test);
        $this->assertTrue($action->getLast());
        $this->assertSame($offset, $action->getOffset());
        $this->assertSame($test, $action->getTest());

        $xml = <<<EOT
<?xml version="1.0"?>
<actionDeleteheader index="$index" last="true" offset="$offset">
    <test matchType="contains" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;ascii-numeric">
        <headerName>$headerName</headerName>
        <headerValue>$headerValue</headerValue>
    </test>
</actionDeleteheader>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, DeleteheaderAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'last' => TRUE,
            'offset' => $offset,
            'test' => [
                'matchType' => 'contains',
                'countComparator' => TRUE,
                'valueComparator' => TRUE,
                'relationalComparator' => 'eq',
                'comparator' => 'i;ascii-numeric',
                'headerName' => [
                    '_content' => $headerName,
                ],
                'headerValue' => [
                    [
                        '_content' => $headerValue,
                    ]
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, DeleteheaderAction::class, 'json'));
    }
}
