<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Mail\Struct\MessagePartSpec;
use Zimbra\Mail\Struct\IdVersion;
use Zimbra\Common\Struct\Id;

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

        $spec = new StubDocumentSpec(
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

        $spec = new StubDocumentSpec();
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
<result name="$name" ct="$contentType" desc="$description" l="$folderId" id="$id" ver="$version" content="$content" descEnabled="true" f="$flags" xmlns:urn="urn:zimbraMail">
    <urn:upload id="$id" />
    <urn:m part="$part" id="$id" />
    <urn:doc id="$id" ver="$version" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, StubDocumentSpec::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubDocumentSpec extends DocumentSpec
{
}
