<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\ContentType;
use Zimbra\Account\Struct\SignatureContent;

/**
 * Testcase class for SignatureContent.
 */
class SignatureContentTest extends ZimbraAccountTestCase
{
    public function testSignatureContent()
    {
        $value = $this->faker->word;

        $content = new SignatureContent($value, ContentType::TEXT_PLAIN());
        $this->assertSame($value, $content->getValue());
        $this->assertSame('text/plain', $content->getContentType()->value());

        $content->setContentType(ContentType::TEXT_HTML());
        $this->assertSame('text/html', $content->getContentType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = [
            'content' => [
                'type' => ContentType::TEXT_HTML()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $content->toArray());
    }
}
