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
 * Testcase class for AddAccountLoggerEnvelope.
 */
class AddAccountLoggerEnvelopeTest extends ZimbraStructTestCase
{
    public function testAddAccountLoggerBody()
    {
        $id = $this->faker->uuid;
        $category = $this->faker->word;
        $value = $this->faker->word;
        $logger = new LoggerInfo($category, LoggingLevel::INFO());
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $request = new AddAccountLoggerRequest($logger, $account, $id);
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
                        . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<id>' . $id . '</id>'
                    . '</urn:AddAccountLoggerRequest>'
                    . '<urn:AddAccountLoggerResponse>'
                        . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                    . '</urn:AddAccountLoggerResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddAccountLoggerEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddAccountLoggerRequest' => [
                    'logger' => [
                        'category' => $category,
                        'level' => (string) LoggingLevel::INFO(),
                    ],
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
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
