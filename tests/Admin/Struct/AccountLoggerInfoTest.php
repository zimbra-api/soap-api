<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AccountLoggerInfo;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Common\Enum\LoggingLevel;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountLoggerInfo.
 */
class AccountLoggerInfoTest extends ZimbraTestCase
{
    public function testAccountLoggerInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $category = $this->faker->word;
        $logger = new LoggerInfo($category, LoggingLevel::INFO());

        $accountLogger = new StubAccountLoggerInfo($name, $id, [$logger]);
        $this->assertSame($name, $accountLogger->getName());
        $this->assertSame($id, $accountLogger->getId());
        $this->assertSame([$logger], $accountLogger->getLoggers());

        $accountLogger = new StubAccountLoggerInfo();
        $accountLogger->setName($name)
             ->setId($id)
             ->setLoggers([$logger]);
        $this->assertSame($name, $accountLogger->getName());
        $this->assertSame($id, $accountLogger->getId());
        $this->assertSame([$logger], $accountLogger->getLoggers());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:logger category="$category" level="info" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($accountLogger, 'xml'));
        $this->assertEquals($accountLogger, $this->serializer->deserialize($xml, StubAccountLoggerInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubAccountLoggerInfo extends AccountLoggerInfo
{
}
