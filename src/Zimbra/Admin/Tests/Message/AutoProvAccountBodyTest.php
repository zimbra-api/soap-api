<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{AutoProvAccountBody, AutoProvAccountRequest, AutoProvAccountResponse};
use Zimbra\Admin\Struct\{AccountInfo, Attr, DomainSelector, PrincipalSelector};
use Zimbra\Enum\{AutoProvPrincipalBy, DomainBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoProvAccountBody.
 */
class AutoProvAccountBodyTest extends ZimbraStructTestCase
{
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
}
