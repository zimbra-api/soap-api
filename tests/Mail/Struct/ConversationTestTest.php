<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ConversationTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConversationTest.
 */
class ConversationTestTest extends ZimbraTestCase
{
    public function testConversationTest()
    {
        $index = mt_rand(1, 99);
        $where = $this->faker->word;

        $test = new ConversationTest(
            $index, TRUE, $where
        );
        $this->assertSame($where, $test->getWhere());

        $test = new ConversationTest($index, TRUE);
        $test->setWhere($where);
        $this->assertSame($where, $test->getWhere());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" where="$where" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, ConversationTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'where' => $where,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, ConversationTest::class, 'json'));
    }
}
