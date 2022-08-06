<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetAccountLoggersBody, GetAccountLoggersEnvelope, GetAccountLoggersRequest, GetAccountLoggersResponse};
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Enum\LoggingLevel;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAccountLoggers.
 */
class GetAccountLoggersTest extends ZimbraTestCase
{
    public function testGetAccountLoggers()
    {
        $id = $this->faker->uuid;
        $value = $this->faker->word;
        $category = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $logger = new LoggerInfo($category, LoggingLevel::INFO());

        $request = new GetAccountLoggersRequest($account, $id);
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
            <urn:id>$id</urn:id>
            <urn:account by="name">$value</urn:account>
        </urn:GetAccountLoggersRequest>
        <urn:GetAccountLoggersResponse>
            <urn:logger category="$category" level="info" />
        </urn:GetAccountLoggersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountLoggersEnvelope::class, 'xml'));
    }
}
