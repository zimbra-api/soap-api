<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\TestDataSource;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TestDataSource.
 */
class TestDataSourceTest extends ZimbraTestCase
{
    public function testTestDataSource()
    {
        $error = $this->faker->text;
        $success = $this->faker->randomNumber;

        $test = new TestDataSource(
            $success, $error
        );
        $this->assertSame($success, $test->getSuccess());
        $this->assertSame($error, $test->getError());

        $test = new TestDataSource();
        $test->setSuccess($success)->setError($error);
        $this->assertSame($success, $test->getSuccess());
        $this->assertSame($error, $test->getError());

        $xml = <<<EOT
<?xml version="1.0"?>
<result success="$success" error="$error" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, TestDataSource::class, 'xml'));
    }
}
