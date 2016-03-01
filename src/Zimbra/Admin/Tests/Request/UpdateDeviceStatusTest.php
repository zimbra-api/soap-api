<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\UpdateDeviceStatus;
use Zimbra\Admin\Struct\IdStatus;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for UpdateDeviceStatus.
 */
class UpdateDeviceStatusTest extends ZimbraAdminApiTestCase
{
    public function testUpdateDeviceStatusRequest()
    {
        $value = $this->faker->word;
        $id = $this->faker->word;
        $status = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $device = new IdStatus($id, $status);
        $req = new UpdateDeviceStatus($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());
        $req->setAccount($account)
            ->setDevice($device);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UpdateDeviceStatusRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<device id="' . $id . '" status="' . $status . '" />'
            . '</UpdateDeviceStatusRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UpdateDeviceStatusRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'device' => [
                    'id' => $id,
                    'status' => $status,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUpdateDeviceStatusApi()
    {
        $value = $this->faker->word;
        $id = $this->faker->word;
        $status = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $device = new IdStatus($id, $status);

        $this->api->updateDeviceStatus(
            $account, $device
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UpdateDeviceStatusRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:device id="' . $id . '" status="' . $status . '" />'
                    . '</urn1:UpdateDeviceStatusRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
