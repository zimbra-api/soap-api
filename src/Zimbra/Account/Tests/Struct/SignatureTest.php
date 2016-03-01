<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\ContentType;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Account\Struct\Signature;

/**
 * Testcase class for Signature.
 */
class SignatureTest extends ZimbraAccountTestCase
{
    public function testSignature()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;

        $content1 = new SignatureContent($value, ContentType::TEXT_PLAIN());
        $content2 = new SignatureContent($value, ContentType::TEXT_HTML());

        $sig = new Signature($name, $id, $cid, [$content1]);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1], $sig->getContents()->all());

        $sig->setName($name)
            ->setId($id)
            ->setCid($cid)
            ->addContent($content2);
        $this->assertSame($name, $sig->getName());
        $this->assertSame($id, $sig->getId());
        $this->assertSame($cid, $sig->getCid());
        $this->assertSame([$content1, $content2], $sig->getContents()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<signature name="' . $name . '" id="' . $id . '">'
                . '<cid>' . $cid . '</cid>'
                . '<content type="' . ContentType::TEXT_PLAIN() . '">' . $value . '</content>'
                . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>'
            . '</signature>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sig);

        $array = [
            'signature' => [
                'name' => $name,
                'id' => $id,
                'cid' => $cid,
                'content' => [
                    [
                        'type' => ContentType::TEXT_PLAIN()->value(),
                        '_content' => $value,
                    ],
                    [
                        'type' => ContentType::TEXT_HTML()->value(),
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $sig->toArray());
    }
}
