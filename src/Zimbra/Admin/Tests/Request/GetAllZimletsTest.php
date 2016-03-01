<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllZimlets;
use Zimbra\Enum\ZimletExcludeType as ExcludeType;

/**
 * Testcase class for GetAllZimlets.
 */
class GetAllZimletsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllZimletsRequest()
    {
        $req = new GetAllZimlets(ExcludeType::EXTENSION());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('extension', $req->getExclude()->value());

        $req->setExclude(ExcludeType::MAIL());
        $this->assertSame('mail', $req->getExclude()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllZimletsRequest exclude="' . ExcludeType::MAIL() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllZimletsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'exclude' => ExcludeType::MAIL()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllZimletsApi()
    {
        $this->api->getAllZimlets(ExcludeType::MAIL());

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllZimletsRequest exclude="' . ExcludeType::MAIL() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
