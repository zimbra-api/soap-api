<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RemoveAccountLoggerBody;
use Zimbra\Admin\Message\RemoveAccountLoggerEnvelope;
use Zimbra\Admin\Message\RemoveAccountLoggerRequest;
use Zimbra\Admin\Message\RemoveAccountLoggerResponse;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RemoveAccountLogger.
 */
class RemoveAccountLoggerTest extends ZimbraTestCase
{
    public function testRemoveAccountLogger()
    {
        $id = $this->faker->uuid;
        $category = $this->faker->word;
        $value = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::INFO());
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new RemoveAccountLoggerRequest($logger, $account, $id);
        $this->assertSame($logger, $request->getLogger());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($id, $request->getId());

        $request = new RemoveAccountLoggerRequest();
        $request->setLogger($logger)
            ->setAccount($account)
            ->setId($id);
        $this->assertSame($logger, $request->getLogger());
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($id, $request->getId());

        $response = new RemoveAccountLoggerResponse();

        $body = new RemoveAccountLoggerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RemoveAccountLoggerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RemoveAccountLoggerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RemoveAccountLoggerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RemoveAccountLoggerRequest>
            <logger category="$category" level="info" />
            <account by="name">$value</account>
            <id>$id</id>
        </urn:RemoveAccountLoggerRequest>
        <urn:RemoveAccountLoggerResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RemoveAccountLoggerEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RemoveAccountLoggerRequest' => [
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
                'RemoveAccountLoggerResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RemoveAccountLoggerEnvelope::class, 'json'));
    }
}
