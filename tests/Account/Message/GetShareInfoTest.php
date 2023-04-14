<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetShareInfoBody;
use Zimbra\Account\Message\GetShareInfoEnvelope;
use Zimbra\Account\Message\GetShareInfoRequest;
use Zimbra\Account\Message\GetShareInfoResponse;

use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Common\Struct\GranteeChooser;
use Zimbra\Common\Struct\ShareInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetShareInfoTest.
 */
class GetShareInfoTest extends ZimbraTestCase
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
        $folderId = $this->faker->randomNumber;
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
        $owner = new AccountSelector(AccountBy::NAME, $value);

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
        $response->setShares([$share]);
        $this->assertSame([$share], $response->getShares());

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
            <urn:grantee type="$type" id="$id" name="$name" />
            <urn:owner by="name">$value</urn:owner>
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
