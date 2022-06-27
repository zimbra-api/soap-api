<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RunUnitTestsBody;
use Zimbra\Admin\Message\RunUnitTestsEnvelope;
use Zimbra\Admin\Message\RunUnitTestsRequest;
use Zimbra\Admin\Message\RunUnitTestsResponse;
use Zimbra\Admin\Struct\CompletedTestInfo;
use Zimbra\Admin\Struct\FailedTestInfo;
use Zimbra\Admin\Struct\TestResultInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RunUnitTests.
 */
class RunUnitTestsTest extends ZimbraTestCase
{
    public function testRunUnitTests()
    {
        $test1 = $this->faker->word;
        $test2 = $this->faker->word;
        $name = $this->faker->word;
        $execSeconds = time();
        $className = $this->faker->word;
        $throwable = $this->faker->word;
        $numExecuted = mt_rand(1, 100);
        $numFailed = mt_rand(1, 100);

        $request = new RunUnitTestsRequest([$test1]);
        $this->assertSame([$test1], $request->getTests());

        $request = new RunUnitTestsRequest();
        $request->setTests([$test1])
            ->addTest($test2);
        $this->assertSame([$test1, $test2], $request->getTests());

        $completed = new CompletedTestInfo($name, $execSeconds, $className);
        $failure = new FailedTestInfo($name, $execSeconds, $className, $throwable);
        $results = new TestResultInfo([$completed], [$failure]);
        $response = new RunUnitTestsResponse($results, $numExecuted, $numFailed);
        $this->assertSame($results, $response->getResults());
        $this->assertSame($numExecuted, $response->getNumExecuted());
        $this->assertSame($numFailed, $response->getNumFailed());
        $response = new RunUnitTestsResponse(new TestResultInfo(), 0, 0);
        $response->setResults($results)
            ->setNumExecuted($numExecuted)
            ->setNumFailed($numFailed);
        $this->assertSame($results, $response->getResults());
        $this->assertSame($numExecuted, $response->getNumExecuted());
        $this->assertSame($numFailed, $response->getNumFailed());

        $body = new RunUnitTestsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RunUnitTestsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RunUnitTestsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RunUnitTestsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:RunUnitTestsRequest>
            <urn:test>$test1</urn:test>
            <urn:test>$test2</urn:test>
        </urn:RunUnitTestsRequest>
        <urn:RunUnitTestsResponse numExecuted="$numExecuted" numFailed="$numFailed">
            <urn:results>
                <urn:completed name="$name" execSeconds="$execSeconds" class="$className"/>
                <urn:failure name="$name" execSeconds="$execSeconds" class="$className">$throwable</urn:failure>
            </urn:results>
        </urn:RunUnitTestsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RunUnitTestsEnvelope::class, 'xml'));
    }
}
