<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllAccountLoggersBody;
use Zimbra\Admin\Message\GetAllAccountLoggersEnvelope;
use Zimbra\Admin\Message\GetAllAccountLoggersRequest;
use Zimbra\Admin\Message\GetAllAccountLoggersResponse;
use Zimbra\Admin\Struct\AccountLoggerInfo;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Common\Enum\LoggingLevel;
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

        $logger = new AccountLoggerInfo($name, $id, [new LoggerInfo($category, LoggingLevel::INFO())]);

        $request = new GetAllAccountLoggersRequest();

        $response = new GetAllAccountLoggersResponse([$logger]);
        $this->assertSame([$logger], $response->getLoggers());
        $response = new GetAllAccountLoggersResponse();
        $response->setLoggers([$logger]);
        $this->assertSame([$logger], $response->getLoggers());

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
            <urn:accountLogger name="$name" id="$id">
                <urn:logger category="$category" level="info" />
            </urn:accountLogger>
        </urn:GetAllAccountLoggersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllAccountLoggersEnvelope::class, 'xml'));
    }
}
