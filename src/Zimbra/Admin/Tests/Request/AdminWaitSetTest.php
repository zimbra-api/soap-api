<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AdminWaitSet;
use Zimbra\Enum\InterestType;

use Zimbra\Struct\Id;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\WaitSetId;
use Zimbra\Struct\WaitSetSpec;

/**
 * Testcase class for AdminWaitSet.
 */
class AdminWaitSetTest extends ZimbraAdminApiTestCase
{
    public function testAdminWaitSetRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $token = $this->faker->word;
        $waitSet = $this->faker->word;
        $seq = $this->faker->word;
        $timeout = mt_rand(0, 1000);

        $a = new WaitSetAddSpec(
            $name, $id, $token, [InterestType::FOLDERS(), InterestType::MESSAGES(), InterestType::CONTACTS()]
        );
        $add = new WaitSetSpec([$a]);
        $update = new WaitSetSpec([$a]);
        $a = new Id($id);
        $remove = new WaitSetId([$a]);

        $req = new \Zimbra\Admin\Request\AdminWaitSet(
            $waitSet, $seq, $add, $update, $remove, false, [InterestType::FOLDERS()], $timeout
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($waitSet, $req->getWaitSetId());
        $this->assertSame($seq, $req->getLastKnownSeqNo());
        $this->assertSame($add, $req->getAddAccounts());
        $this->assertSame($update, $req->getUpdateAccounts());
        $this->assertSame($remove, $req->getRemoveAccounts());
        $this->assertFalse($req->getBlock());
        $this->assertSame('f', $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());

        $req->setWaitSetId($waitSet)
            ->setLastKnownSeqNo($seq)
            ->setBlock(true)
            ->setAddAccounts($add)
            ->setUpdateAccounts($update)
            ->setRemoveAccounts($remove)
            ->addDefaultInterest(InterestType::MESSAGES())
            ->addDefaultInterest(InterestType::CONTACTS())
            ->setTimeout($timeout);
        $this->assertSame($waitSet, $req->getWaitSetId());
        $this->assertSame($seq, $req->getLastKnownSeqNo());
        $this->assertSame($add, $req->getAddAccounts());
        $this->assertSame($update, $req->getUpdateAccounts());
        $this->assertSame($remove, $req->getRemoveAccounts());
        $this->assertTrue($req->getBlock());
        $this->assertSame('f,m,c', $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminWaitSetRequest waitSet="' . $waitSet . '" seq="' . $seq . '" block="true" defTypes="f,m,c" timeout="' . $timeout . '" >'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                . '</add>'
                . '<update>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                . '</update>'
                . '<remove>'
                    . '<a id="' . $id . '" />'
                . '</remove>'
            . '</AdminWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AdminWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'waitSet' => $waitSet,
                'seq' => $seq,
                'block' => true,
                'defTypes' => 'f,m,c',
                'timeout' => $timeout,
                'add' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'f,m,c',
                        ],
                    ],
                ],
                'update' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'f,m,c',
                        ],
                    ],
                ],
                'remove' => [
                    'a' => [
                        [
                            'id' => $id,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminWaitSetApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $token = $this->faker->word;
        $waitSet = $this->faker->word;
        $seq = $this->faker->word;
        $timeout = mt_rand(0, 1000);

        $a = new WaitSetAddSpec(
            $name, $id, $token, [InterestType::FOLDERS(), InterestType::MESSAGES(), InterestType::CONTACTS()]
        );
        $add = new WaitSetSpec([$a]);
        $update = new WaitSetSpec([$a]);
        $a = new Id($id);
        $remove = new WaitSetId([$a]);

        $this->api->adminWaitSet(
            $waitSet, $seq, $add, $update, $remove, true, [InterestType::FOLDERS(), InterestType::MESSAGES()], $timeout
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AdminWaitSetRequest waitSet="' . $waitSet . '" seq="' . $seq . '" block="true" defTypes="f,m" timeout="' . $timeout . '" >'
                        . '<urn1:add>'
                            . '<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                        . '</urn1:add>'
                        . '<urn1:update>'
                            . '<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                        . '</urn1:update>'
                        . '<urn1:remove>'
                            . '<urn1:a id="' . $id . '" />'
                        . '</urn1:remove>'
                    . '</urn1:AdminWaitSetRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
