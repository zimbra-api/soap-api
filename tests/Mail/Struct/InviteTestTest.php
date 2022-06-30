<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $test = new StubInviteTest(
            $index, TRUE, [$method1, $method2]
        );
        $this->assertSame([$method1, $method2], $test->getMethods());

        $test = new StubInviteTest($index, TRUE);
        $test->setMethods([$method1])
            ->addMethod($method2);
        $this->assertSame([$method1, $method2], $test->getMethods());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" xmlns:urn="urn:zimbraMail">
    <urn:method>$method1</urn:method>
    <urn:method>$method2</urn:method>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, StubInviteTest::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubInviteTest extends InviteTest
{
}
