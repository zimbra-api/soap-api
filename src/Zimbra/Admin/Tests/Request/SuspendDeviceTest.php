<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\SuspendDevice;
use Zimbra\Admin\Struct\DeviceId;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for SuspendDevice.
 */
class SuspendDeviceTest extends ZimbraAdminApiTestCase
{
    public function testSuspendDeviceRequest()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $device = new DeviceId($id);
        $req = new SuspendDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());
        $req->setAccount($account)
            ->setDevice($device);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SuspendDeviceRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<device id="' . $id . '" />'
            . '</SuspendDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SuspendDeviceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'device' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSuspendDeviceApi()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $device = new DeviceId($id);

        $this->api->suspendDevice(
            $account, $device
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SuspendDeviceRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:device id="' . $id . '" />'
                    . '</urn1:SuspendDeviceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
