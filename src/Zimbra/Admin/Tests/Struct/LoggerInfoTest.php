<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for LoggerInfo.
 */
class LoggerInfoTest extends ZimbraStructTestCase
{
    public function testLoggerInfo()
    {
        $category = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::ERROR()->value());
        $this->assertSame($category, $logger->getCategory());
        $this->assertSame(LoggingLevel::ERROR()->value(), $logger->getLevel());

        $logger = new LoggerInfo('');
        $logger->setCategory($category)
               ->setLevel(LoggingLevel::INFO()->value());
        $this->assertSame($category, $logger->getCategory());
        $this->assertSame(LoggingLevel::INFO()->value(), $logger->getLevel());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($logger, 'xml'));

        $logger = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\LoggerInfo', 'xml');
        $this->assertSame($category, $logger->getCategory());
        $this->assertSame(LoggingLevel::INFO()->value(), $logger->getLevel());
    }
}
