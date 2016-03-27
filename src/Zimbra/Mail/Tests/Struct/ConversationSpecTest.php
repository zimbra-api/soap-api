<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Struct\AttributeName;
use Zimbra\Mail\Struct\ConversationSpec;

/**
 * Testcase class for ConversationSpec.
 */
class ConversationSpecTest extends ZimbraMailTestCase
{
    public function testConversationSpec()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $fetch = $this->faker->word;
        $max = mt_rand(1, 100);
        $header = new AttributeName($name);

        $c = new ConversationSpec(
            $id, $fetch, false, $max, false, [$header]
        );
        $this->assertSame($id, $c->getId());
        $this->assertSame($fetch, $c->getInlineRule());
        $this->assertFalse($c->getWantHtml());
        $this->assertSame($max, $c->getMaxInlinedLength());
        $this->assertFalse($c->getNeedCanExpand());
        $this->assertSame([$header], $c->getHeaders()->all());

        $c->setId($id)
          ->setInlineRule($fetch)
          ->setWantHtml(true)
          ->setMaxInlinedLength($max)
          ->setNeedCanExpand(true)
          ->addHeader($header);
        $this->assertSame($id, $c->getId());
        $this->assertSame($fetch, $c->getInlineRule());
        $this->assertTrue($c->getWantHtml());
        $this->assertSame($max, $c->getMaxInlinedLength());
        $this->assertTrue($c->getNeedCanExpand());
        $this->assertSame([$header, $header], $c->getHeaders()->all());

        $c->getHeaders()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<c id="' . $id . '" fetch="' . $fetch . '" html="true" max="' . $max . '" needExp="true">'
                .'<header n="' . $name . '" />'
            .'</c>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $c);

        $array = array(
            'c' => array(
                'id' => $id,
                'fetch' => $fetch,
                'html' => true,
                'max' => $max,
                'needExp' => true,
                'header' => array(
                    array(
                        'n' => $name,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $c->toArray());
    }
}
