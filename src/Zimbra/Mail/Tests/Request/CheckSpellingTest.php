<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\CheckSpelling;

/**
 * Testcase class for CheckSpelling.
 */
class CheckSpellingTest extends ZimbraMailApiTestCase
{
    public function testCheckSpellingRequest()
    {
        $value = $this->faker->word;
        $dictionary = $this->faker->word;
        $ignore = $this->faker->word;
        $req = new CheckSpelling(
            $value, $dictionary, $ignore
        );
        $this->assertSame($dictionary, $req->getDictionary());
        $this->assertSame($ignore, $req->getIgnoreList());

        $req = new CheckSpelling($value);
        $req->setDictionary($dictionary)
            ->setIgnoreList($ignore);
        $this->assertSame($dictionary, $req->getDictionary());
        $this->assertSame($ignore, $req->getIgnoreList());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckSpellingRequest dictionary="' . $dictionary . '" ignore="' . $ignore . '">' . $value . '</CheckSpellingRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckSpellingRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                '_content' => $value,
                'dictionary' => $dictionary,
                'ignore' => $ignore,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckSpellingApi()
    {
        $value = $this->faker->word;
        $dictionary = $this->faker->word;
        $ignore = $this->faker->word;
        $this->api->checkSpelling(
            $value, $dictionary, $ignore
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckSpellingRequest dictionary="' . $dictionary . '" ignore="' . $ignore . '">' . $value . '</urn1:CheckSpellingRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
