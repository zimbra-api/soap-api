<?php

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

        $content = new SignatureContent($value, ContentType::TEXT_PLAIN()->value());
        $this->assertSame($value, $content->getValue());
        $this->assertSame(ContentType::TEXT_PLAIN()->value(), $content->getContentType());

        $content = new SignatureContent();
        $content
            ->setValue($value)
            ->setContentType(ContentType::TEXT_HTML()->value());
        $this->assertSame($value, $content->getValue());
        $this->assertSame(ContentType::TEXT_HTML()->value(), $content->getContentType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));

        $content = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\SignatureContent', 'xml');
        $this->assertSame($value, $content->getValue());
        $this->assertSame(ContentType::TEXT_HTML()->value(), $content->getContentType());
    }
}
