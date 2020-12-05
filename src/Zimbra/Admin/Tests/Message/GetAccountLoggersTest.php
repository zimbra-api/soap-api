<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{GetAccountLoggersBody, GetAccountLoggersEnvelope, GetAccountLoggersRequest, GetAccountLoggersResponse};
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAccountLoggers.
 */
class GetAccountLoggersTest extends ZimbraStructTestCase
{
    public function testGetAccountLoggers()
    {
        $id = $this->faker->uuid;
        $value = $this->faker->word;
        $category = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $logger = new LoggerInfo($category, LoggingLevel::INFO());

        $request = new GetAccountLoggersRequest($id, $account);
        $this->assertSame($id, $request->getId());
        $this->assertSame($account, $request->getAccount());
        $request = new GetAccountLoggersRequest();
        $request->setId($id)
            ->setAccount($account);
        $this->assertSame($id, $request->getId());
        $this->assertSame($account, $request->getAccount());

        $response = new GetAccountLoggersResponse([$logger]);
        $this->assertSame([$logger], $response->getLoggers());

        $response = new GetAccountLoggersResponse();
        $response->setLoggers([$logger])
            ->addLogger($logger);
        $this->assertSame([$logger, $logger], $response->getLoggers());
        $response->setLoggers([$logger]);

        $body = new GetAccountLoggersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAccountLoggersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAccountLoggersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAccountLoggersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountLoggersRequest>
            <id>$id</id>
            <account by="name">$value</account>
        </urn:GetAccountLoggersRequest>
        <urn:GetAccountLoggersResponse>
            <logger category="$category" level="info" />
        </urn:GetAccountLoggersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountLoggersEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAccountLoggersRequest' => [
                    'id' => [
                        '_content' => $id,
                    ],
                    'account' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAccountLoggersResponse' => [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAccountLoggersEnvelope::class, 'json'));
    }
}
