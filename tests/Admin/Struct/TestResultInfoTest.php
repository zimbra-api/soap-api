<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $results = new TestResultInfo([$completed], [$failure]);
        $this->assertSame([$completed], $results->getCompletedTests());
        $this->assertSame([$failure], $results->getFailedTests());

        $results = new TestResultInfo();
        $results->setCompletedTests([$completed])
             ->addCompletedTest($completed)
             ->setFailedTests([$failure])
             ->addFailedTest($failure);
        $this->assertSame([$completed, $completed], $results->getCompletedTests());
        $this->assertSame([$failure, $failure], $results->getFailedTests());
        $results->setCompletedTests([$completed])
             ->setFailedTests([$failure]);

        $xml = <<<EOT
<?xml version="1.0"?>
<results>
    <completed name="$name" execSeconds="$execSeconds" class="$className"/>
    <failure name="$name" execSeconds="$execSeconds" class="$className">$throwable</failure>
</results>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($results, 'xml'));
        $this->assertEquals($results, $this->serializer->deserialize($xml, TestResultInfo::class, 'xml'));

        $json = json_encode([
            'completed' => [
                [
                    'name' => $name,
                    'execSeconds' => $execSeconds,
                    'class' => $className,
                ],
            ],
            'failure' => [
                [
                    'name' => $name,
                    'execSeconds' => $execSeconds,
                    'class' => $className,
                    '_content' => $throwable,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($results, 'json'));
        $this->assertEquals($results, $this->serializer->deserialize($json, TestResultInfo::class, 'json'));
    }
}
