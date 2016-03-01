<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\SearchType;
use Zimbra\Mail\Request\CreateFolder;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\NewFolderSpecAcl;
use Zimbra\Mail\Struct\NewFolderSpec;

/**
 * Testcase class for CreateFolder.
 */
class CreateFolderTest extends ZimbraMailApiTestCase
{
    public function testCreateFolderRequest()
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

        $req = new CreateFolder(
            $folder
        );
        $this->assertSame($folder, $req->getFolder());
        $req->setFolder($folder);
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateFolderRequest>'
                .'<folder name="' . $name . '" view="' . SearchType::TASK() . '" f="' . $f . '" color="' . $color . '" rgb="' . $rgb . '" url="' . $url . '" l="' . $l . '" fie="true" sync="true">'
                    .'<acl>'
                        .'<grant perm="' . $rights . '" gt="' . GranteeType::USR() . '" zid="' . $zimbraId . '" d="' . $displayName . '" args="' . $args . '" pw="' . $password . '" key="' . $accessKey . '" />'
                    .'</acl>'
                .'</folder>'
            .'</CreateFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateFolderRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateFolderApi()
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

        $this->api->createFolder(
           $folder
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateFolderRequest>'
                        .'<urn1:folder name="' . $name . '" view="' . SearchType::TASK() . '" f="' . $f . '" color="' . $color . '" rgb="' . $rgb . '" url="' . $url . '" l="' . $l . '" fie="true" sync="true">'
                            .'<urn1:acl>'
                                .'<urn1:grant perm="' . $rights . '" gt="' . GranteeType::USR() . '" zid="' . $zimbraId . '" d="' . $displayName . '" args="' . $args . '" pw="' . $password . '" key="' . $accessKey . '" />'
                            .'</urn1:acl>'
                        .'</urn1:folder>'
                    .'</urn1:CreateFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
