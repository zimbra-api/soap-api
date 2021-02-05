<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Enum\ContentType;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SignatureContent.
 */
class SignatureContentTest extends ZimbraTestCase
{
    public function testSignatureContent()
    {
        $value = $this->faker->word;

        $content = new SignatureContent($value, ContentType::TEXT_PLAIN());
        $this->assertSame($value, $content->getValue());
        $this->assertEquals(ContentType::TEXT_PLAIN(), $content->getContentType());

        $content = new SignatureContent();
        $content
            ->setValue($value)
            ->setContentType(ContentType::TEXT_HTML());
        $this->assertSame($value, $content->getValue());
        $this->assertEquals(ContentType::TEXT_HTML(), $content->getContentType());

        $type = ContentType::TEXT_HTML()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<content type="$type">$value</content>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));
        $this->assertEquals($content, $this->serializer->deserialize($xml, SignatureContent::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($content, 'json'));
        $this->assertEquals($content, $this->serializer->deserialize($json, SignatureContent::class, 'json'));
    }
}