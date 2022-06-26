<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetAccountDistributionListsEnvelope;
use Zimbra\Account\Message\GetAccountDistributionListsBody;
use Zimbra\Account\Message\GetAccountDistributionListsRequest;
use Zimbra\Account\Message\GetAccountDistributionListsResponse;

use Zimbra\Account\Struct\DLInfo;
use Zimbra\Common\Enum\MemberOfSelector;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for GetAccountDistributionLists.
 */
class GetAccountDistributionListsTest extends ZimbraTestCase
{
    public function testGetAccountDistributionLists()
    {
        $memberOf = MemberOfSelector::DIRECT_ONLY();
        $attrs = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $displayName = $this->faker->name;
        $ref = $this->faker->word;
        $via = $this->faker->word;

        $request = new GetAccountDistributionListsRequest(
            FALSE,
            $memberOf,
            $attrs
        );
        $this->assertFalse($request->getOwnerOf());
        $this->assertSame($memberOf, $request->getMemberOf());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetAccountDistributionListsRequest();
        $request->setOwnerOf(TRUE)
            ->setMemberOf($memberOf)
            ->setAttrs($attrs);
        $this->assertTrue($request->getOwnerOf());
        $this->assertSame($memberOf, $request->getMemberOf());
        $this->assertSame($attrs, $request->getAttrs());

        $dl = new DLInfo($id, $ref, $name, $displayName, TRUE, $via, TRUE, TRUE, [new KeyValuePair($key, $value)]);
        $response = new GetAccountDistributionListsResponse([$dl]);
        $this->assertSame([$dl], $response->getDlList());
        $response = new GetAccountDistributionListsResponse();
        $response->setDlList([$dl])
            ->addDl($dl);
        $this->assertSame([$dl, $dl], $response->getDlList());
        $response->setDlList([$dl]);

        $body = new GetAccountDistributionListsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAccountDistributionListsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAccountDistributionListsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAccountDistributionListsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAccountDistributionListsRequest ownerOf="true" memberOf="directOnly" attrs="$attrs" />
        <urn:GetAccountDistributionListsResponse>
            <urn:dl name="$name" id="$id" ref="$ref" d="$displayName" dynamic="true" via="$via" isOwner="true" isMember="true">
                <urn:a n="$key">$value</urn:a>
            </urn:dl>
        </urn:GetAccountDistributionListsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAccountDistributionListsEnvelope::class, 'xml'));
    }
}
