<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DelegateAuth;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;

/**
 * Testcase class for DelegateAuth.
 */
class DelegateAuthTest extends ZimbraAdminApiTestCase
{
    public function testDelegateAuthRequest()
    {
        $value = $this->faker->word;
        $duration = mt_rand(0, 1000);
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $req = new DelegateAuth($account, $duration);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($duration, $req->getDuration());

        $req->setAccount($account)
            ->setDuration($duration);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($duration, $req->getDuration());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DelegateAuthRequest duration="' . $duration . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</DelegateAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DelegateAuthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'duration' => $duration,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDelegateAuthApi()
    {
        $value = $this->faker->word;
        $duration = mt_rand(0, 1000);
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $this->api->delegateAuth(
            $account, $duration
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DelegateAuthRequest duration="' . $duration . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:DelegateAuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
