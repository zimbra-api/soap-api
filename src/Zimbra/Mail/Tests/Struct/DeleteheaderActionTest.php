<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\DeleteheaderAction;
use Zimbra\Mail\Struct\EditheaderTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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
        $matchType = $this->faker->word;
        $relationalComparator = $this->faker->word;
        $comparator = $this->faker->word;

        $test = new EditheaderTest($matchType, TRUE, TRUE, $relationalComparator, $comparator, $headerName, [$headerValue]);

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<actionDeleteheader index="' . $index . '" last="true" offset="' . $offset . '">'
                . '<test matchType="' . $matchType . '" countComparator="true" valueComparator="true" relationalComparator="' . $relationalComparator . '" comparator="' . $comparator . '">'
                    . '<headerName>' . $headerName . '</headerName>'
                    . '<headerValue>' . $headerValue . '</headerValue>'
                . '</test>'
            . '</actionDeleteheader>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, DeleteheaderAction::class, 'xml'));

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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, DeleteheaderAction::class, 'json'));
    }
}
