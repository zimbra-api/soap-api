<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\RenameDistributionListBody;
use Zimbra\Admin\Message\RenameDistributionListEnvelope;
use Zimbra\Admin\Message\RenameDistributionListRequest;
use Zimbra\Admin\Message\RenameDistributionListResponse;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RenameDistributionList.
 */
class RenameDistributionListTest extends ZimbraStructTestCase
{
    public function testRenameDistributionList()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $member = $this->faker->word;

        $request = new RenameDistributionListRequest(
            $id, $name
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());
        $request = new RenameDistributionListRequest('', '');
        $request->setId($id)
            ->setNewName($name);
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());

        $owner = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $dl = new DistributionListInfo($name, $id, [$member], [], [$owner], TRUE);
        $response = new RenameDistributionListResponse($dl);
        $this->assertEquals($dl, $response->getDl());
        $response = new RenameDistributionListResponse(new DistributionListInfo('', ''));
        $response->setDl($dl);
        $this->assertEquals($dl, $response->getDl());

        $body = new RenameDistributionListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RenameDistributionListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RenameDistributionListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RenameDistributionListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameDistributionListRequest id="$id" newName="$name" />
        <urn:RenameDistributionListResponse>
            <dl name="$name" id="$id" dynamic="true">
                <dlm>$member</dlm>
                <owners>
                    <owner id="$id" name="$name" type="all" />
                </owners>
            </dl>
        </urn:RenameDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameDistributionListEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RenameDistributionListRequest' => [
                    'id' => $id,
                    'newName' => $name,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'RenameDistributionListResponse' => [
                    'dl' => [
                        'name' => $name,
                        'id' => $id,
                        'dynamic' => true,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RenameDistributionListEnvelope::class, 'json'));
    }
}
