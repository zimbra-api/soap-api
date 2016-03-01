<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\InterestType;
use Zimbra\Mail\Request\CreateWaitSet;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\WaitSetSpec;

/**
 * Testcase class for CreateWaitSet.
 */
class CreateWaitSetTest extends ZimbraMailApiTestCase
{
    public function testCreateWaitSetRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $a = new WaitSetAddSpec($name, $id, $token, [InterestType::FOLDERS()]);
        $add = new WaitSetSpec([$a]);

        $req = new CreateWaitSet(
            $add, [InterestType::FOLDERS()], true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($add, $req->getAccounts());
        $this->assertSame('f', $req->getDefaultInterests());
        $this->assertTrue($req->getAllAccounts());

        $req->setAccounts($add)
            ->addDefaultInterest(InterestType::MESSAGES())
            ->setAllAccounts(true);
        $this->assertSame($add, $req->getAccounts());
        $this->assertSame('f,m', $req->getDefaultInterests());
        $this->assertTrue($req->getAllAccounts());

        $req = new \Zimbra\Mail\Request\CreateWaitSet(
            $add, [InterestType::FOLDERS()], true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateWaitSetRequest defTypes="' . InterestType::FOLDERS() . '" allAccounts="true">'
                .'<add>'
                    .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="' . InterestType::FOLDERS() . '" />'
                .'</add>'
            .'</CreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateWaitSetRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'defTypes' => InterestType::FOLDERS()->value(),
                'allAccounts' => true,
                'add' => array(
                    'a' => array(
                        array(
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => InterestType::FOLDERS()->value(),
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateWaitSetApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $a = new WaitSetAddSpec($name, $id, $token, [InterestType::FOLDERS()]);
        $add = new WaitSetSpec([$a]);

        $this->api->createWaitSet(
            $add, [InterestType::FOLDERS()], true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateWaitSetRequest defTypes="' . InterestType::FOLDERS() . '" allAccounts="true">'
                        .'<urn1:add>'
                            .'<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="' . InterestType::FOLDERS() . '" />'
                        .'</urn1:add>'
                    .'</urn1:CreateWaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
