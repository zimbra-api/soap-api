<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\InterestType;
use Zimbra\Mail\Request\WaitSet;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\WaitSetSpec;
use Zimbra\Struct\WaitSetId;
use Zimbra\Struct\Id;

/**
 * Testcase class for WaitSet.
 */
class WaitSetTest extends ZimbraMailApiTestCase
{
    public function testWaitSetRequest()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $token = $this->faker->word;
        $waitSet = $this->faker->uuid;
        $seq = $this->faker->word;
        $timeout = mt_rand(1, 10);

        $waitSetSpec = new WaitSetAddSpec($name, $id, $token, [InterestType::FOLDERS()]);
        $add = new WaitSetSpec([$waitSetSpec]);
        $update = new WaitSetSpec([$waitSetSpec]);
        $remove = new WaitSetId([new Id($id)]);

        $req = new WaitSet(
            $waitSet, $seq, $add, $update, $remove, true, [InterestType::FOLDERS()], $timeout
        );
        $this->assertSame($waitSet, $req->getWaitSetId());
        $this->assertSame($seq, $req->getLastKnownSeqNo());
        $this->assertSame($add, $req->getAddAccounts());
        $this->assertSame($update, $req->getUpdateAccounts());
        $this->assertSame($remove, $req->getRemoveAccounts());
        $this->assertTrue($req->getBlock());
        $this->assertSame('f', $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());

        $req = new WaitSet(
            '', ''
        );
        $req->setWaitSetId($waitSet)
            ->setLastKnownSeqNo($seq)
            ->setAddAccounts($add)
            ->setUpdateAccounts($update)
            ->setRemoveAccounts($remove)
            ->setBlock(true)
            ->setDefaultInterests([InterestType::FOLDERS()])
            ->addDefaultInterest(InterestType::MESSAGES())
            ->setTimeout($timeout);
        $this->assertSame($waitSet, $req->getWaitSetId());
        $this->assertSame($seq, $req->getLastKnownSeqNo());
        $this->assertSame($add, $req->getAddAccounts());
        $this->assertSame($update, $req->getUpdateAccounts());
        $this->assertSame($remove, $req->getRemoveAccounts());
        $this->assertTrue($req->getBlock());
        $this->assertSame('f,m', $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<WaitSetRequest waitSet="' . $waitSet . '" seq="' . $seq . '" block="true" defTypes="f,m" timeout="' . $timeout . '">'
                .'<add>'
                    .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f" />'
                .'</add>'
                .'<update>'
                    .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f" />'
                .'</update>'
                .'<remove>'
                    .'<a id="' . $id . '" />'
                .'</remove>'
            .'</WaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'WaitSetRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'waitSet' => $waitSet,
                'seq' => $seq,
                'block' => true,
                'defTypes' => 'f,m',
                'timeout' => $timeout,
                'add' => array(
                    'a' => array(
                        array(
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'f',
                        ),
                    ),
                ),
                'update' => array(
                    'a' => array(
                        array(
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'f',
                        ),
                    ),
                ),
                'remove' => array(
                    'a' => array(
                        array(
                            'id' => $id,
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testWaitSetApi()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $token = $this->faker->word;
        $waitSet = $this->faker->uuid;
        $seq = $this->faker->word;
        $timeout = mt_rand(1, 10);

        $waitSetSpec = new WaitSetAddSpec($name, $id, $token, [InterestType::FOLDERS()]);
        $add = new WaitSetSpec([$waitSetSpec]);
        $update = new WaitSetSpec([$waitSetSpec]);
        $remove = new WaitSetId([new Id($id)]);

        $this->api->waitSet(
            $waitSet, $seq, $add, $update, $remove, true, [InterestType::FOLDERS()], $timeout
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:WaitSetRequest waitSet="' . $waitSet . '" seq="' . $seq . '" block="true" defTypes="f" timeout="' . $timeout . '" >'
                        .'<urn1:add>'
                            .'<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f" />'
                        .'</urn1:add>'
                        .'<urn1:update>'
                            .'<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f" />'
                        .'</urn1:update>'
                        .'<urn1:remove>'
                            .'<urn1:a id="' . $id . '" />'
                        .'</urn1:remove>'
                    .'</urn1:WaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
