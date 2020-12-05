<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Enum\LoggingLevel;
use Zimbra\Mail\Struct\LogAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for LogAction.
 */
class LogActionTest extends ZimbraStructTestCase
{
    public function testLogAction()
    {
        $index = mt_rand(1, 99);
        $content = $this->faker->word;

        $action = new LogAction($index, LoggingLevel::ERROR(), $content);
        $this->assertEquals(LoggingLevel::ERROR(), $action->getLevel());
        $this->assertSame($content, $action->getContent());

        $action = new LogAction($index);
        $action->setLevel(LoggingLevel::INFO())
            ->setContent($content);
        $this->assertEquals(LoggingLevel::INFO(), $action->getLevel());
        $this->assertSame($content, $action->getContent());

        $level = LoggingLevel::INFO()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<actionLog index="$index" level="$level">$content</actionLog>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, LogAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'level' => $level,
            '_content' => $content,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, LogAction::class, 'json'));
    }
}
