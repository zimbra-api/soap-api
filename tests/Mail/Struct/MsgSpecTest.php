<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\MsgContent;
use Zimbra\Common\Struct\AttributeName;
use Zimbra\Mail\Struct\MsgSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MsgSpec.
 */
class MsgSpecTest extends ZimbraTestCase
{
    public function testMsgSpec()
    {
        $id = $this->faker->uuid;
        $part = $this->faker->word;
        $recurIdZ = $this->faker->uuid;
        $name = $this->faker->word;
        $maxInlinedLength = $this->faker->randomNumber;
        $wantContent = MsgContent::FULL;

        $header = new AttributeName($name);
        $msg = new StubMsgSpec(
            $id, $part, FALSE, FALSE, $maxInlinedLength, FALSE, FALSE, FALSE, FALSE, FALSE, $recurIdZ, FALSE, $wantContent, [$header]
        );
        $this->assertSame($id, $msg->getId());
        $this->assertSame($part, $msg->getPart());
        $this->assertFalse($msg->getRaw());
        $this->assertFalse($msg->getMarkRead());
        $this->assertSame($maxInlinedLength, $msg->getMaxInlinedLength());
        $this->assertFalse($msg->getUseContentUrl());
        $this->assertFalse($msg->getWantHtml());
        $this->assertFalse($msg->getWantImapUid());
        $this->assertFalse($msg->getWantModifiedSequence());
        $this->assertFalse($msg->getNeuter());
        $this->assertSame($recurIdZ, $msg->getRecurIdZ());
        $this->assertFalse($msg->getNeedCanExpand());
        $this->assertSame($wantContent, $msg->getWantContent());
        $this->assertSame([$header], $msg->getHeaders());

        $msg = new StubMsgSpec();
        $msg->setId($id)
            ->setPart($part)
            ->setRaw(TRUE)
            ->setMarkRead(TRUE)
            ->setMaxInlinedLength($maxInlinedLength)
            ->setUseContentUrl(TRUE)
            ->setWantHtml(TRUE)
            ->setWantImapUid(TRUE)
            ->setWantModifiedSequence(TRUE)
            ->setNeuter(TRUE)
            ->setRecurIdZ($recurIdZ)
            ->setNeedCanExpand(TRUE)
            ->setWantContent($wantContent)
            ->setHeaders([$header])
            ->addHeader($header);
        $this->assertSame($id, $msg->getId());
        $this->assertSame($part, $msg->getPart());
        $this->assertTrue($msg->getRaw());
        $this->assertTrue($msg->getMarkRead());
        $this->assertSame($maxInlinedLength, $msg->getMaxInlinedLength());
        $this->assertTrue($msg->getUseContentUrl());
        $this->assertTrue($msg->getWantHtml());
        $this->assertTrue($msg->getWantImapUid());
        $this->assertTrue($msg->getWantModifiedSequence());
        $this->assertTrue($msg->getNeuter());
        $this->assertSame($recurIdZ, $msg->getRecurIdZ());
        $this->assertTrue($msg->getNeedCanExpand());
        $this->assertSame($wantContent, $msg->getWantContent());
        $this->assertSame([$header, $header], $msg->getHeaders());
        $msg->setHeaders([$header]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" part="$part" raw="true" read="true" max="$maxInlinedLength" useContentUrl="true" html="true" wantImapUid="true" wantModSeq="true" neuter="true" ridZ="$recurIdZ" needExp="true" wantContent="full" xmlns:urn="urn:zimbraMail">
    <urn:header n="$name" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($msg, 'xml'));
        $this->assertEquals($msg, $this->serializer->deserialize($xml, StubMsgSpec::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubMsgSpec extends MsgSpec
{
}
