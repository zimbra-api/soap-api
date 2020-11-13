<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\ContentType;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SignatureContent.
 */
class SignatureContentTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));
        $this->assertEquals($content, $this->serializer->deserialize($xml, SignatureContent::class, 'xml'));

        $json = json_encode([
            'type' => (string) ContentType::TEXT_HTML(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($content, 'json'));
        $this->assertEquals($content, $this->serializer->deserialize($json, SignatureContent::class, 'json'));
    }
}
