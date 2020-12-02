<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\MimeHeaderTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MimeHeaderTest.
 */
class MimeHeaderTestTest extends ZimbraStructTestCase
{
    public function testMimeHeaderTest()
    {
        $index = mt_rand(1, 99);
        $headers = $this->faker->word;
        $stringComparison = $this->faker->word;
        $value = $this->faker->word;

        $test = new MimeHeaderTest(
            $index, TRUE, $headers, $stringComparison, $value, FALSE
        );
        $this->assertSame($headers, $test->getHeaders());
        $this->assertSame($stringComparison, $test->getStringComparison());
        $this->assertFalse($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());

        $test = new MimeHeaderTest($index, TRUE);
        $test->setHeaders($headers)
            ->setStringComparison($stringComparison)
            ->setCaseSensitive(TRUE)
            ->setValue($value);
        $this->assertSame($headers, $test->getHeaders());
        $this->assertSame($stringComparison, $test->getStringComparison());
        $this->assertTrue($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mimeHeaderTest index="' . $index . '" negative="true" header="' . $headers . '" stringComparison="' . $stringComparison . '" value="' . $value . '" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, MimeHeaderTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $headers,
            'stringComparison' => $stringComparison,
            'value' => $value,
            'caseSensitive' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, MimeHeaderTest::class, 'json'));
    }
}
