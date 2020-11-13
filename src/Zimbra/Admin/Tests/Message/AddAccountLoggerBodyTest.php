<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountLoggerBody;
use Zimbra\Admin\Message\AddAccountLoggerRequest;
use Zimbra\Admin\Message\AddAccountLoggerResponse;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountLoggerBody.
 */
class AddAccountLoggerBodyTest extends ZimbraStructTestCase
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
                    . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                    . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                    . '<id>' . $id . '</id>'
                . '</urn:AddAccountLoggerRequest>'
                . '<urn:AddAccountLoggerResponse>'
                    . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                . '</urn:AddAccountLoggerResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddAccountLoggerBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddAccountLoggerBody::class, 'json'));
    }
}
