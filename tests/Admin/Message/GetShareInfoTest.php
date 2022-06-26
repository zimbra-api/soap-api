<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetShareInfoBody;
use Zimbra\Admin\Message\GetShareInfoEnvelope;
use Zimbra\Admin\Message\GetShareInfoRequest;
use Zimbra\Admin\Message\GetShareInfoResponse;

use Zimbra\Common\Enum\AccountBy;

use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Common\Struct\GranteeChooser;
use Zimbra\Common\Struct\ShareInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetShareInfo.
 */
class GetShareInfoTest extends ZimbraTestCase
{
    public function testGetShareInfo()
    {
        $type = $this->faker->word;
        $id = $this->faker->uuid;
        $name = $this->faker->name;
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

        $request = new GetShareInfoRequest($owner, $grantee);
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($owner, $request->getOwner());

        $request = new GetShareInfoRequest(new AccountSelector(AccountBy::NAME(), ''));
        $request->setGrantee($grantee)
            ->setOwner($owner);
        $this->assertSame($grantee, $request->getGrantee());
        $this->assertSame($owner, $request->getOwner());

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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetShareInfoRequest>
            <urn:grantee type="$type" id="$id" name="$name" />
            <urn:owner by="name">$value</owner>
        </urn:GetShareInfoRequest>
        <urn:GetShareInfoResponse>
            <urn:share ownerId="$ownerId" ownerEmail="$ownerEmail" ownerName="$ownerDisplayName" folderId="$folderId" folderUuid="$folderUuid" folderPath="$folderPath" view="$defaultView" rights="$rights" granteeType="$granteeType" granteeId="$granteeId" granteeName="$granteeName" granteeDisplayName="$granteeDisplayName" mid="$mountpointId" />
        </urn:GetShareInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetShareInfoEnvelope::class, 'xml'));
    }
}
