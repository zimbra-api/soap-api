<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountLoggerBody;
use Zimbra\Admin\Message\AddAccountLoggerEnvelope;
use Zimbra\Admin\Message\AddAccountLoggerRequest;
use Zimbra\Admin\Message\AddAccountLoggerResponse;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\AccountSelector;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountLogger.
 */
class AddAccountLoggerTest extends ZimbraStructTestCase
{
    private $id;
    private $category;
    private $value;
    private $category1;
    private $category2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->id = $this->faker->uuid;
        $this->category = $this->faker->word;
        $this->value = $this->faker->word;

        $this->category1 = $this->faker->word;
        $this->category2 = $this->faker->word;
    }

    public function testAddAccountLoggerRequest()
    {
        $logger = new LoggerInfo($this->category, LoggingLevel::INFO());
        $account = new AccountSelector(AccountBy::NAME(), $this->value);

        $req = new AddAccountLoggerRequest($logger, $account, $this->id);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($this->id, $req->getId());

        $req = new AddAccountLoggerRequest(new LoggerInfo($this->category, LoggingLevel::ERROR()));
        $req->setLogger($logger)
            ->setAccount($account)
            ->setId($this->id);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($this->id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerRequest>'
                . '<logger category="' . $this->category . '" level="' . LoggingLevel::INFO() . '" />'
                . '<account by="' . AccountBy::NAME() . '">' . $this->value . '</account>'
                . '<id>' . $this->id . '</id>'
            . '</AddAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddAccountLoggerRequest::class, 'xml'));

        $json = json_encode([
            'logger' => [
                'category' => $this->category,
                'level' => (string) LoggingLevel::INFO(),
            ],
            'account' => [
                'by' => (string) AccountBy::NAME(),
                '_content' => $this->value,
            ],
            'id' => [
                '_content' => $this->id,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddAccountLoggerRequest::class, 'json'));
    }

    public function testAddAccountLoggerResponse()
    {
        $logger1 = new LoggerInfo($this->category1, LoggingLevel::INFO());
        $logger2 = new LoggerInfo($this->category2, LoggingLevel::ERROR());

        $res = new AddAccountLoggerResponse([$logger1]);
        $this->assertSame([$logger1], $res->getLoggers());

        $res = new AddAccountLoggerResponse();
        $res->setLoggers([$logger1])
            ->addLogger($logger2);
        $this->assertSame([$logger1, $logger2], $res->getLoggers());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerResponse>'
                . '<logger category="' . $this->category1 . '" level="' . LoggingLevel::INFO() . '" />'
                . '<logger category="' . $this->category2 . '" level="' . LoggingLevel::ERROR() . '" />'
            . '</AddAccountLoggerResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddAccountLoggerResponse::class, 'xml'));

        $json = json_encode([
            'logger' => [
                [
                    'category' => $this->category1,
                    'level' => (string) LoggingLevel::INFO(),
                ],
                [
                    'category' => $this->category2,
                    'level' => (string) LoggingLevel::ERROR(),
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddAccountLoggerResponse::class, 'json'));
    }

    public function testAddAccountLoggerBody()
    {
        $logger = new LoggerInfo($this->category, LoggingLevel::INFO());
        $account = new AccountSelector(AccountBy::NAME(), $this->value);
        $request = new AddAccountLoggerRequest($logger, $account, $this->id);
        $response = new AddAccountLoggerResponse([$logger]);

        $body = new AddAccountLoggerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddAccountLoggerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AddAccountLoggerRequest>'
                    . '<logger category="' . $this->category . '" level="' . LoggingLevel::INFO() . '" />'
                    . '<account by="' . AccountBy::NAME() . '">' . $this->value . '</account>'
                    . '<id>' . $this->id . '</id>'
                . '</urn:AddAccountLoggerRequest>'
                . '<urn:AddAccountLoggerResponse>'
                    . '<logger category="' . $this->category . '" level="' . LoggingLevel::INFO() . '" />'
                . '</urn:AddAccountLoggerResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddAccountLoggerBody::class, 'xml'));

        $json = json_encode([
            'AddAccountLoggerRequest' => [
                'logger' => [
                    'category' => $this->category,
                    'level' => (string) LoggingLevel::INFO(),
                ],
                'account' => [
                    'by' => (string) AccountBy::NAME(),
                    '_content' => $this->value,
                ],
                'id' => [
                    '_content' => $this->id,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AddAccountLoggerResponse' => [
                'logger' => [
                    [
                        'category' => $this->category,
                        'level' => (string) LoggingLevel::INFO(),
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddAccountLoggerBody::class, 'json'));
    }

    public function testAddAccountLoggerEnvelope()
    {
        $logger = new LoggerInfo($this->category, LoggingLevel::INFO());
        $account = new AccountSelector(AccountBy::NAME(), $this->value);
        $request = new AddAccountLoggerRequest($logger, $account, $this->id);
        $response = new AddAccountLoggerResponse([$logger]);
        $body = new AddAccountLoggerBody($request, $response);

        $envelope = new AddAccountLoggerEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddAccountLoggerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AddAccountLoggerRequest>'
                        . '<logger category="' . $this->category . '" level="' . LoggingLevel::INFO() . '" />'
                        . '<account by="' . AccountBy::NAME() . '">' . $this->value . '</account>'
                        . '<id>' . $this->id . '</id>'
                    . '</urn:AddAccountLoggerRequest>'
                    . '<urn:AddAccountLoggerResponse>'
                        . '<logger category="' . $this->category . '" level="' . LoggingLevel::INFO() . '" />'
                    . '</urn:AddAccountLoggerResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddAccountLoggerEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddAccountLoggerRequest' => [
                    'logger' => [
                        'category' => $this->category,
                        'level' => (string) LoggingLevel::INFO(),
                    ],
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $this->value,
                    ],
                    'id' => [
                        '_content' => $this->id,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AddAccountLoggerResponse' => [
                    'logger' => [
                        [
                            'category' => $this->category,
                            'level' => (string) LoggingLevel::INFO(),
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddAccountLoggerEnvelope::class, 'json'));
    }
}
