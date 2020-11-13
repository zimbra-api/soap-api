<?php declare(strict_types=1);

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

        $logger = new LoggerInfo($category, LoggingLevel::ERROR());
        $this->assertSame($category, $logger->getCategory());
        $this->assertEquals(LoggingLevel::ERROR(), $logger->getLevel());

        $logger = new LoggerInfo('');
        $logger->setCategory($category)
               ->setLevel(LoggingLevel::INFO());
        $this->assertSame($category, $logger->getCategory());
        $this->assertEquals(LoggingLevel::INFO(), $logger->getLevel());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($logger, 'xml'));
        $this->assertEquals($logger, $this->serializer->deserialize($xml, LoggerInfo::class, 'xml'));

        $json = json_encode([
            'category' => $category,
            'level' => (string) LoggingLevel::INFO(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($logger, 'json'));
        $this->assertEquals($logger, $this->serializer->deserialize($json, LoggerInfo::class, 'json'));
    }
}
