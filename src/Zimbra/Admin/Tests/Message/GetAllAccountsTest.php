<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllAccountsBody;
use Zimbra\Admin\Message\GetAllAccountsEnvelope;
use Zimbra\Admin\Message\GetAllAccountsRequest;
use Zimbra\Admin\Message\GetAllAccountsResponse;

use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\ServerBy;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllAccounts.
 */
class GetAllAccountsTest extends ZimbraStructTestCase
{
    public function testGetAllAccounts()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new GetAllAccountsRequest($server, $domain);
        $this->assertSame($server, $request->getServer());
        $this->assertSame($domain, $request->getDomain());

        $request = new GetAllAccountsRequest();
        $request->setServer($server)
            ->setDomain($domain);
        $this->assertSame($server, $request->getServer());
        $this->assertSame($domain, $request->getDomain());

        $response = new GetAllAccountsResponse([$account]);
        $this->assertSame([$account], $response->getAccountList());
        $response = new GetAllAccountsResponse();
        $response->setAccountList([$account])
            ->addAccount($account);
        $this->assertSame([$account, $account], $response->getAccountList());
        $response->setAccountList([$account]);

        $body = new GetAllAccountsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAllAccountsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllAccountsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAllAccountsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAccountsRequest>
            <server by="name">$value</server>
            <domain by="name">$value</domain>
        </urn:GetAllAccountsRequest>
        <urn:GetAllAccountsResponse>
            <account name="$name" id="$id" isExternal="true">
                <a n="$key">$value</a>
            </account>
        </urn:GetAllAccountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllAccountsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllAccountsRequest' => [
                    'server' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'domain' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllAccountsResponse' => [
                    'account' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'isExternal' => TRUE,
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllAccountsEnvelope::class, 'json'));
    }
}
