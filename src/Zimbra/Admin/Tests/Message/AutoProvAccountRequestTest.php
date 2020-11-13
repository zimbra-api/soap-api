<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AutoProvAccountRequest;
use Zimbra\Admin\Struct\{DomainSelector, PrincipalSelector};
use Zimbra\Enum\{AutoProvPrincipalBy, DomainBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvAccountRequest.
 */
class AutoProvAccountRequestTest extends ZimbraStructTestCase
{
    public function testAutoProvAccountRequest()
    {
        $value = $this->faker->word;
        $password = $this->faker->uuid;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $principal = new PrincipalSelector(AutoProvPrincipalBy::NAME(), $value);

        $req = new AutoProvAccountRequest(
            $domain,
            $principal,
            $password
        );
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($principal, $req->getPrincipal());
        $this->assertSame($password, $req->getPassword());

        $req = new AutoProvAccountRequest(new DomainSelector(DomainBy::ID()), new PrincipalSelector(AutoProvPrincipalBy::DN()));
        $req->setDomain($domain)
            ->setPrincipal($principal)
            ->setPassword($password);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($principal, $req->getPrincipal());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvAccountRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<principal by="' . AutoProvPrincipalBy::NAME() . '">' . $value . '</principal>'
                . '<password>' . $password . '</password>'
            . '</AutoProvAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AutoProvAccountRequest::class, 'xml'));

        $json = json_encode([
            'domain' => [
                'by' => (string) DomainBy::NAME(),
                '_content' => $value,
            ],
            'principal' => [
                'by' => (string) AutoProvPrincipalBy::NAME(),
                '_content' => $value,
            ],
            'password' => [
                '_content' => $password,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AutoProvAccountRequest::class, 'json'));
    }
}
