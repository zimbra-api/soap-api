<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\SearchType;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\NewFolderSpecAcl;
use Zimbra\Mail\Struct\NewFolderSpec;

/**
 * Testcase class for NewFolderSpec.
 */
class NewFolderSpecTest extends ZimbraMailTestCase
{
    public function testNewFolderSpec()
    {
        $rights = $this->faker->word;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $name = $this->faker->word;
        $f = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;
        $l = $this->faker->word;
        $color = mt_rand(1, 127);

        $grant = new ActionGrantSelector(
            $rights, GranteeType::USR(), $zimbraId, $displayName, $args, $password, $accessKey
        );

        $acl = new NewFolderSpecAcl(
            [$grant]
        );

        $folder = new NewFolderSpec(
            $name, SearchType::TASK(), $f, $color, $rgb, $url, $l, true, true, $acl
        );
        $this->assertSame($name, $folder->getName());
        $this->assertSame($acl, $folder->getGrants());
        $this->assertTrue($folder->getView()->is('task'));
        $this->assertSame($f, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($url, $folder->getUrl());
        $this->assertSame($l, $folder->getParentFolderId());
        $this->assertTrue($folder->getFetchIfExists());
        $this->assertTrue($folder->getSyncToUrl());

        $folder = new NewFolderSpec('name');
        $folder->setName($name)
               ->setGrants($acl)
               ->setView(SearchType::TASK())
               ->setFlags($f)
               ->setColor($color)
               ->setRgb($rgb)
               ->setUrl($url)
               ->setParentFolderId($l)
               ->setFetchIfExists(true)
               ->setSyncToUrl(true);
        $this->assertSame($name, $folder->getName());
        $this->assertSame($acl, $folder->getGrants());
        $this->assertTrue($folder->getView()->is('task'));
        $this->assertSame($f, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($url, $folder->getUrl());
        $this->assertSame($l, $folder->getParentFolderId());
        $this->assertTrue($folder->getFetchIfExists());
        $this->assertTrue($folder->getSyncToUrl());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<folder name="' . $name . '" view="' . SearchType::TASK() . '" f="' . $f . '" color="' . $color . '" rgb="' . $rgb . '" url="' . $url . '" l="' . $l . '" fie="true" sync="true">'
                .'<acl>'
                    .'<grant perm="' . $rights . '" gt="' . GranteeType::USR() . '" zid="' . $zimbraId . '" d="' . $displayName . '" args="' . $args . '" pw="' . $password . '" key="' . $accessKey . '" />'
                .'</acl>'
            .'</folder>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $folder);

        $array = array(
            'folder' => array(
                'name' => $name,
                'view' => SearchType::TASK()->value(),
                'f' => $f,
                'color' => $color,
                'rgb' => $rgb,
                'url' => $url,
                'l' => $l,
                'fie' => true,
                'sync' => true,
                'acl' => array(
                    'grant' => array(
                        array(
                            'perm' => $rights,
                            'gt' => GranteeType::USR()->value(),
                            'zid' => $zimbraId,
                            'd' => $displayName,
                            'args' => $args,
                            'pw' => $password,
                            'key' => $accessKey,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $folder->toArray());
    }
}
