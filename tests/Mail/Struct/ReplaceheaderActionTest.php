<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\{ComparisonComparator, MatchType, RelationalComparator};
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
            MatchType::CONTAINS(), TRUE, TRUE, RelationalComparator::EQUAL(), ComparisonComparator::ASCII_NUMERIC(), $headerName, [$headerValue]
        );

        $action = new ReplaceheaderAction($index, TRUE, $offset, $test, $newName, $newValue);
        $this->assertSame($newName, $action->getNewName());
        $this->assertSame($newValue, $action->getNewValue());

        $action = new ReplaceheaderAction($index, TRUE, $offset, $test);
        $action->setNewName($newName)
            ->setNewValue($newValue);
        $this->assertSame($newName, $action->getNewName());
        $this->assertSame($newValue, $action->getNewValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" last="true" offset="$offset">
    <test matchType="contains" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;ascii-numeric">
        <headerName>$headerName</headerName>
        <headerValue>$headerValue</headerValue>
    </test>
    <newName>$newName</newName>
    <newValue>$newValue</newValue>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ReplaceheaderAction::class, 'xml'));

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
            'newName' => [
                '_content' => $newName,
            ],
            'newValue' => [
                '_content' => $newValue,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, ReplaceheaderAction::class, 'json'));
    }
}
