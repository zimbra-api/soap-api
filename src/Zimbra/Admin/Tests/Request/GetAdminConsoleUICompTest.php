<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAdminConsoleUIComp;
use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Struct\AccountSelector;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\DistributionListBy as DLBy;

/**
 * Testcase class for GetAdminConsoleUIComp.
 */
class GetAdminConsoleUICompTest extends ZimbraAdminApiTestCase
{
    public function testGetAdminConsoleUICompRequest()
    {
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $req = new GetAdminConsoleUIComp($account, $dl);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($dl, $req->getDl());

        $req->setAccount($account)
            ->setDl($dl);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($dl, $req->getDl());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAdminConsoleUICompRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<dl by="' . DLBy::NAME() . '">' . $value  .'</dl>'
            . '</GetAdminConsoleUICompRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAdminConsoleUICompRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminConsoleUICompApi()
    {
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME(), $value);
        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $this->api->getAdminConsoleUIComp(
            $account, $dl
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAdminConsoleUICompRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                    . '</urn1:GetAdminConsoleUICompRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
