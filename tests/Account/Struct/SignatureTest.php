<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Common\Enum\ContentType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Signature.
 */
class SignatureTest extends ZimbraTestCase
{
    public function testSignature()
    {
        $value = $this->faker->word;
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $cid = $this->faker->word;

        $content1 = new SignatureContent($value, ContentType::TEXT_PLAIN());
        $content2 = new SignatureContent($value, ContentType::TEXT_HTML());

        $sig = new MockSignature($name, $id, $cid, [$content1]);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1], $sig->getContents());

        $sig = new MockSignature();
        $sig->setName($name)
            ->setId($id)
            ->setCid($cid)
            ->setContents([$content1])
            ->addContent($content2);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1, $content2], $sig->getContents());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAccount">
    <urn:cid>$cid</urn:cid>
    <urn:content type="text/plain">$value</urn:content>
    <urn:content type="text/html">$value</urn:content>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($sig, 'xml'));
        $this->assertEquals($sig, $this->serializer->deserialize($xml, MockSignature::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockSignature extends Signature
{
}
