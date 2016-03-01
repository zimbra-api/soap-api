<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\PushFreeBusy;
use Zimbra\Admin\Struct\Names;
use Zimbra\Struct\Id;

/**
 * Testcase class for PushFreeBusy.
 */
class PushFreeBusyTest extends ZimbraAdminApiTestCase
{
    public function testPushFreeBusyRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $domain = new Names($name);
        $account = new Id($id);

        $req = new PushFreeBusy($domain, $account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($account, $req->getAccount());

        $req->setDomain($domain)
            ->setAccount($account);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PushFreeBusyRequest>'
                . '<domain name="' . $name . '" />'
                . '<account id="' . $id . '" />'
            . '</PushFreeBusyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PushFreeBusyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'name' => $name,
                ],
                'account' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPushFreeBusyApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $domain = new Names($name);
        $account = new Id($id);

        $this->api->pushFreeBusy(
            $domain, $account
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PushFreeBusyRequest>'
                        . '<urn1:domain name="' . $name . '" />'
                        . '<urn1:account id="' . $id . '" />'
                    . '</urn1:PushFreeBusyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
