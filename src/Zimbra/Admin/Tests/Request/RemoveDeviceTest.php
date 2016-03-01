<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RemoveDevice;
use Zimbra\Admin\Struct\DeviceId;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for RemoveDevice.
 */
class RemoveDeviceTest extends ZimbraAdminApiTestCase
{
    public function testRemoveDeviceRequest()
    {
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $device = new DeviceId($id);
        $req = new RemoveDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());
        $req->setAccount($account)
            ->setDevice($device);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveDeviceRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<device id="' . $id . '" />'
            . '</RemoveDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveDeviceRequest' => [
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

    public function testRemoveDeviceApi()
    {
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $device = new DeviceId($id);

        $this->api->removeDevice(
            $account, $device
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveDeviceRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:device id="' . $id . '" />'
                    . '</urn1:RemoveDeviceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
