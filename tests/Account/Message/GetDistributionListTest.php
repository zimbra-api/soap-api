<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetDistributionListBody;
use Zimbra\Account\Message\GetDistributionListEnvelope;
use Zimbra\Account\Message\GetDistributionListRequest;
use Zimbra\Account\Message\GetDistributionListResponse;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\DistributionListInfo;
use Zimbra\Account\Struct\DistributionListRightInfo;
use Zimbra\Account\Struct\DistributionListGranteeInfo;

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\DistributionListBy as DLBy;

use Zimbra\Struct\DistributionListSelector;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDistributionListTest.
 */
class GetDistributionListTest extends ZimbraTestCase
{
    public function testGetDistributionList()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $needRights = $this->faker->text;
        $member1 = $this->faker->email;
        $member2 = $this->faker->email;

        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $request = new GetDistributionListRequest($dl, FALSE, $needRights);
        $this->assertSame($dl, $request->getDl());
        $this->assertFalse($request->getNeedOwners());
        $this->assertSame($needRights, $request->getNeedRights());
        $request = new GetDistributionListRequest(new DistributionListSelector(DLBy::NAME(), ''));
        $request->setDl($dl)
            ->setNeedOwners(TRUE)
            ->setNeedRights($needRights)
            ->setAttrs([new Attr($name, $value, TRUE)]);
        $this->assertSame($dl, $request->getDl());
        $this->assertTrue($request->getNeedOwners());
        $this->assertSame($needRights, $request->getNeedRights());

        $owner = new DistributionListGranteeInfo(
            GranteeType::USR(), $id, $name
        );
        $right = new DistributionListRightInfo(
            $name, [$owner]
        );
        $dl = new DistributionListInfo(
            $name, $id, [new KeyValuePair($key, $value)], [$member1, $member2], [$owner], [$right], TRUE, TRUE, TRUE
        );
        $response = new GetDistributionListResponse($dl);
        $this->assertSame($dl, $response->getDl());
        $response = new GetDistributionListResponse();
        $response->setDl($dl);
        $this->assertSame($dl, $response->getDl());

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetDistributionListRequest needOwners="true" needRights="$needRights">
            <dl by="name">$value</dl>
            <a name="$name" pd="true">$value</a>
        </urn:GetDistributionListRequest>
        <urn:GetDistributionListResponse>
            <dl name="$name" id="$id" isOwner="true" isMember="true" dynamic="true">
                <a n="$key">$value</a>
                <dlm>$member1</dlm>
                <dlm>$member2</dlm>
                <owners>
                    <owner type="usr" id="$id" name="$name" />
                </owners>
                <rights>
                    <right right="$name">
                        <grantee type="usr" id="$id" name="$name" />
                    </right>
                </rights>
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
                    'needOwners' => TRUE,
                    'needRights' => $needRights,
                    'dl' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'a' => [
                        [
                            'name' => $name,
                            '_content' => $value,
                            'pd' => TRUE,
                        ]
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetDistributionListResponse' => [
                    'dl' => [
                        'id' => $id,
                        'name' => $name,
                        'isOwner' => TRUE,
                        'isMember' => TRUE,
                        'dynamic' => TRUE,
                        'dlm' => [
                            [
                                '_content' => $member1,
                            ],
                            [
                                '_content' => $member2,
                            ],
                        ],
                        'owners' => [
                            'owner' => [
                                [
                                    'type' => 'usr',
                                    'id' => $id,
                                    'name' => $name,
                                ],
                            ],
                        ],
                        'rights' => [
                            'right' => [
                                [
                                    'right' => $name,
                                    'grantee' => [
                                        [
                                            'type' => 'usr',
                                            'id' => $id,
                                            'name' => $name,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetDistributionListEnvelope::class, 'json'));
    }
}