<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\GetShareInfoBody;
use Zimbra\Account\Message\GetShareInfoEnvelope;
use Zimbra\Account\Message\GetShareInfoRequest;
use Zimbra\Account\Message\GetShareInfoResponse;

use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\GranteeChooser;
use Zimbra\Struct\ShareInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetShareInfoTest.
 */
class GetShareInfoTest extends ZimbraStructTestCase
{
    public function testGetShareInfo()
    {
        $type = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $ownerId = $this->faker->uuid;
        $ownerEmail = $this->faker->email;
        $ownerDisplayName = $this->faker->name;
        $folderId = mt_rand(1, 100);
        $folderUuid = $this->faker->uuid;
        $folderPath = $this->faker->word;
        $defaultView = $this->faker->word;
        $rights = $this->faker->word;
        $granteeType = $this->faker->word;
        $granteeId = $this->faker->uuid;
        $granteeName = $this->faker->name;
        $granteeDisplayName = $this->faker->name;
        $mountpointId = $this->faker->uuid;

        $grantee = new GranteeChooser($type, $id, $name);
        $owner = new AccountSelector(AccountBy::NAME(), $value);

        $request = new GetShareInfoRequest($grantee, $owner, FALSE, FALSE);
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($owner, $request->getOwner());
        $this->assertFalse($request->getInternal());
        $this->assertFalse($request->getIncludeSelf());
        $request = new GetShareInfoRequest();
        $request->setGrantee($grantee)
            ->setOwner($owner)
            ->setInternal(TRUE)
            ->setIncludeSelf(TRUE);
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($owner, $request->getOwner());
        $this->assertTrue($request->getInternal());
        $this->assertTrue($request->getIncludeSelf());

        $share = new ShareInfo(
            $ownerId, $ownerEmail, $ownerDisplayName,
            $folderId, $folderUuid, $folderPath,
            $defaultView, $rights,
            $granteeType, $granteeId, $granteeName, $granteeDisplayName,
            $mountpointId
        );
        $response = new GetShareInfoResponse([$share]);
        $this->assertSame([$share], $response->getShares());
        $response = new GetShareInfoResponse();
        $response->setShares([$share])
            ->addShare($share);
        $this->assertSame([$share, $share], $response->getShares());
        $response->setShares([$share]);

        $body = new GetShareInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetShareInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetShareInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetShareInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetShareInfoRequest internal="true" includeSelf="true">
            <grantee type="$type" id="$id" name="$name" />
            <owner by="name">$value</owner>
        </urn:GetShareInfoRequest>
        <urn:GetShareInfoResponse>
            <share ownerId="$ownerId" ownerEmail="$ownerEmail" ownerName="$ownerDisplayName" folderId="$folderId" folderUuid="$folderUuid" folderPath="$folderPath" view="$defaultView" rights="$rights" granteeType="$granteeType" granteeId="$granteeId" granteeName="$granteeName" granteeDisplayName="$granteeDisplayName" mid="$mountpointId" />
        </urn:GetShareInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetShareInfoEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetShareInfoRequest' => [
                    'internal' => TRUE,
                    'includeSelf' => TRUE,
                    'grantee' => [
                        'type' => $type,
                        'id' => $id,
                        'name' => $name,
                    ],
                    'owner' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetShareInfoResponse' => [
                    'share' => [
                        [
                            'ownerId' => $ownerId,
                            'ownerEmail' => $ownerEmail,
                            'ownerName' => $ownerDisplayName,
                            'folderId' => $folderId,
                            'folderUuid' => $folderUuid,
                            'folderPath' => $folderPath,
                            'view' => $defaultView,
                            'rights' => $rights,
                            'granteeType' => $granteeType,
                            'granteeId' => $granteeId,
                            'granteeName' => $granteeName,
                            'granteeDisplayName' => $granteeDisplayName,
                            'mid' => $mountpointId,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetShareInfoEnvelope::class, 'json'));
    }
}
