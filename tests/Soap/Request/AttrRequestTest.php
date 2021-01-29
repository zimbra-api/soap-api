<?php declare(strict_types=1);

namespace Zimbra\Tests\Soap\Request;

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Soap\Request\Attr;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AttrRequest.
 */
class AttrRequestTest extends ZimbraStructTestCase
{
    public function testAttrRequest()
    {
        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $attr1 = new KeyValuePair($key1, $value1);

        $key2 = $this->faker->word;
        $value2 = $this->faker->word;
        $attr2 = new KeyValuePair($key2, $value2);

        $key3 = $this->faker->word;
        $value3 = $this->faker->word;
        $attr3 = new KeyValuePair($key3, $value3);

        $req = new AttrRequestImp([$attr1]);
        $this->assertEquals([$attr1], $req->getAttrs());

        $req->setAttrs([$attr1, $attr2]);
        $this->assertEquals([$attr1, $attr2], $req->getAttrs());

        $req->addAttr($attr3);
        $this->assertEquals([$attr1, $attr2, $attr3], $req->getAttrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<AttrRequest>
    <a n="$key1">$value1</a>
    <a n="$key2">$value2</a>
    <a n="$key3">$value3</a>
</AttrRequest>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AttrRequestImp::class, 'xml'));
    }
}

/**
 * @XmlRoot(name="AttrRequest")
 */
class AttrRequestImp extends Attr
{
    protected function envelopeInit(): void
    {
    }
}
