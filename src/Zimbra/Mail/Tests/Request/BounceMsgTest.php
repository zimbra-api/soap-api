<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\AddressType;
use Zimbra\Mail\Request\BounceMsg;
use Zimbra\Mail\Struct\BounceMsgSpec;
use Zimbra\Mail\Struct\EmailAddrInfo;

/**
 * Testcase class for BounceMsg.
 */
class BounceMsgTest extends ZimbraMailApiTestCase
{
    public function testBounceMsgRequest()
    {
        $id = $this->faker->uuid;
        $address = $this->faker->word;
        $personal = $this->faker->word;
        $e = new EmailAddrInfo($address, AddressType::FROM(), $personal);
        $m = new BounceMsgSpec($id, [$e]);

        $req = new BounceMsg(
            $m
        );
        $this->assertSame($m, $req->getMsg());
        $req->setMsg($m);
        $this->assertSame($m, $req->getMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<BounceMsgRequest>'
                .'<m id="' . $id . '">'
                    .'<e a="' . $address . '" t="' . AddressType::FROM() . '" p="' . $personal . '" />'
                .'</m>'
            .'</BounceMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'BounceMsgRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'm' => array(
                    'id' => $id,
                    'e' => array(
                        array(
                            'a' => $address,
                            't' => AddressType::FROM()->value(),
                            'p' => $personal,
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testBounceMsgApi()
    {
        $id = $this->faker->uuid;
        $address = $this->faker->word;
        $personal = $this->faker->word;
        $e = new EmailAddrInfo($address, AddressType::FROM(), $personal);
        $m = new BounceMsgSpec($id, [$e]);

        $this->api->bounceMsg(
           $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:BounceMsgRequest>'
                        .'<urn1:m id="' . $id . '">'
                            .'<urn1:e a="' . $address . '" t="' . AddressType::FROM() . '" p="' . $personal . '" />'
                        .'</urn1:m>'
                    .'</urn1:BounceMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
