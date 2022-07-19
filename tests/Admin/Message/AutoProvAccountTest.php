<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{AutoProvAccountBody, AutoProvAccountEnvelope, AutoProvAccountRequest, AutoProvAccountResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Common\Enum\{AutoProvPrincipalBy, DomainBy};
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for AutoProvAccount.
 */
class AutoProvAccountTest extends ZimbraTestCase
{
    public function testAutoProvAccount()
    {
        $name = $this->faker->email;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $password = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $principal = new PrincipalSelector(AutoProvPrincipalBy::NAME(), $value);
        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);

        $request = new AutoProvAccountRequest(
            $domain,
            $principal,
            $password
        );
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($principal, $request->getPrincipal());
        $this->assertSame($password, $request->getPassword());

        $request = new AutoProvAccountRequest(new DomainSelector(DomainBy::ID()), new PrincipalSelector(AutoProvPrincipalBy::DN()));
        $request->setDomain($domain)
            ->setPrincipal($principal)
            ->setPassword($password);
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($principal, $request->getPrincipal());
        $this->assertSame($password, $request->getPassword());

        $response = new AutoProvAccountResponse(
            $account
        );
        $this->assertSame($account, $response->getAccount());
        $response = new AutoProvAccountResponse();
        $response->setAccount($account);
        $this->assertSame($account, $response->getAccount());

        $body = new AutoProvAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AutoProvAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AutoProvAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AutoProvAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AutoProvAccountRequest>
            <urn:domain by="name">$value</urn:domain>
            <urn:principal by="name">$value</urn:principal>
            <urn:password>$password</urn:password>
        </urn:AutoProvAccountRequest>
        <urn:AutoProvAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:AutoProvAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoProvAccountEnvelope::class, 'xml'));
    }
}
