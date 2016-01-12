<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\BrowseBy;
use Zimbra\Mail\Request\Browse;

/**
 * Testcase class for Browse.
 */
class BrowseTest extends ZimbraMailApiTestCase
{
    public function testBrowseRequest()
    {
    	$regex = $this->faker->word;
    	$max = mt_rand(1, 10);
        $req = new \Zimbra\Mail\Request\Browse(
            BrowseBy::DOMAINS(), $regex, $max
        );
        $this->assertTrue($req->getBrowseBy()->is('domains'));
        $this->assertSame($regex, $req->getRegex());
        $this->assertSame($max, $req->getMax());

        $req = new \Zimbra\Mail\Request\Browse(
            BrowseBy::ATTACHMENTS()
        );
        $req->setBrowseBy(BrowseBy::DOMAINS())
            ->setRegex($regex)
            ->setMax($max);
        $this->assertTrue($req->getBrowseBy()->is('domains'));
        $this->assertSame($regex, $req->getRegex());
        $this->assertSame($max, $req->getMax());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<BrowseRequest browseBy="' . BrowseBy::DOMAINS() . '" regex="' . $regex . '" maxToReturn="' . $max . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'BrowseRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'browseBy' => BrowseBy::DOMAINS()->value(),
                'regex' => $regex,
                'maxToReturn' => $max,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testBrowseApi()
    {
    	$regex = $this->faker->word;
    	$max = mt_rand(1, 10);
        $this->api->browse(
           BrowseBy::DOMAINS(), $regex, $max
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:BrowseRequest browseBy="' . BrowseBy::DOMAINS() . '" regex="' . $regex . '" maxToReturn="' . $max . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
