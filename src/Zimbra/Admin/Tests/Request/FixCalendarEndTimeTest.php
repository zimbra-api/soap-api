<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\FixCalendarEndTime;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for FixCalendarEndTime.
 */
class FixCalendarEndTimeTest extends ZimbraAdminApiTestCase
{
    public function testFixCalendarEndTimeRequest()
    {
        $name = $this->faker->word;
        $account = new NamedElement($name);

        $req = new FixCalendarEndTime(false, [$account]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getSync());
        $this->assertSame([$account], $req->getAccounts()->all());

        $req->setSync(true)
            ->addAccount($account);
        $this->assertTrue($req->getSync());
        $this->assertSame([$account, $account], $req->getAccounts()->all());
        $req->getAccounts()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<FixCalendarEndTimeRequest sync="true">'
                . '<account name="' . $name . '" />'
            . '</FixCalendarEndTimeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'FixCalendarEndTimeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'sync' => true,
                'account' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testFixCalendarEndTimeApi()
    {
        $name = $this->faker->word;
        $account = new NamedElement($name);

        $this->api->fixCalendarEndTime(
            true, [$account]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:FixCalendarEndTimeRequest sync="true">'
                        . '<urn1:account name="' . $name . '" />'
                    . '</urn1:FixCalendarEndTimeRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
