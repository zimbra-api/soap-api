<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailCustomMetadata.
 */
class MailCustomMetadataTest extends ZimbraTestCase
{
    public function testMailCustomMetadata()
    {
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new MailCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new MailCustomMetadata;
        $meta->setSection($section)
             ->setKeyValuePairs([new KeyValuePair($key, $value)]);
        $this->assertSame($section, $meta->getSection());

        $xml = <<<EOT
<?xml version="1.0"?>
<result section="$section">
    <a n="$key">$value</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($meta, 'xml'));
        $this->assertEquals($meta, $this->serializer->deserialize($xml, MailCustomMetadata::class, 'xml'));

        $json = json_encode([
            'section' => $section,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($meta, 'json'));
        $this->assertEquals($meta, $this->serializer->deserialize($json, MailCustomMetadata::class, 'json'));
    }
}
