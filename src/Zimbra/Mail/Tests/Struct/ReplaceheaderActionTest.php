<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ReplaceheaderAction;
use Zimbra\Mail\Struct\EditheaderTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ReplaceheaderAction.
 */
class ReplaceheaderActionTest extends ZimbraStructTestCase
{
    public function testReplaceheaderAction()
    {
        $index = mt_rand(1, 99);
        $offset = mt_rand(1, 99);
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $matchType = $this->faker->word;
        $relationalComparator = $this->faker->word;
        $comparator = $this->faker->word;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $test = new EditheaderTest($matchType, TRUE, TRUE, $relationalComparator, $comparator, $headerName, [$headerValue]);

        $action = new ReplaceheaderAction($index, TRUE, $offset, $test, $newName, $newValue);
        $this->assertSame($newName, $action->getNewName());
        $this->assertSame($newValue, $action->getNewValue());

        $action = new ReplaceheaderAction($index, TRUE, $offset, $test);
        $action->setNewName($newName)
            ->setNewValue($newValue);
        $this->assertSame($newName, $action->getNewName());
        $this->assertSame($newValue, $action->getNewValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<actionReplaceheader index="' . $index . '" last="true" offset="' . $offset . '">'
                . '<test matchType="' . $matchType . '" countComparator="true" valueComparator="true" relationalComparator="' . $relationalComparator . '" comparator="' . $comparator . '">'
                    . '<headerName>' . $headerName . '</headerName>'
                    . '<headerValue>' . $headerValue . '</headerValue>'
                . '</test>'
                . '<newName>' . $newName . '</newName>'
                . '<newValue>' . $newValue . '</newValue>'
            . '</actionReplaceheader>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ReplaceheaderAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'last' => TRUE,
            'offset' => $offset,
            'test' => [
                'matchType' => $matchType,
                'countComparator' => TRUE,
                'valueComparator' => TRUE,
                'relationalComparator' => $relationalComparator,
                'comparator' => $comparator,
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
