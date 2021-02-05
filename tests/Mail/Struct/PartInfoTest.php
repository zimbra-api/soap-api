<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PartInfo.
 */
class PartInfoTest extends ZimbraTestCase
{
    public function testPartInfo()
    {
        $part = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $mimePart = new PartInfo($part, $contentType);
        $mp = new PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, FALSE, FALSE, $content, [$mimePart]
        );
        $this->assertSame($part, $mp->getPart());
        $this->assertSame($contentType, $mp->getContentType());
        $this->assertSame($size, $mp->getSize());
        $this->assertSame($contentDisposition, $mp->getContentDisposition());
        $this->assertSame($contentFilename, $mp->getContentFilename());
        $this->assertSame($contentId, $mp->getContentId());
        $this->assertSame($location, $mp->getLocation());
        $this->assertFalse($mp->getBody());
        $this->assertFalse($mp->getTruncatedContent());
        $this->assertSame($content, $mp->getContent());
        $this->assertSame([$mimePart], $mp->getMimeParts());

        $mp = new PartInfo('', '');
        $mp->setPart($part)
            ->setContentType($contentType)
            ->setSize($size)
            ->setContentDisposition($contentDisposition)
            ->setContentFilename($contentFilename)
            ->setContentId($contentId)
            ->setLocation($location)
            ->setBody(TRUE)
            ->setTruncatedContent(TRUE)
            ->setContent($content)
            ->setMimeParts([$mimePart])
            ->addMimePart($mimePart);
        $this->assertSame($part, $mp->getPart());
        $this->assertSame($contentType, $mp->getContentType());
        $this->assertSame($size, $mp->getSize());
        $this->assertSame($contentDisposition, $mp->getContentDisposition());
        $this->assertSame($contentFilename, $mp->getContentFilename());
        $this->assertSame($contentId, $mp->getContentId());
        $this->assertSame($location, $mp->getLocation());
        $this->assertTrue($mp->getBody());
        $this->assertTrue($mp->getTruncatedContent());
        $this->assertSame($content, $mp->getContent());
        $this->assertSame([$mimePart, $mimePart], $mp->getMimeParts());
        $mp->setMimeParts([$mimePart]);

        $xml = <<<EOT
<?xml version="1.0"?>
<mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
    <content>$content</content>
    <mp part="$part" ct="$contentType" />
</mp>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mp, 'xml'));
        $this->assertEquals($mp, $this->serializer->deserialize($xml, PartInfo::class, 'xml'));

        $json = json_encode([
            'part' => $part,
            'ct' => $contentType,
            's' => $size,
            'cd' => $contentDisposition,
            'filename' => $contentFilename,
            'ci' => $contentId,
            'cl' => $location,
            'body' => TRUE,
            'truncated' => TRUE,
            'content' => [
                '_content' => $content,
            ],
            'mp' => [
                [
                    'part' => $part,
                    'ct' => $contentType,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mp, 'json'));
        $this->assertEquals($mp, $this->serializer->deserialize($json, PartInfo::class, 'json'));
    }
}