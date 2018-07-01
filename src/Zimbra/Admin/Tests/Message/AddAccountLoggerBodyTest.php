<?php

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
        $category = $this->faker->word;
        $value = $this->faker->word;
        $logger = new LoggerInfo($category, LoggingLevel::INFO()->value());
        $account = new AccountSelector(AccountBy::NAME()->value(), $value);
        $request = new AddAccountLoggerRequest($logger, $account);
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
                . '</urn:AddAccountLoggerRequest>'
                . '<urn:AddAccountLoggerResponse>'
                    . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                . '</urn:AddAccountLoggerResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));

        $body = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddAccountLoggerBody', 'xml');

        $request = $body->getRequest();
        $logger = $request->getLogger();
        $account = $request->getAccount();
        $this->assertSame($category, $logger->getCategory());
        $this->assertSame(LoggingLevel::INFO()->value(), $logger->getLevel());
        $this->assertSame(AccountBy::NAME()->value(), $account->getBy());
        $this->assertSame($value, $account->getValue());

        $response = $body->getResponse();
        $logger = $response->getLoggers()[0];
        $this->assertSame($category, $logger->getCategory());
        $this->assertSame(LoggingLevel::INFO()->value(), $logger->getLevel());
    }
}
