<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\GetDistributionListMembersEnvelope;
use Zimbra\Account\Message\GetDistributionListMembersBody;
use Zimbra\Account\Message\GetDistributionListMembersRequest;
use Zimbra\Account\Message\GetDistributionListMembersResponse;

use Zimbra\Account\Struct\HABGroupMember;
use Zimbra\Struct\NamedValue;

use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for GetDistributionListMembers.
 */
class GetDistributionListMembersTest extends ZimbraStructTestCase
{
    public function testGetDistributionListMembers()
    {
        $dl = $this->faker->email;
        $name = $this->faker->email;
        $seniorityIndex = mt_rand(1, 100);
        $limit = mt_rand(1, 100);
        $offset = mt_rand(1, 100);
        $total = mt_rand(1, 100);
        $key = $this->faker->word;
        $value = $this->faker->text;
        $member1 = $this->faker->email;
        $member2 = $this->faker->email;

        $request = new GetDistributionListMembersRequest(
            $dl,
            $limit,
            $offset
        );
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());

        $request = new GetDistributionListMembersRequest('');
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
            <dl>$dl</dl>
        </urn:GetDistributionListMembersRequest>
        <urn:GetDistributionListMembersResponse more="true" total="$total">
            <dlm>$member1</dlm>
            <dlm>$member2</dlm>
            <groupMembers>
                <groupMember seniorityIndex="$seniorityIndex">
                    <name>$name</name>
                    <attr name="$key">$value</attr>
                </groupMember>
            </groupMembers>
        </urn:GetDistributionListMembersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDistributionListMembersEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetDistributionListMembersRequest' => [
                    'limit' => $limit,
                    'offset' => $offset,
                    'dl' => [
                        '_content' => $dl,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetDistributionListMembersResponse' => [
                    'more' => TRUE,
                    'total' => $total,
                    'dlm' => [
                        [
                            '_content' => $member1,
                        ],
                        [
                            '_content' => $member2,
                        ],
                    ],
                    'groupMembers' => [
                        'groupMember' => [
                            [
                                'name' => [
                                    '_content' => $name,
                                ],
                                'seniorityIndex' => $seniorityIndex,
                                'attr' => [
                                    [
                                        'name' => $key,
                                        '_content' => $value,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetDistributionListMembersEnvelope::class, 'json'));
    }
}
