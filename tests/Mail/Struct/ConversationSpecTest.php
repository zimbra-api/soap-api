<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Struct\AttributeName;
use Zimbra\Mail\Struct\ConversationSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConversationSpec.
 */
class ConversationSpecTest extends ZimbraTestCase
{
    public function testConversationSpec()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $inlineRule = $this->faker->word;
        $maxInlinedLength = $this->faker->randomNumber;

        $header = new AttributeName($name);
        $conv = new ConversationSpec(
            $id, $inlineRule, FALSE, $maxInlinedLength, FALSE, [$header]
        );
        $this->assertSame($id, $conv->getId());
        $this->assertSame($inlineRule, $conv->getInlineRule());
        $this->assertFalse($conv->getWantHtml());
        $this->assertSame($maxInlinedLength, $conv->getMaxInlinedLength());
        $this->assertFalse($conv->getNeedCanExpand());
        $this->assertSame([$header], $conv->getHeaders());

        $conv = new ConversationSpec();
        $conv->setId($id)
            ->setInlineRule($inlineRule)
            ->setWantHtml(TRUE)
            ->setMaxInlinedLength($maxInlinedLength)
            ->setNeedCanExpand(TRUE)
            ->setHeaders([$header])
            ->addHeader($header);
        $this->assertSame($id, $conv->getId());
        $this->assertSame($inlineRule, $conv->getInlineRule());
        $this->assertTrue($conv->getWantHtml());
        $this->assertSame($maxInlinedLength, $conv->getMaxInlinedLength());
        $this->assertTrue($conv->getNeedCanExpand());
        $this->assertSame([$header, $header], $conv->getHeaders());
        $conv->setHeaders([$header]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" fetch="$inlineRule" html="true" max="$maxInlinedLength" needExp="true">
    <header n="$name" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conv, 'xml'));
        $this->assertEquals($conv, $this->serializer->deserialize($xml, ConversationSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'fetch' => $inlineRule,
            'html' => TRUE,
            'max' => $maxInlinedLength,
            'needExp' => TRUE,
            'header' => [
                [
                    'n' => $name,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($conv, 'json'));
        $this->assertEquals($conv, $this->serializer->deserialize($json, ConversationSpec::class, 'json'));
    }
}
