<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{AutoProvAccountBody, AutoProvAccountEnvelope, AutoProvAccountRequest, AutoProvAccountResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Enum\{AutoProvPrincipalBy, DomainBy};
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for AutoProvAccount.
 */
class AutoProvAccountTest extends ZimbraStructTestCase
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

    public function testAutoProvAccountResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

        $res = new AutoProvAccountResponse(
            $account
        );
        $this->assertSame($account, $res->getAccount());

        $res = new AutoProvAccountResponse(new AccountInfo('', ''));
        $res->setAccount($account);
        $this->assertSame($account, $res->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvAccountResponse>'
                . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</account>'
            . '</AutoProvAccountResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AutoProvAccountResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AutoProvAccountResponse::class, 'json'));
    }

    public function testAutoProvAccountBody()
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
        $response = new AutoProvAccountResponse(
            $account
        );

        $body = new AutoProvAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AutoProvAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
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
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AutoProvAccountBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AutoProvAccountBody::class, 'json'));
    }

    public function testAutoProvAccountEnvelope()
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
        $response = new AutoProvAccountResponse(
            $account
        );
        $body = new AutoProvAccountBody($request, $response);

        $envelope = new AutoProvAccountEnvelope(new Header(), $body);
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AutoProvAccountEnvelope::class, 'json'));
    }
}
