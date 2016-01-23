<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\NoOp;

/**
 * Testcase class for NoOp.
 */
class MailNoOpTest extends ZimbraMailApiTestCase
{
    public function testNoOpRequest()
    {
    	$timeout = mt_rand(1, 100);
        $req = new NoOp(
            true, true, true, $timeout
        );
        $this->assertTrue($req->getWait());
        $this->assertTrue($req->getIncludeDelegates());
        $this->assertTrue($req->getEnforceLimit());
        $this->assertSame($timeout, $req->getTimeout());

        $req = new NoOp(
            false, false, false, 0
        );
        $req->setWait(true)
            ->setIncludeDelegates(true)
            ->setEnforceLimit(true)
            ->setTimeout($timeout);
        $this->assertTrue($req->getWait());
        $this->assertTrue($req->getIncludeDelegates());
        $this->assertTrue($req->getEnforceLimit());
        $this->assertSame($timeout, $req->getTimeout());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<NoOpRequest wait="true" delegate="true" limitToOneBlocked="true" timeout="' . $timeout . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'NoOpRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'wait' => true,
                'delegate' => true,
                'limitToOneBlocked' => true,
                'timeout' => $timeout,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testNoOpApi()
    {
    	$timeout = mt_rand(1, 100);
        $this->api->noOp(
            true, true, true, $timeout
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:NoOpRequest wait="true" delegate="true" limitToOneBlocked="true" timeout="' . $timeout . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
