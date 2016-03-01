<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\AutoProvAccount;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\PrincipalSelector;
use Zimbra\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for AutoProvAccount.
 */
class AutoProvAccountTest extends ZimbraAdminApiTestCase
{
    public function testAutoProvAccountRequest()
    {
        $value = $this->faker->word;
        $password = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $principal = new PrincipalSelector(PrincipalBy::DN(), $value);
        $req = new AutoProvAccount($domain, $principal, $password);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($principal, $req->getPrincipal());
        $this->assertSame($password, $req->getPassword());

        $req->setDomain($domain)
            ->setPrincipal($principal)
            ->setPassword($password);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($principal, $req->getPrincipal());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvAccountRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<principal by="' . PrincipalBy::DN() . '">' . $value . '</principal>'
                . '<password>' . $password . '</password>'
            . '</AutoProvAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoProvAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
                'principal' => [
                    'by' => PrincipalBy::DN()->value(),
                    '_content' => $value,
                ],
                'password' => $password,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoProvAccountApi()
    {
        $value = $this->faker->word;
        $password = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $principal = new PrincipalSelector(PrincipalBy::DN(), $value);

        $this->api->autoProvAccount(
            $domain, $principal, $password
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AutoProvAccountRequest>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                        . '<urn1:principal by="' . PrincipalBy::DN() . '">' . $value . '</urn1:principal>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                    . '</urn1:AutoProvAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
