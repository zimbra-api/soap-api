<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\Id;
use Zimbra\Struct\WaitSetId;

/**
 * Testcase class for WaitSetId.
 */
class WaitSetIdTest extends ZimbraStructTestCase
{
    public function testWaitSetId()
    {
        $id1 = $this->faker->word;
        $a1 = new Id($id1);
        $id2 = $this->faker->word;
        $a2 = new Id($id2);

        $remove = new WaitSetId([$a1]);
        $this->assertSame([$a1], $remove->getIds()->all());
        $remove->addId($a2);
        $this->assertSame([$a1, $a2], $remove->getIds()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<remove>'
                .'<a id="' . $id1 . '" />'
                .'<a id="' . $id2 . '" />'
            .'</remove>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $remove);

        $array = [
            'remove' => [
                'a' => [
                    [
                        'id' => $id1,
                    ],
                    [
                        'id' => $id2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $remove->toArray());
    }
}
