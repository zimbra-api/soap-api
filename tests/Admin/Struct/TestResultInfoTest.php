<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\CompletedTestInfo;
use Zimbra\Admin\Struct\FailedTestInfo;
use Zimbra\Admin\Struct\TestResultInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TestResultInfo.
 */
class TestResultInfoTest extends ZimbraTestCase
{
    public function testTestResultInfo()
    {
        $name = $this->faker->word;
        $execSeconds = time();
        $className = $this->faker->word;
        $throwable = $this->faker->word;

        $completed = new CompletedTestInfo($name, $execSeconds, $className);
        $failure = new FailedTestInfo($name, $execSeconds, $className, $throwable);

        $results = new StubTestResultInfo([$completed], [$failure]);
        $this->assertSame([$completed], $results->getCompletedTests());
        $this->assertSame([$failure], $results->getFailedTests());

        $results = new StubTestResultInfo();
        $results->setCompletedTests([$completed])
             ->setFailedTests([$failure]);
        $this->assertSame([$completed], $results->getCompletedTests());
        $this->assertSame([$failure], $results->getFailedTests());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:completed name="$name" execSeconds="$execSeconds" class="$className"/>
    <urn:failure name="$name" execSeconds="$execSeconds" class="$className">$throwable</urn:failure>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($results, 'xml'));
        $this->assertEquals($results, $this->serializer->deserialize($xml, StubTestResultInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubTestResultInfo extends TestResultInfo
{
}
