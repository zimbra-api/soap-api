<?php

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountLoggerResponse;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountLoggerResponse.
 */
class AddAccountLoggerResponseTest extends ZimbraStructTestCase
{
    public function testAddAccountLoggerResponse()
    {
        $category1 = $this->faker->word;
        $category2 = $this->faker->word;

        $logger1 = new LoggerInfo($category1, LoggingLevel::INFO()->value());
        $logger2 = new LoggerInfo($category2, LoggingLevel::ERROR()->value());

        $res = new AddAccountLoggerResponse([$logger1]);
        $this->assertSame([$logger1], $res->getLoggers());

        $res = new AddAccountLoggerResponse();
        $res->setLoggers([$logger1])
            ->addLogger($logger2);
        $this->assertSame([$logger1, $logger2], $res->getLoggers());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerResponse xmlns="urn:zimbraAdmin">'
                . '<logger category="' . $category1 . '" level="' . LoggingLevel::INFO() . '" />'
                . '<logger category="' . $category2 . '" level="' . LoggingLevel::ERROR() . '" />'
            . '</AddAccountLoggerResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));

        $res = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddAccountLoggerResponse', 'xml');
        $logger1 = $res->getLoggers()[0];
        $logger2 = $res->getLoggers()[1];

        $this->assertSame($category1, $logger1->getCategory());
        $this->assertSame(LoggingLevel::INFO()->value(), $logger1->getLevel());
        $this->assertSame($category2, $logger2->getCategory());
        $this->assertSame(LoggingLevel::ERROR()->value(), $logger2->getLevel());
    }
}
