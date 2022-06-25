<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\NewNoteSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NewNoteSpec.
 */
class NewNoteSpecTest extends ZimbraTestCase
{
    public function testNewNoteSpec()
    {
        $folder = $this->faker->uuid;
        $content = $this->faker->uuid;
        $color = $this->faker->numberBetween(0, 127);
        $bounds = $this->faker->word;

        $note = new NewNoteSpec(
            $folder,
            $content,
            $color,
            $bounds
        );
        $this->assertSame($folder, $note->getFolder());
        $this->assertSame($content, $note->getContent());
        $this->assertSame($color, $note->getColor());
        $this->assertSame($bounds, $note->getBounds());

        $note = new NewNoteSpec('', '');
        $note->setFolder($folder)
            ->setContent($content)
            ->setColor($color)
            ->setBounds($bounds);
        $this->assertSame($folder, $note->getFolder());
        $this->assertSame($content, $note->getContent());
        $this->assertSame($color, $note->getColor());
        $this->assertSame($bounds, $note->getBounds());
 
        $xml = <<<EOT
<?xml version="1.0"?>
<result l="$folder" content="$content" color="$color" pos="$bounds" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($note, 'xml'));
        $this->assertEquals($note, $this->serializer->deserialize($xml, NewNoteSpec::class, 'xml'));

        $json = json_encode([
            'l' => $folder,
            'content' => $content,
            'color' => $color,
            'pos' => $bounds,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($note, 'json'));
        $this->assertEquals($note, $this->serializer->deserialize($json, NewNoteSpec::class, 'json'));
    }
}
