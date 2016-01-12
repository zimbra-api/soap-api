<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NewNoteSpec;

/**
 * Testcase class for NewNoteSpec.
 */
class NewNoteSpecTest extends ZimbraMailTestCase
{
    public function testNewNoteSpec()
    {
        $l = $this->faker->word;
        $content = $this->faker->uuid;
        $pos = $this->faker->word;
        $color = mt_rand(1, 127);
        $note = new NewNoteSpec(
            $l, $content, $color, $pos
        );
        $this->assertSame($l, $note->getFolder());
        $this->assertSame($content, $note->getContent());
        $this->assertSame($color, $note->getColor());
        $this->assertSame($pos, $note->getBounds());

        $note = new NewNoteSpec('', '');
        $note->setFolder($l)
             ->setContent($content)
             ->setColor($color)
             ->setBounds($pos);
        $this->assertSame($l, $note->getFolder());
        $this->assertSame($content, $note->getContent());
        $this->assertSame($color, $note->getColor());
        $this->assertSame($pos, $note->getBounds());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<note l="' . $l . '" content="' . $content . '" color="' . $color . '" pos="' . $pos . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $note);

        $array = array(
            'note' => array(
                'l' => $l,
                'content' => $content,
                'color' => $color,
                'pos' => $pos,
            ),
        );
        $this->assertEquals($array, $note->toArray());
    }
}
