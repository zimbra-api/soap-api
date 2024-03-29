<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\AddDistributionListMemberBody;
use Zimbra\Admin\Message\AddDistributionListMemberEnvelope;
use Zimbra\Admin\Message\AddDistributionListMemberRequest;
use Zimbra\Admin\Message\AddDistributionListMemberResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddDistributionListMember.
 */
class AddDistributionListMemberTest extends ZimbraTestCase
{
    public function testAddDistributionListMember()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->unique->email;
        $member2 = $this->faker->unique->email;

        $request = new AddDistributionListMemberRequest($id, [$member1]);
        $this->assertSame($id, $request->getId());
        $this->assertSame([$member1], $request->getMembers());

        $request = new AddDistributionListMemberRequest();
        $request->setId($id)
            ->setMembers([$member1])
            ->addMember($member2);
        $this->assertSame($id, $request->getId());
        $this->assertSame([$member1, $member2], $request->getMembers());

        $response = new AddDistributionListMemberResponse();

        $body = new AddDistributionListMemberBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddDistributionListMemberBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddDistributionListMemberEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddDistributionListMemberEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:AddDistributionListMemberRequest id="$id">
            <urn:dlm>$member1</urn:dlm>
            <urn:dlm>$member2</urn:dlm>
        </urn:AddDistributionListMemberRequest>
        <urn:AddDistributionListMemberResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddDistributionListMemberEnvelope::class, 'xml'));
    }
}
