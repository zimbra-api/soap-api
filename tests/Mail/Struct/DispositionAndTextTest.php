<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DispositionAndText;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DispositionAndText.
 */
class DispositionAndTextTest extends ZimbraTestCase
{
    public function testDispositionAndText()
    {
        $disposition = $this->faker->word;
        $text = $this->faker->text;

        $chunk = new DispositionAndText($disposition, $text);
        $this->assertSame($disposition, $chunk->getDisposition());
        $this->assertSame($text, $chunk->getText());

        $chunk = new DispositionAndText();
        $chunk->setDisposition($disposition)
            ->setText($text);
        $this->assertSame($disposition, $chunk->getDisposition());
        $this->assertSame($text, $chunk->getText());

        $xml = <<<EOT
<?xml version="1.0"?>
<result disp="$disposition">$text</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($chunk, 'xml'));
        $this->assertEquals($chunk, $this->serializer->deserialize($xml, DispositionAndText::class, 'xml'));
    }
}
