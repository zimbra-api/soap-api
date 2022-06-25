<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetDistributionListMembershipBody;
use Zimbra\Admin\Message\GetDistributionListMembershipEnvelope;
use Zimbra\Admin\Message\GetDistributionListMembershipRequest;
use Zimbra\Admin\Message\GetDistributionListMembershipResponse;

use Zimbra\Admin\Struct\DistributionListMembershipInfo;
use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Common\Enum\DistributionListBy as DLBy;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDistributionListMembershipTest.
 */
class GetDistributionListMembershipTest extends ZimbraTestCase
{
    public function testGetDistributionListMembership()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $via = $this->faker->word;
        $limit = mt_rand(1, 10);
        $offset = mt_rand(1, 10);

        $dlSel = new DistributionListSelector(DLBy::NAME(), $value);
        $dlmInfo = new DistributionListMembershipInfo($id, $name, $via);

        $request = new GetDistributionListMembershipRequest($dlSel, $limit, $offset);
        $this->assertSame($dlSel, $request->getDl());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());

        $request = new GetDistributionListMembershipRequest();
        $request->setDl($dlSel)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($dlSel, $request->getDl());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());

        $response = new GetDistributionListMembershipResponse([$dlmInfo]);
        $this->assertSame([$dlmInfo], $response->getDls());
        $response = new GetDistributionListMembershipResponse();
        $response->setDls([$dlmInfo])
            ->addDl($dlmInfo);
        $this->assertSame([$dlmInfo, $dlmInfo], $response->getDls());
        $response->setDls([$dlmInfo]);

        $body = new GetDistributionListMembershipBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDistributionListMembershipBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDistributionListMembershipEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDistributionListMembershipEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDistributionListMembershipRequest limit="$limit" offset="$offset">
            <dl by="name">$value</dl>
        </urn:GetDistributionListMembershipRequest>
        <urn:GetDistributionListMembershipResponse>
            <dl id="$id" name="$name" via="$via" />
        </urn:GetDistributionListMembershipResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDistributionListMembershipEnvelope::class, 'xml'));
    }
}
