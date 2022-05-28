<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetDistributionListBody;
use Zimbra\Admin\Message\GetDistributionListEnvelope;
use Zimbra\Admin\Message\GetDistributionListRequest;
use Zimbra\Admin\Message\GetDistributionListResponse;

use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Common\Enum\DistributionListBy as DLBy;
use Zimbra\Common\Enum\GranteeType;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDistributionListTest.
 */
class GetDistributionListTest extends ZimbraTestCase
{
    public function testGetDistributionList()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;
        $attrs = $this->faker->word;
        $limit = mt_rand(1, 10);
        $offset = mt_rand(1, 10);
        $total = mt_rand(1, 10);

        $owner = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $dlSel = new DistributionListSelector(DLBy::NAME(), $value);
        $dlInfo = new DistributionListInfo($name, $id, [$member], [], [$owner], TRUE);

        $request = new GetDistributionListRequest($dlSel, $limit, $offset, FALSE, $attrs);
        $this->assertSame($dlSel, $request->getDl());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertFalse($request->isSortAscending());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetDistributionListRequest();
        $request->setDl($dlSel)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setSortAscending(TRUE)
            ->setAttrs($attrs);
        $this->assertSame($dlSel, $request->getDl());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($offset, $request->getOffset());
        $this->assertTrue($request->isSortAscending());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetDistributionListResponse($dlInfo, FALSE, $total);
        $this->assertSame($dlInfo, $response->getDl());
        $this->assertFalse($response->isMore());
        $this->assertSame($total, $response->getTotal());
        $response = new GetDistributionListResponse();
        $response->setDl($dlInfo)
            ->setMore(TRUE)
            ->setTotal($total);
        $this->assertSame($dlInfo, $response->getDl());
        $this->assertTrue($response->isMore());
        $this->assertSame($total, $response->getTotal());

        $body = new GetDistributionListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDistributionListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDistributionListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDistributionListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDistributionListRequest attrs="$attrs" limit="$limit" offset="$offset" sortAscending="true">
            <dl by="name">$value</dl>
        </urn:GetDistributionListRequest>
        <urn:GetDistributionListResponse more="true" total="$total">
            <dl name="$name" id="$id" dynamic="true">
                <dlm>$member</dlm>
                <owners>
                    <owner id="$id" name="$name" type="all" />
                </owners>
            </dl>
        </urn:GetDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDistributionListEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetDistributionListRequest' => [
                    'attrs' => $attrs,
                    'limit' => $limit,
                    'offset' => $offset,
                    'sortAscending' => TRUE,
                    'dl' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetDistributionListResponse' => [
                    'more' => TRUE,
                    'total' => $total,
                    'dl' => [
                        'name' => $name,
                        'id' => $id,
                        'dynamic' => TRUE,
                        'dlm' => [
                            ['_content' => $member],
                        ],
                        'owners' => [
                            'owner' => [
                                [
                                    'id' => $id,
                                    'name' => $name,
                                    'type' => 'all',
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetDistributionListEnvelope::class, 'json'));
    }
}
