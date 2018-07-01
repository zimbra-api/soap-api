<?php

namespace Zimbra\Soap\Tests\Request;

use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\AccountBy;
use Zimbra\Soap\ClientInterface;
use Zimbra\Soap\Request\Attr;
use Zimbra\Struct\AttrRequest;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AttrRequest>'
                .'<a n="' . $key1 . '">' . $value1 . '</a>'
                .'<a n="' . $key2 . '">' . $value2 . '</a>'
                .'<a n="' . $key3 . '">' . $value3 . '</a>'
            .'</AttrRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));

        $req = $this->serializer->deserialize($xml, 'Zimbra\Soap\Tests\Request\AttrRequestImp', 'xml');
        $attrs = [$attr1, $attr2, $attr3];
        foreach ($req->getAttrs() as $key => $attr) {
            $this->assertEquals($attrs[$key]->getKey(), $attr->getKey());
            $this->assertEquals($attrs[$key]->getValue(), $attr->getValue());
        }
    }
}

/**
 * @XmlRoot(name="AttrRequest")
 */
class AttrRequestImp extends Attr
{
    public function execute(ClientInterface $client) {}
}
