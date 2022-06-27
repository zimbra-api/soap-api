<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MimeHeaderTest;
use Zimbra\Common\Enum\StringComparison;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MimeHeaderTest.
 */
class MimeHeaderTestTest extends ZimbraTestCase
{
    public function testMimeHeaderTest()
    {
        $index = mt_rand(1, 99);
        $headers = $this->faker->word;
        $value = $this->faker->word;

        $test = new MimeHeaderTest(
            $index, TRUE, $headers, StringComparison::IS(), $value, FALSE
        );
        $this->assertSame($headers, $test->getHeaders());
        $this->assertEquals(StringComparison::IS(), $test->getStringComparison());
        $this->assertFalse($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());

        $test = new MimeHeaderTest($index, TRUE);
        $test->setHeaders($headers)
            ->setStringComparison(StringComparison::CONTAINS())
            ->setCaseSensitive(TRUE)
            ->setValue($value);
        $this->assertSame($headers, $test->getHeaders());
        $this->assertEquals(StringComparison::CONTAINS(), $test->getStringComparison());
        $this->assertTrue($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" header="$headers" stringComparison="contains" value="$value" caseSensitive="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, MimeHeaderTest::class, 'xml'));
    }
}
