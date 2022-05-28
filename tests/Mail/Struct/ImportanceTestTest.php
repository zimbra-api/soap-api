<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\Importance;
use Zimbra\Mail\Struct\ImportanceTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImportanceTest.
 */
class ImportanceTestTest extends ZimbraTestCase
{
    public function testImportanceTest()
    {
        $index = mt_rand(1, 99);

        $test = new ImportanceTest(
            $index, TRUE, Importance::HIGH()
        );
        $this->assertEquals(Importance::HIGH(), $test->getImportance());

        $test = new ImportanceTest($index, TRUE);
        $test->setImportance(Importance::HIGH());
        $this->assertEquals(Importance::HIGH(), $test->getImportance());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" imp="high" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, ImportanceTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'imp' => 'high',
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, ImportanceTest::class, 'json'));
    }
}
