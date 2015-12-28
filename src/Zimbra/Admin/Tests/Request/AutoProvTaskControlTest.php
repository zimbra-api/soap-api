<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AutoProvTaskControl;
use Zimbra\Enum\AutoProvTaskAction as TaskAction;

/**
 * Testcase class for AutoProvTaskControl.
 */
class AutoProvTaskControlTest extends ZimbraAdminApiTestCase
{
    public function testAutoProvTaskControlRequest()
    {
        $req = new AutoProvTaskControl(TaskAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('start', $req->getAction()->value());

        $req->setAction(TaskAction::STATUS());
        $this->assertSame('status', $req->getAction()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvTaskControlRequest action="' . TaskAction::STATUS() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoProvTaskControlRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => TaskAction::STATUS()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoProvTaskControlApi()
    {
        $this->api->autoProvTaskControl(
            TaskAction::STATUS()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AutoProvTaskControlRequest '
                        . 'action="' . TaskAction::STATUS() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
