<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ConversationTest;

/**
 * Testcase class for ConversationTest.
 */
class ConversationTestTest extends ZimbraMailTestCase
{
    public function testConversationTest()
    {
        $index = mt_rand(1, 10);
        $where = $this->faker->word;

        $conversationTest = new ConversationTest(
            $index, $where, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $conversationTest);
        $this->assertSame($where, $conversationTest->getWhere());
        $conversationTest->setWhere($where);
        $this->assertSame($where, $conversationTest->getWhere());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<conversationTest index="' . $index . '" negative="true" where="' . $where . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $conversationTest);

        $array = array(
            'conversationTest' => array(
                'index' => $index,
                'negative' => true,
                'where' => $where,
            ),
        );
        $this->assertEquals($array, $conversationTest->toArray());
    }
}
