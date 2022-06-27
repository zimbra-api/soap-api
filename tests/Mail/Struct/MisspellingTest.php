<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Misspelling;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Misspelling.
 */
class MisspellingTest extends ZimbraTestCase
{
    public function testMisspelling()
    {
        $word = $this->faker->word;
        $suggestions = $this->faker->text;

        $missed = new Misspelling($word, $suggestions);
        $this->assertSame($word, $missed->getWord());
        $this->assertSame($suggestions, $missed->getSuggestions());

        $missed = new Misspelling('');
        $missed->setWord($word)
            ->setSuggestions($suggestions);
        $this->assertSame($word, $missed->getWord());
        $this->assertSame($suggestions, $missed->getSuggestions());

        $xml = <<<EOT
<?xml version="1.0"?>
<result word="$word" suggestions="$suggestions" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($missed, 'xml'));
        $this->assertEquals($missed, $this->serializer->deserialize($xml, Misspelling::class, 'xml'));
    }
}
