<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\NoteActionSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NoteActionSelector.
 */
class NoteActionSelectorTest extends ZimbraTestCase
{
    public function testNoteActionSelector()
    {
        $operation = $this->faker->word;
        $ids = $this->faker->uuid;
        $content = $this->faker->word;
        $bounds = $this->faker->word;

        $action = new NoteActionSelector(
            $operation, $ids, $content, $bounds
        );
        $this->assertSame($content, $action->getContent());
        $this->assertSame($bounds, $action->getBounds());

        $action = new NoteActionSelector();
        $action->setIds($ids)
            ->setOperation($operation)
            ->setContent($content)
            ->setBounds($bounds);
        $this->assertSame($content, $action->getContent());
        $this->assertSame($bounds, $action->getBounds());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation" content="$content" pos="$bounds" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, NoteActionSelector::class, 'xml'));
    }
}
