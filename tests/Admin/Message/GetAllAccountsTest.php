<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllAccountsBody;
use Zimbra\Admin\Message\GetAllAccountsEnvelope;
use Zimbra\Admin\Message\GetAllAccountsRequest;
use Zimbra\Admin\Message\GetAllAccountsResponse;

use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Common\Enum\ServerBy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllAccounts.
 */
class GetAllAccountsTest extends ZimbraTestCase
{
    public function testGetAllAccounts()
    {
        $name = $this->faker->email;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $account = new AccountInfo($name, $id, TRUE, [new Attr($key, $value)]);

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
        $response->setAccountList([$account]);
        $this->assertSame([$account], $response->getAccountList());

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
            <urn:server by="name">$value</urn:server>
            <urn:domain by="name">$value</urn:domain>
        </urn:GetAllAccountsRequest>
        <urn:GetAllAccountsResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:GetAllAccountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllAccountsEnvelope::class, 'xml'));
    }
}
