<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\AddAccountLoggerBody;
use Zimbra\Admin\Message\AddAccountLoggerEnvelope;
use Zimbra\Admin\Message\AddAccountLoggerRequest;
use Zimbra\Admin\Message\AddAccountLoggerResponse;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddAccountLogger.
 */
class AddAccountLoggerTest extends ZimbraTestCase
{
    public function testAddAccountLogger()
    {
        $id = $this->faker->uuid;
        $category = $this->faker->word;
        $value = $this->faker->word;
        $category1 = $this->faker->word;
        $category2 = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::INFO());
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new AddAccountLoggerRequest($logger, $account, $id);
        $this->assertSame($logger, $request->getLogger());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($id, $request->getId());

        $request = new AddAccountLoggerRequest(new LoggerInfo($category, LoggingLevel::ERROR()));
        $request->setLogger($logger)
            ->setAccount($account)
            ->setId($id);
        $this->assertSame($logger, $request->getLogger());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($id, $request->getId());

        $logger1 = new LoggerInfo($category1, LoggingLevel::INFO());
        $logger2 = new LoggerInfo($category2, LoggingLevel::ERROR());
        $response = new AddAccountLoggerResponse([$logger1]);
        $this->assertSame([$logger1], $response->getLoggers());
        $response = new AddAccountLoggerResponse();
        $response->setLoggers([$logger1])
            ->addLogger($logger2);
        $this->assertSame([$logger1, $logger2], $response->getLoggers());
        $response->setLoggers([$logger]);

        $body = new AddAccountLoggerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddAccountLoggerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddAccountLoggerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddAccountLoggerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddAccountLoggerRequest>
            <logger category="$category" level="info" />
            <account by="name">$value</account>
            <id>$id</id>
        </urn:AddAccountLoggerRequest>
        <urn:AddAccountLoggerResponse>
            <logger category="$category" level="info" />
        </urn:AddAccountLoggerResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddAccountLoggerEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddAccountLoggerRequest' => [
                    'logger' => [
                        'category' => $category,
                        'level' => 'info',
                    ],
                    'account' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'id' => [
                        '_content' => $id,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AddAccountLoggerResponse' => [
                    'logger' => [
                        [
                            'category' => $category,
                            'level' => 'info',
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddAccountLoggerEnvelope::class, 'json'));
    }
}
