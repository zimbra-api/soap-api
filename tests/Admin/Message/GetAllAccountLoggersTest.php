<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllAccountLoggersBody;
use Zimbra\Admin\Message\GetAllAccountLoggersEnvelope;
use Zimbra\Admin\Message\GetAllAccountLoggersRequest;
use Zimbra\Admin\Message\GetAllAccountLoggersResponse;
use Zimbra\Admin\Struct\AccountLoggerInfo;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllAccountLoggersTest.
 */
class GetAllAccountLoggersTest extends ZimbraTestCase
{
    public function testGetAllAccountLoggers()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $category = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::INFO());
        $accountLogger = new AccountLoggerInfo($name, $id, [$logger]);

        $request = new GetAllAccountLoggersRequest();

        $response = new GetAllAccountLoggersResponse([$accountLogger]);
        $this->assertSame([$accountLogger], $response->getLoggers());
        $response = new GetAllAccountLoggersResponse();
        $response->setLoggers([$accountLogger])
            ->addLogger($accountLogger);
        $this->assertSame([$accountLogger, $accountLogger], $response->getLoggers());
        $response->setLoggers([$accountLogger]);

        $body = new GetAllAccountLoggersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllAccountLoggersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllAccountLoggersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllAccountLoggersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAccountLoggersRequest />
        <urn:GetAllAccountLoggersResponse>
            <accountLogger name="$name" id="$id">
                <logger category="$category" level="info" />
            </accountLogger>
        </urn:GetAllAccountLoggersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllAccountLoggersEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllAccountLoggersRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllAccountLoggersResponse' => [
                    'accountLogger' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'logger' => [
                                [
                                    'category' => $category,
                                    'level' => 'info',
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllAccountLoggersEnvelope::class, 'json'));
    }
}