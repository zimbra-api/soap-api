<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Content;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Content.
 */
class ContentTest extends ZimbraTestCase
{
    public function testContent()
    {
        $attachUploadId = $this->faker->word;
        $value = $this->faker->text;

        $content = new Content($attachUploadId, $value);
        $this->assertSame($attachUploadId, $content->getAttachUploadId());
        $this->assertSame($value, $content->getValue());

        $content = new Content();
        $content->setAttachUploadId($attachUploadId)
            ->setValue($value);
        $this->assertSame($attachUploadId, $content->getAttachUploadId());
        $this->assertSame($value, $content->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result aid="$attachUploadId">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($content, 'xml'));
        $this->assertEquals($content, $this->serializer->deserialize($xml, Content::class, 'xml'));
    }
}
