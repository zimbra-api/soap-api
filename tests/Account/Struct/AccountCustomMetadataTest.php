<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountCustomMetadata;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountCustomMetadata.
 */
class AccountCustomMetadataTest extends ZimbraTestCase
{
    public function testAccountCustomMetadata()
    {
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new AccountCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new AccountCustomMetadata;
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
        $this->assertEquals($meta, $this->serializer->deserialize($xml, AccountCustomMetadata::class, 'xml'));

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
        $this->assertEquals($meta, $this->serializer->deserialize($json, AccountCustomMetadata::class, 'json'));
    }
}
