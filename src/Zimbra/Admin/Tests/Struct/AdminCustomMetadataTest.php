<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AdminCustomMetadata;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminCustomMetadata.
 */
class AdminCustomMetadataTest extends ZimbraStructTestCase
{
    public function testAdminCustomMetadata()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;

        $kvp = new KeyValuePair($key, $value);

        $meta = new AdminCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new AdminCustomMetadata;
        $meta->setSection($section)
             ->setKeyValuePairs([$kvp]);
        $this->assertSame($section, $meta->getSection());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<meta section="' . $section . '">'
                . '<a n="' . $key . '">' . $value. '</a>'
            . '</meta>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($meta, 'xml'));
        $this->assertEquals($meta, $this->serializer->deserialize($xml, AdminCustomMetadata::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
            'section' => $section,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($meta, 'json'));
        $this->assertEquals($meta, $this->serializer->deserialize($json, AdminCustomMetadata::class, 'json'));
    }
}
