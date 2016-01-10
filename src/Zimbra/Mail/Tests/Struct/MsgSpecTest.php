<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MsgSpec;
use Zimbra\Struct\AttributeName;

/**
 * Testcase class for MsgSpec.
 */
class MsgSpecTest extends ZimbraMailTestCase
{
    public function testMsgSpec()
    {
        $id = $this->faker->word;
        $part = $this->faker->word;
        $ridZ = $this->faker->iso8601;
        $name = $this->faker->word;
        $max = mt_rand(1, 10);

        $header = new AttributeName($name);
        $m = new MsgSpec(
            $id, $part, true, true, $max, true, true, $ridZ, true, [$header]
        );
        $this->assertSame($id, $m->getId());
        $this->assertSame($part, $m->getPart());
        $this->assertTrue($m->getRaw());
        $this->assertTrue($m->getRead());
        $this->assertSame($max, $m->getMaxInlinedLength());
        $this->assertTrue($m->getWantHtml());
        $this->assertTrue($m->getNeuter());
        $this->assertSame($ridZ, $m->getRecurIdZ());
        $this->assertTrue($m->getNeedCanExpand());
        $this->assertSame([$header], $m->getHeaders()->all());

        $m->setId($id)
          ->setPart($part)
          ->setRaw(true)
          ->setRead(true)
          ->setMaxInlinedLength($max)
          ->setWantHtml(true)
          ->setNeuter(true)
          ->setRecurIdZ($ridZ)
          ->setNeedCanExpand(true)
          ->addHeader($header);
        $this->assertSame($id, $m->getId());
        $this->assertSame($part, $m->getPart());
        $this->assertTrue($m->getRaw());
        $this->assertTrue($m->getRead());
        $this->assertSame($max, $m->getMaxInlinedLength());
        $this->assertTrue($m->getWantHtml());
        $this->assertTrue($m->getNeuter());
        $this->assertSame($ridZ, $m->getRecurIdZ());
        $this->assertTrue($m->getNeedCanExpand());
        $this->assertSame([$header, $header], $m->getHeaders()->all());

        $m->getHeaders()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m id="' . $id . '" part="' . $part . '" raw="true" read="true" max="' . $max . '" html="true" neuter="true" ridZ="' . $ridZ . '" needExp="true">'
                .'<header n="' . $name . '" />'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => $id,
                'part' => $part,
                'raw' => true,
                'read' => true,
                'max' => $max,
                'html' => true,
                'neuter' => true,
                'ridZ' => $ridZ,
                'needExp' => true,
                'header' => array(
                    array(
                        'n' => $name,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
