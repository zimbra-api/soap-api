<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ModifySearchFolder;
use Zimbra\Mail\Struct\ModifySearchFolderSpec;

/**
 * Testcase class for ModifySearchFolder.
 */
class ModifySearchFolderTest extends ZimbraMailApiTestCase
{
    public function testModifySearchFolderRequest()
    {
        $id = $this->faker->uuid;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $sortBy = $this->faker->word;
        $search = new ModifySearchFolderSpec(
            $id, $query, $types, $sortBy
        );

        $req = new ModifySearchFolder(
            $search
        );
        $this->assertSame($search, $req->getSearchFolder());

        $req = new ModifySearchFolder(
            new ModifySearchFolderSpec('', '', '', '')
        );
        $req->setSearchFolder($search);
        $this->assertSame($search, $req->getSearchFolder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifySearchFolderRequest>'
                .'<search id="' . $id . '" query="' . $query . '" types="' . $types . '" sortBy="' . $sortBy . '" />'
            .'</ModifySearchFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifySearchFolderRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'search' => array(
                    'id' => $id,
                    'query' => $query,
                    'types' => $types,
                    'sortBy' => $sortBy,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifySearchFolderApi()
    {
        $id = $this->faker->uuid;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $sortBy = $this->faker->word;
        $search = new ModifySearchFolderSpec(
            $id, $query, $types, $sortBy
        );
        $this->api->modifySearchFolder(
            $search
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifySearchFolderRequest>'
                        .'<urn1:search id="' . $id . '" query="' . $query . '" types="' . $types . '" sortBy="' . $sortBy . '" />'
                    .'</urn1:ModifySearchFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
