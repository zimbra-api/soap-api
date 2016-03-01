<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\GalSearchType;
use Zimbra\Mail\Request\AutoComplete;

/**
 * Testcase class for AutoComplete.
 */
class AutoCompleteTest extends ZimbraMailApiTestCase
{
    public function testAutoCompleteRequest()
    {
        $name = $this->faker->word;
        $folders = $this->faker->word;
        $req = new AutoComplete(
            $name, GalSearchType::ALL(), true, $folders, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getType()->is('all'));
        $this->assertTrue($req->getNeedCanExpand());
        $this->assertSame($folders, $req->getFolderList());
        $this->assertTrue($req->getIncludeGal());

        $req = new AutoComplete('');
        $req->setName($name)
            ->setType(GalSearchType::ALL())
            ->setNeedCanExpand(true)
            ->setFolderList($folders)
            ->setIncludeGal(true);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getType()->is('all'));
        $this->assertTrue($req->getNeedCanExpand());
        $this->assertSame($folders, $req->getFolderList());
        $this->assertTrue($req->getIncludeGal());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AutoCompleteRequest name="' . $name . '" t="' . GalSearchType::ALL() . '" needExp="true" folders="' . $folders . '" includeGal="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AutoCompleteRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'name' => $name,
                't' => GalSearchType::ALL()->value(),
                'needExp' => true,
                'folders' => $folders,
                'includeGal' => true,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoCompleteApi()
    {
        $name = $this->faker->word;
        $folders = $this->faker->word;
        $this->api->autoComplete(
           $name, GalSearchType::ALL(), true, $folders, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AutoCompleteRequest name="' . $name . '" t="' . GalSearchType::ALL() . '" needExp="true" folders="' . $folders . '" includeGal="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
