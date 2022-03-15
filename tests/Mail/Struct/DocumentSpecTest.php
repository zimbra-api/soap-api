<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Mail\Struct\MessagePartSpec;
use Zimbra\Mail\Struct\IdVersion;
use Zimbra\Struct\Id;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DocumentSpec.
 */
class DocumentSpecTest extends ZimbraTestCase
{
    public function testDocumentSpec()
    {
        $name = $this->faker->name;
        $contentType = $this->faker->word;
        $description = $this->faker->word;
        $folderId = $this->faker->word;
        $id = $this->faker->uuid;
        $version = mt_rand(1, 100);
        $content = $this->faker->word;
        $flags = $this->faker->word;
        $part = $this->faker->uuid;

        $upload = new Id($id);
        $messagePart = new MessagePartSpec($part, $id);
        $docRevision = new IdVersion($id, $version);

        $spec = new DocumentSpec(
            $name, $contentType, $description, $folderId, $id, $version, $content, FALSE, $flags, $upload, $messagePart, $docRevision
        );
        $this->assertSame($name, $spec->getName());
        $this->assertSame($contentType, $spec->getContentType());
        $this->assertSame($description, $spec->getDescription());
        $this->assertSame($folderId, $spec->getFolderId());
        $this->assertSame($id, $spec->getId());
        $this->assertSame($version, $spec->getVersion());
        $this->assertSame($content, $spec->getContent());
        $this->assertFalse($spec->getDescEnabled());
        $this->assertSame($flags, $spec->getFlags());
        $this->assertSame($upload, $spec->getUpload());
        $this->assertSame($messagePart, $spec->getMessagePart());
        $this->assertSame($docRevision, $spec->getDocRevision());

        $spec = new DocumentSpec();
        $spec->setName($name)
            ->setContentType($contentType)
            ->setDescription($description)
            ->setFolderId($folderId)
            ->setId($id)
            ->setVersion($version)
            ->setContent($content)
            ->setDescEnabled(TRUE)
            ->setFlags($flags)
            ->setUpload($upload)
            ->setMessagePart($messagePart)
            ->setDocRevision($docRevision);
        $this->assertSame($name, $spec->getName());
        $this->assertSame($contentType, $spec->getContentType());
        $this->assertSame($description, $spec->getDescription());
        $this->assertSame($folderId, $spec->getFolderId());
        $this->assertSame($id, $spec->getId());
        $this->assertSame($version, $spec->getVersion());
        $this->assertSame($content, $spec->getContent());
        $this->assertTrue($spec->getDescEnabled());
        $this->assertSame($flags, $spec->getFlags());
        $this->assertSame($upload, $spec->getUpload());
        $this->assertSame($messagePart, $spec->getMessagePart());
        $this->assertSame($docRevision, $spec->getDocRevision());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" ct="$contentType" desc="$description" l="$folderId" id="$id" ver="$version" content="$content" descEnabled="true" f="$flags">
    <upload id="$id" />
    <m part="$part" id="$id" />
    <doc id="$id" ver="$version" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, DocumentSpec::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'ct' => $contentType,
            'desc' => $description,
            'l' => $folderId,
            'id' => $id,
            'ver' => $version,
            'content' => $content,
            'descEnabled' => TRUE,
            'f' => $flags,
            'upload' => [
                'id' => $id,
            ],
            'm' => [
                'part' => $part,
                'id' => $id,
            ],
            'doc' => [
                'id' => $id,
                'ver' => $version,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($spec, 'json'));
        $this->assertEquals($spec, $this->serializer->deserialize($json, DocumentSpec::class, 'json'));
    }
}
