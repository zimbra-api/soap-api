<?php declare(strict_types=1);

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

        $logger1 = new LoggerInfo($category1, LoggingLevel::INFO());
        $logger2 = new LoggerInfo($category2, LoggingLevel::ERROR());

        $res = new AddAccountLoggerResponse([$logger1]);
        $this->assertSame([$logger1], $res->getLoggers());

        $res = new AddAccountLoggerResponse();
        $res->setLoggers([$logger1])
            ->addLogger($logger2);
        $this->assertSame([$logger1, $logger2], $res->getLoggers());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerResponse>'
                . '<logger category="' . $category1 . '" level="' . LoggingLevel::INFO() . '" />'
                . '<logger category="' . $category2 . '" level="' . LoggingLevel::ERROR() . '" />'
            . '</AddAccountLoggerResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddAccountLoggerResponse::class, 'xml'));

        $json = json_encode([
            'logger' => [
                [
                    'category' => $category1,
                    'level' => (string) LoggingLevel::INFO(),
                ],
                [
                    'category' => $category2,
                    'level' => (string) LoggingLevel::ERROR(),
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddAccountLoggerResponse::class, 'json'));
    }
}
