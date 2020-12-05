<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\ContentType;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Account\Struct\Signature;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Signature.
 */
class SignatureTest extends ZimbraStructTestCase
{
    public function testSignature()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;

        $content1 = new SignatureContent($value, ContentType::TEXT_PLAIN());
        $content2 = new SignatureContent($value, ContentType::TEXT_HTML());

        $sig = new Signature($name, $id, $cid, [$content1]);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1], $sig->getContents());

        $sig = new Signature();
        $sig->setName($name)
            ->setId($id)
            ->setCid($cid)
            ->setContents([$content1])
            ->addContent($content2);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1, $content2], $sig->getContents());

        $textPlain = ContentType::TEXT_PLAIN()->getValue();
        $textHtml = ContentType::TEXT_HTML()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<signature name="$name" id="$id">
    <cid>$cid</cid>
    <content type="$textPlain">$value</content>
    <content type="$textHtml">$value</content>
</signature>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($sig, 'xml'));
        $this->assertEquals($sig, $this->serializer->deserialize($xml, Signature::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'cid' => [
                '_content' => $cid,
            ],
            'content' => [
                [
                    'type' => $textPlain,
                    '_content' => $value,
                ],
                [
                    'type' => $textHtml,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($sig, 'json'));
        $this->assertEquals($sig, $this->serializer->deserialize($json, Signature::class, 'json'));
    }
}
