<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\NewFileCreationTypes;
use Zimbra\Common\Struct\Id;

use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Mail\Struct\MessagePartSpec;
use Zimbra\Mail\Struct\IdVersion;

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
        $action = $this->faker->word;
        $type = NewFileCreationTypes::DOCUMENT;
        $part = $this->faker->uuid;
        $nodeId = $this->faker->uuid;

        $upload = new Id($id);
        $messagePart = new MessagePartSpec($part, $id);
        $docRevision = new IdVersion($id, $version);

        $doc = new StubDocumentSpec(
            $name, $contentType, $description, $folderId, $id, $version, $content, FALSE, $flags, $action, $type, $upload, $messagePart, $docRevision, $nodeId
        );
        $this->assertSame($name, $doc->getName());
        $this->assertSame($contentType, $doc->getContentType());
        $this->assertSame($description, $doc->getDescription());
        $this->assertSame($folderId, $doc->getFolderId());
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version, $doc->getVersion());
        $this->assertSame($content, $doc->getContent());
        $this->assertFalse($doc->getDescEnabled());
        $this->assertSame($flags, $doc->getFlags());
        $this->assertSame($action, $doc->getAction());
        $this->assertSame($type, $doc->getType());
        $this->assertSame($upload, $doc->getUpload());
        $this->assertSame($messagePart, $doc->getMessagePart());
        $this->assertSame($docRevision, $doc->getDocRevision());
        $this->assertSame($nodeId, $doc->getNodeId());

        $doc = new StubDocumentSpec();
        $doc->setName($name)
            ->setContentType($contentType)
            ->setDescription($description)
            ->setFolderId($folderId)
            ->setId($id)
            ->setVersion($version)
            ->setContent($content)
            ->setDescEnabled(TRUE)
            ->setFlags($flags)
            ->setAction($action)
            ->setType($type)
            ->setUpload($upload)
            ->setMessagePart($messagePart)
            ->setDocRevision($docRevision)
            ->setNodeId($nodeId);
        $this->assertSame($name, $doc->getName());
        $this->assertSame($contentType, $doc->getContentType());
        $this->assertSame($description, $doc->getDescription());
        $this->assertSame($folderId, $doc->getFolderId());
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version, $doc->getVersion());
        $this->assertSame($content, $doc->getContent());
        $this->assertTrue($doc->getDescEnabled());
        $this->assertSame($flags, $doc->getFlags());
        $this->assertSame($action, $doc->getAction());
        $this->assertSame($type, $doc->getType());
        $this->assertSame($upload, $doc->getUpload());
        $this->assertSame($messagePart, $doc->getMessagePart());
        $this->assertSame($docRevision, $doc->getDocRevision());
        $this->assertSame($nodeId, $doc->getNodeId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" ct="$contentType" desc="$description" l="$folderId" id="$id" ver="$version" content="$content" descEnabled="true" f="$flags" action="$action" type="document" nodeId="$nodeId" xmlns:urn="urn:zimbraMail">
    <urn:upload id="$id" />
    <urn:m part="$part" id="$id" />
    <urn:doc id="$id" ver="$version" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, StubDocumentSpec::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubDocumentSpec extends DocumentSpec
{
}
