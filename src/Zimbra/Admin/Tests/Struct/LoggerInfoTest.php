<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\LoggingLevel;

/**
 * Testcase class for LoggerInfo.
 */
class LoggerInfoTest extends ZimbraAdminTestCase
{
    public function testLoggerInfo()
    {
        $value = $this->faker->word;

        $logger = new LoggerInfo($value, LoggingLevel::ERROR());
        $this->assertSame($value, $logger->getCategory());
        $this->assertSame('error', $logger->getLevel()->value());

        $logger->setCategory($value)
               ->setLevel(LoggingLevel::INFO());
        $this->assertSame($value, $logger->getCategory());
        $this->assertSame('info', $logger->getLevel()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<logger category="' . $value . '" level="' . LoggingLevel::INFO() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $logger);

        $array = [
            'logger' => [
                'category' => $value,
                'level' => LoggingLevel::INFO()->value(),
            ],
        ];
        $this->assertEquals($array, $logger->toArray());
    }
}
