<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetAccountMembershipBody, GetAccountMembershipEnvelope, GetAccountMembershipRequest, GetAccountMembershipResponse};
use Zimbra\Admin\Struct\DLInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAccountMembership.
 */
class GetAccountMembershipTest extends ZimbraTestCase
{
    public function testGetAccountMembership()
    {
        $via = $this->faker->email;
        $name = $this->faker->email;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $dl = new DLInfo($via, $name, $id, TRUE, [new Attr($key, $value)]);

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new GetAccountMembershipRequest($account);
        $this->assertSame($account, $request->getAccount());
        $request = new GetAccountMembershipRequest(new AccountSelector());
        $request->setAccount($account);
        $this->assertSame($account, $request->getAccount());

        $response = new GetAccountMembershipResponse([$dl]);
        $response = new GetAccountMembershipResponse();
        $response->setDlList([$dl]);
        $this->assertSame([$dl], $response->getDlList());

        $body = new GetAccountMembershipBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAccountMembershipBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAccountMembershipEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAccountMembershipEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountMembershipRequest>
            <urn:account by="name">$value</urn:account>
        </urn:GetAccountMembershipRequest>
        <urn:GetAccountMembershipResponse>
            <urn:dl name="$name" id="$id" dynamic="true" via="$via">
                <urn:a n="$key">$value</urn:a>
            </urn:dl>
        </urn:GetAccountMembershipResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountMembershipEnvelope::class, 'xml'));
    }
}
