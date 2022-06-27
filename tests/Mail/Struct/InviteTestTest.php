<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\InviteTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InviteTest.
 */
class InviteTestTest extends ZimbraTestCase
{
    public function testInviteTest()
    {
        $index = mt_rand(1, 99);
        $method1 = $this->faker->unique()->word;
        $method2 = $this->faker->unique()->word;

        $test = new InviteTest(
            $index, TRUE, [$method1, $method2]
        );
        $this->assertSame([$method1, $method2], $test->getMethods());

        $test = new InviteTest($index, TRUE);
        $test->setMethods([$method1])
            ->addMethod($method2);
        $this->assertSame([$method1, $method2], $test->getMethods());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true">
    <method>$method1</method>
    <method>$method2</method>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, InviteTest::class, 'xml'));
    }
}
