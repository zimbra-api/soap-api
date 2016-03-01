<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\SearchType;
use Zimbra\Mail\Struct\NewMountpointSpec;

/**
 * Testcase class for NewMountpointSpec.
 */
class NewMountpointSpecTest extends ZimbraMailTestCase
{
    public function testNewMountpointSpec()
    {
        $name = $this->faker->word;
        $f = $this->faker->uuid;
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;
        $l = $this->faker->word;
        $zid = $this->faker->uuid;
        $owner = $this->faker->word;
        $path = $this->faker->word;
        $color = mt_rand(1, 127);
        $rid = mt_rand(1, 10);

        $link = new NewMountpointSpec(
            $name, SearchType::TASK(), $f, $color, $rgb, $url, $l, true, true, $zid, $owner, $rid, $path
        );
        $this->assertSame($name, $link->getName());
        $this->assertTrue($link->getView()->is('task'));
        $this->assertSame($f, $link->getFlags());
        $this->assertSame($color, $link->getColor());
        $this->assertSame($rgb, $link->getRgb());
        $this->assertSame($url, $link->getUrl());
        $this->assertSame($l, $link->getParentFolderId());
        $this->assertTrue($link->getFetchIfExists());
        $this->assertTrue($link->getReminderEnabled());
        $this->assertSame($zid, $link->getOwnerId());
        $this->assertSame($owner, $link->getOwnerName());
        $this->assertSame($rid, $link->getRemoteId());
        $this->assertSame($path, $link->getPath());

        $link = new NewMountpointSpec('name');
        $link->setName($name)
             ->setView(SearchType::TASK())
             ->setFlags($f)
             ->setColor($color)
             ->setRgb($rgb)
             ->setUrl($url)
             ->setParentFolderId($l)
             ->setFetchIfExists(true)
             ->setReminderEnabled(true)
             ->setOwnerId($zid)
             ->setOwnerName($owner)
             ->setRemoteId($rid)
             ->setPath($path);
        $this->assertSame($name, $link->getName());
        $this->assertTrue($link->getView()->is('task'));
        $this->assertSame($f, $link->getFlags());
        $this->assertSame($color, $link->getColor());
        $this->assertSame($rgb, $link->getRgb());
        $this->assertSame($url, $link->getUrl());
        $this->assertSame($l, $link->getParentFolderId());
        $this->assertTrue($link->getFetchIfExists());
        $this->assertTrue($link->getReminderEnabled());
        $this->assertSame($zid, $link->getOwnerId());
        $this->assertSame($owner, $link->getOwnerName());
        $this->assertSame($rid, $link->getRemoteId());
        $this->assertSame($path, $link->getPath());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<link name="' . $name . '" view="' . SearchType::TASK() . '" f="' . $f . '" color="' . $color . '" rgb="' . $rgb . '" url="' . $url . '" l="' . $l . '" fie="true" reminder="true" zid="' . $zid . '" owner="' . $owner . '" rid="' . $rid . '" path="' . $path . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $link);

        $array = array(
            'link' => array(
                'name' => $name,
                'view' => SearchType::TASK()->value(),
                'f' => $f,
                'color' => $color,
                'rgb' => $rgb,
                'url' => $url,
                'l' => $l,
                'fie' => true,
                'reminder' => true,
                'zid' => $zid,
                'owner' => $owner,
                'rid' => $rid,
                'path' => $path,
            ),
        );
        $this->assertEquals($array, $link->toArray());
    }
}
