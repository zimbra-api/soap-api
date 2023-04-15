<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Struct\WildcardExpansionQueryInfo;

use Zimbra\Mail\Struct\NestedSearchConversation;
use Zimbra\Mail\Struct\MessageHitInfo;
use Zimbra\Mail\Struct\Part;
use Zimbra\Mail\Struct\SearchQueryInfo;
use Zimbra\Mail\Struct\SuggestedQueryString;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NestedSearchConversation.
 */
class NestedSearchConversationTest extends ZimbraTestCase
{
    public function testNestedSearchConversation()
    {
        $id = $this->faker->uuid;
        $num = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $sortField = $this->faker->word;
        $part = $this->faker->word;
        $string = $this->faker->word;
        $numExpanded = $this->faker->randomNumber;

        $msgHit = new MessageHitInfo(
            $id, $sortField, TRUE, [new Part($part)]
        );
        $queryInfo = new SearchQueryInfo(
            [new SuggestedQueryString($string)], [new WildcardExpansionQueryInfo($string, TRUE, $numExpanded)]
        );

        $conv = new StubNestedSearchConversation(
            $id, $num, $totalSize, $flags, $tags, $tagNames, [$msgHit], $queryInfo
        );
        $this->assertSame($id, $conv->getId());
        $this->assertSame($num, $conv->getNum());
        $this->assertSame($totalSize, $conv->getTotalSize());
        $this->assertSame($flags, $conv->getFlags());
        $this->assertSame($tags, $conv->getTags());
        $this->assertSame($tagNames, $conv->getTagNames());
        $this->assertSame([$msgHit], $conv->getMessages());
        $this->assertSame($queryInfo, $conv->getQueryInfo());

        $conv = new StubNestedSearchConversation();
        $conv->setId($id)
            ->setNum($num)
            ->setTotalSize($totalSize)
            ->setFlags($flags)
            ->setTags($tags)
            ->setTagNames($tagNames)
            ->setMessages([$msgHit])
            ->setQueryInfo($queryInfo);
        $this->assertSame($id, $conv->getId());
        $this->assertSame($num, $conv->getNum());
        $this->assertSame($totalSize, $conv->getTotalSize());
        $this->assertSame($flags, $conv->getFlags());
        $this->assertSame($tags, $conv->getTags());
        $this->assertSame($tagNames, $conv->getTagNames());
        $this->assertSame([$msgHit], $conv->getMessages());
        $this->assertSame($queryInfo, $conv->getQueryInfo());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" n="$num" total="$totalSize" f="$flags" t="$tags" tn="$tagNames" xmlns:urn="urn:zimbraMail">
    <urn:m sf="$sortField" cm="true" id="$id">
        <urn:hp part="$part" />
    </urn:m>
    <urn:info>
        <urn:suggest>$string</urn:suggest>
        <urn:wildcard str="$string" expanded="true" numExpanded="$numExpanded" />
    </urn:info>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conv, 'xml'));
        $this->assertEquals($conv, $this->serializer->deserialize($xml, StubNestedSearchConversation::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubNestedSearchConversation extends NestedSearchConversation
{
}
