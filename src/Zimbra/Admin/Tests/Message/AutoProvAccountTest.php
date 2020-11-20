<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{AutoProvAccountBody, AutoProvAccountEnvelope, AutoProvAccountRequest, AutoProvAccountResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Enum\{AutoProvPrincipalBy, DomainBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for AutoProvAccount.
 */
class AutoProvAccountTest extends ZimbraStructTestCase
{
    public function testAutoProvAccount()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $password = $this->faker->uuid;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $principal = new PrincipalSelector(AutoProvPrincipalBy::NAME(), $value);
        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

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
        $response = new AutoProvAccountResponse(new AccountInfo('', ''));
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AutoProvAccountRequest>'
                        . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                        . '<principal by="' . AutoProvPrincipalBy::NAME() . '">' . $value . '</principal>'
                        . '<password>' . $password . '</password>'
                    . '</urn:AutoProvAccountRequest>'
                    . '<urn:AutoProvAccountResponse>'
                        . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</account>'
                    . '</urn:AutoProvAccountResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoProvAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AutoProvAccountRequest' => [
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
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AutoProvAccountResponse' => [
                    'account' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'isExternal' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AutoProvAccountEnvelope::class, 'json'));
    }
}
