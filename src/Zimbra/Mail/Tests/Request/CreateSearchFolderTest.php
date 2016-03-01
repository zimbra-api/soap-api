<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\CreateSearchFolder;
use Zimbra\Mail\Struct\NewSearchFolderSpec;

/**
 * Testcase class for CreateSearchFolder.
 */
class CreateSearchFolderTest extends ZimbraMailApiTestCase
{
    public function testCreateSearchFolderRequest()
    {
        $name = $this->faker->word;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $sortBy = $this->faker->word;
        $f = $this->faker->word;
        $l = $this->faker->word;
        $color = mt_rand(1, 127);
        $search = new NewSearchFolderSpec(
            $name, $query, $types, $sortBy, $f, $color, $l
        );

        $req = new CreateSearchFolder(
            $search
        );
        $this->assertSame($search, $req->getSearchFolder());
        $req->setSearchFolder($search);
        $this->assertSame($search, $req->getSearchFolder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateSearchFolderRequest>'
                .'<search name="' . $name . '" query="' . $query . '" types="' . $types . '" sortBy="' . $sortBy . '" f="' . $f . '" color="' . $color . '" l="' . $l . '" />'
            .'</CreateSearchFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateSearchFolderRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'search' => array(
                    'name' => $name,
                    'query' => $query,
                    'types' => $types,
                    'sortBy' => $sortBy,
                    'f' => $f,
                    'color' => $color,
                    'l' => $l,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSearchFolderApi()
    {
        $name = $this->faker->word;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $sortBy = $this->faker->word;
        $f = $this->faker->word;
        $l = $this->faker->word;
        $color = mt_rand(1, 127);
        $search = new NewSearchFolderSpec(
            $name, $query, $types, $sortBy, $f, $color, $l
        );

        $this->api->createSearchFolder(
           $search
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateSearchFolderRequest>'
                        .'<urn1:search name="' . $name . '" query="' . $query . '" types="' . $types . '" sortBy="' . $sortBy . '" f="' . $f . '" color="' . $color . '" l="' . $l . '" />'
                    .'</urn1:CreateSearchFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
