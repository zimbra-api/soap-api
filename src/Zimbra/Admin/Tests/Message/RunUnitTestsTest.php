<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\RunUnitTestsBody;
use Zimbra\Admin\Message\RunUnitTestsEnvelope;
use Zimbra\Admin\Message\RunUnitTestsRequest;
use Zimbra\Admin\Message\RunUnitTestsResponse;
use Zimbra\Admin\Struct\CompletedTestInfo;
use Zimbra\Admin\Struct\FailedTestInfo;
use Zimbra\Admin\Struct\TestResultInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RunUnitTests.
 */
class RunUnitTestsTest extends ZimbraStructTestCase
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
            <test>$test1</test>
            <test>$test2</test>
        </urn:RunUnitTestsRequest>
        <urn:RunUnitTestsResponse numExecuted="$numExecuted" numFailed="$numFailed">
            <results>
                <completed name="$name" execSeconds="$execSeconds" class="$className"/>
                <failure name="$name" execSeconds="$execSeconds" class="$className">$throwable</failure>
            </results>
        </urn:RunUnitTestsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RunUnitTestsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RunUnitTestsRequest' => [
                    'test' => [
                        [
                            '_content' => $test1,
                        ],
                        [
                            '_content' => $test2,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'RunUnitTestsResponse' => [
                    'numExecuted' => $numExecuted,
                    'numFailed' => $numFailed,
                    'results'=> [
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
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RunUnitTestsEnvelope::class, 'json'));
    }
}
