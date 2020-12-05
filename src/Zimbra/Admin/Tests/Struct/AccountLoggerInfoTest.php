<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AccountLoggerInfo;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountLoggerInfo.
 */
class AccountLoggerInfoTest extends ZimbraStructTestCase
{
    public function testAccountLoggerInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $category = $this->faker->word;
        $logger = new LoggerInfo($category, LoggingLevel::INFO());

        $accountLogger = new AccountLoggerInfo($name, $id, [$logger]);
        $this->assertSame($name, $accountLogger->getName());
        $this->assertSame($id, $accountLogger->getId());
        $this->assertSame([$logger], $accountLogger->getLoggers());

        $accountLogger = new AccountLoggerInfo('', '');
        $accountLogger->setName($name)
             ->setId($id)
             ->setLoggers([$logger])
             ->addLogger($logger);
        $this->assertSame($name, $accountLogger->getName());
        $this->assertSame($id, $accountLogger->getId());
        $this->assertSame([$logger, $logger], $accountLogger->getLoggers());
        $accountLogger->setLoggers([$logger]);

        $level = LoggingLevel::INFO()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<accountLogger name="$name" id="$id">
    <logger category="$category" level="$level" />
</accountLogger>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($accountLogger, 'xml'));
        $this->assertEquals($accountLogger, $this->serializer->deserialize($xml, AccountLoggerInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'logger' => [
                [
                    'category' => $category,
                    'level' => $level,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($accountLogger, 'json'));
        $this->assertEquals($accountLogger, $this->serializer->deserialize($json, AccountLoggerInfo::class, 'json'));
    }
}
