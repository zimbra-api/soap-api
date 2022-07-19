<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetDistributionListMembersEnvelope;
use Zimbra\Account\Message\GetDistributionListMembersBody;
use Zimbra\Account\Message\GetDistributionListMembersRequest;
use Zimbra\Account\Message\GetDistributionListMembersResponse;

use Zimbra\Account\Struct\HABGroupMember;
use Zimbra\Common\Struct\NamedValue;

use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for GetDistributionListMembers.
 */
class GetDistributionListMembersTest extends ZimbraTestCase
{
    public function testGetDistributionListMembers()
    {
        $dl = $this->faker->email;
        $name = $this->faker->email;
        $seniorityIndex = $this->faker->randomNumber;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $total = $this->faker->randomNumber;
        $key = $this->faker->word;
        $value = $this->faker->text;
        $member1 = $this->faker->unique->email;
        $member2 = $this->faker->unique->email;

        $request = new GetDistributionListMembersRequest(
            $dl, $limit, $offset
        );
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());

        $request = new GetDistributionListMembersRequest();
        $request->setDl($dl)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());

        $groupMember = new HABGroupMember($name, $seniorityIndex, [new NamedValue($key, $value)]);
        $response = new GetDistributionListMembersResponse([$member1, $member2], [$groupMember], FALSE, $total);
        $this->assertSame([$member1, $member2], $response->getDlMembers());
        $this->assertSame([$groupMember], $response->getHABGroupMembers());
        $this->assertFalse($response->getMore());
        $this->assertSame($total, $response->getTotal());
        $response = new GetDistributionListMembersResponse();
        $response->setDlMembers([$member1])
            ->addDlMember($member2)
            ->setHABGroupMembers([$groupMember])
            ->addHABGroupMember($groupMember)
            ->setMore(TRUE)
            ->setTotal($total);
        $this->assertSame([$member1, $member2], $response->getDlMembers());
        $this->assertSame([$groupMember, $groupMember], $response->getHABGroupMembers());
        $this->assertTrue($response->getMore());
        $this->assertSame($total, $response->getTotal());
        $response->setHABGroupMembers([$groupMember]);

        $body = new GetDistributionListMembersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDistributionListMembersBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDistributionListMembersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDistributionListMembersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetDistributionListMembersRequest limit="$limit" offset="$offset">
            <urn:dl>$dl</urn:dl>
        </urn:GetDistributionListMembersRequest>
        <urn:GetDistributionListMembersResponse more="true" total="$total">
            <urn:dlm>$member1</urn:dlm>
            <urn:dlm>$member2</urn:dlm>
            <urn:groupMembers>
                <urn:groupMember seniorityIndex="$seniorityIndex">
                    <urn:name>$name</urn:name>
                    <urn:attr name="$key">$value</urn:attr>
                </urn:groupMember>
            </urn:groupMembers>
        </urn:GetDistributionListMembersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDistributionListMembersEnvelope::class, 'xml'));
    }
}
