<?php

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

        $content1 = new SignatureContent($value, ContentType::TEXT_PLAIN()->value());
        $content2 = new SignatureContent($value, ContentType::TEXT_HTML()->value());

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<signature name="' . $name . '" id="' . $id . '">'
                . '<cid>' . $cid . '</cid>'
                . '<content type="' . ContentType::TEXT_PLAIN() . '">' . $value . '</content>'
                . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>'
            . '</signature>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($sig, 'xml'));

        $sig = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\Signature', 'xml');
        $content1 = $sig->getContents()[0];
        $content2 = $sig->getContents()[1];

        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame($value, $content1->getValue());
        $this->assertSame(ContentType::TEXT_PLAIN()->value(), $content1->getContentType());
        $this->assertSame($value, $content2->getValue());
        $this->assertSame(ContentType::TEXT_HTML()->value(), $content2->getContentType());
    }
}
