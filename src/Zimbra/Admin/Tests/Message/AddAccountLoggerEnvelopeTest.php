<?php

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
        $category = $this->faker->word;
        $value = $this->faker->word;
        $logger = new LoggerInfo($category, LoggingLevel::INFO()->value());
        $account = new AccountSelector(AccountBy::NAME()->value(), $value);
        $request = new AddAccountLoggerRequest($logger, $account);
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
                    . '</urn:AddAccountLoggerRequest>'
                    . '<urn:AddAccountLoggerResponse>'
                        . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                    . '</urn:AddAccountLoggerResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));

        $envelope = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddAccountLoggerEnvelope', 'xml');
        $body = $envelope->getBody();

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
