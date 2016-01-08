<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FreeBusyUserSpec;

/**
 * Testcase class for FreeBusyUserSpec.
 */
class FreeBusyUserSpecTest extends ZimbraMailTestCase
{
    public function testFreeBusyUserSpec()
    {
        $folder = mt_rand(1, 10);
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $usr = new \Zimbra\Mail\Struct\FreeBusyUserSpec(
            $folder, $id, $name
        );
        $this->assertSame($folder, $usr->getFolderId());
        $this->assertSame($id, $usr->getId());
        $this->assertSame($name, $usr->getName());

        $usr->setFolderId($folder)
            ->setId($id)
            ->setName($name);
        $this->assertSame($folder, $usr->getFolderId());
        $this->assertSame($id, $usr->getId());
        $this->assertSame($name, $usr->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<usr l="' . $folder . '" id="' . $id . '" name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $usr);

        $array = array(
            'usr' => array(
                'l' => $folder,
                'id' => $id,
                'name' => $name,
            ),
        );
        $this->assertEquals($array, $usr->toArray());
    }
}
