<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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
        $conv = new StubConversationSpec(
            $id, $inlineRule, FALSE, $maxInlinedLength, FALSE, [$header]
        );
        $this->assertSame($id, $conv->getId());
        $this->assertSame($inlineRule, $conv->getInlineRule());
        $this->assertFalse($conv->getWantHtml());
        $this->assertSame($maxInlinedLength, $conv->getMaxInlinedLength());
        $this->assertFalse($conv->getNeedCanExpand());
        $this->assertSame([$header], $conv->getHeaders());

        $conv = new StubConversationSpec();
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
<result id="$id" fetch="$inlineRule" html="true" max="$maxInlinedLength" needExp="true" xmlns:urn="urn:zimbraMail">
    <urn:header n="$name" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($conv, 'xml'));
        $this->assertEquals($conv, $this->serializer->deserialize($xml, StubConversationSpec::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubConversationSpec extends ConversationSpec
{
}
