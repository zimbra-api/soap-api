<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\RemoveDistributionListMemberBody;
use Zimbra\Admin\Message\RemoveDistributionListMemberEnvelope;
use Zimbra\Admin\Message\RemoveDistributionListMemberRequest;
use Zimbra\Admin\Message\RemoveDistributionListMemberResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RemoveDistributionListMember.
 */
class RemoveDistributionListMemberTest extends ZimbraStructTestCase
{
    public function testRemoveDistributionListMember()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->name;
        $member2 = $this->faker->name;
        $account1 = $this->faker->email;
        $account2 = $this->faker->email;

        $request = new RemoveDistributionListMemberRequest($id, [$member1], [$account1]);
        $this->assertSame($id, $request->getId());
        $this->assertSame([$member1], $request->getMembers());
        $this->assertSame([$account1], $request->getAccounts());

        $request = new RemoveDistributionListMemberRequest('');
        $request->setId($id)
            ->setMembers([$member1])
            ->addMember($member2)
            ->setAccounts([$account1])
            ->addAccount($account2);
        $this->assertSame($id, $request->getId());
        $this->assertSame([$member1, $member2], $request->getMembers());
        $this->assertSame([$account1, $account2], $request->getAccounts());

        $response = new RemoveDistributionListMemberResponse();

        $body = new RemoveDistributionListMemberBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RemoveDistributionListMemberBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RemoveDistributionListMemberEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RemoveDistributionListMemberEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:RemoveDistributionListMemberRequest id="$id">
            <dlm>$member1</dlm>
            <dlm>$member2</dlm>
            <account>$account1</account>
            <account>$account2</account>
        </urn:RemoveDistributionListMemberRequest>
        <urn:RemoveDistributionListMemberResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RemoveDistributionListMemberEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RemoveDistributionListMemberRequest' => [
                    'id' => $id,
                    'dlm' => [
                        [
                            '_content' => $member1,
                        ],
                        [
                            '_content' => $member2,
                        ],
                    ],
                    'account' => [
                        [
                            '_content' => $account1,
                        ],
                        [
                            '_content' => $account2,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'RemoveDistributionListMemberResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RemoveDistributionListMemberEnvelope::class, 'json'));
    }
}
