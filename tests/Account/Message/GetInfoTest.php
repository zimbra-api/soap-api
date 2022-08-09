<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetInfoEnvelope;
use Zimbra\Account\Message\GetInfoBody;
use Zimbra\Account\Message\GetInfoRequest;
use Zimbra\Account\Message\GetInfoResponse;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Cos;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\Prop;
use Zimbra\Account\Struct\Identity;
use Zimbra\Account\Struct\ChildAccount;

use Zimbra\Account\Struct\AccountZimletInfo;
use Zimbra\Account\Struct\AccountZimletContext;
use Zimbra\Account\Struct\AccountZimletDesc;
use Zimbra\Account\Struct\AccountZimletInclude;
use Zimbra\Account\Struct\AccountZimletIncludeCSS;
use Zimbra\Account\Struct\ZimletServerExtension;
use Zimbra\Account\Struct\AccountZimletConfigInfo;
use Zimbra\Account\Struct\AccountZimletGlobalConfigInfo;
use Zimbra\Account\Struct\AccountZimletHostConfigInfo;
use Zimbra\Account\Struct\AccountZimletProperty;

use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\SignatureContent;

use Zimbra\Account\Struct\AccountDataSources;
use Zimbra\Account\Struct\AccountImapDataSource;
use Zimbra\Account\Struct\AccountPop3DataSource;
use Zimbra\Account\Struct\AccountCaldavDataSource;
use Zimbra\Account\Struct\AccountYabDataSource;
use Zimbra\Account\Struct\AccountRssDataSource;
use Zimbra\Account\Struct\AccountGalDataSource;
use Zimbra\Account\Struct\AccountCalDataSource;
use Zimbra\Account\Struct\AccountUnknownDataSource;

use Zimbra\Account\Struct\DiscoverRightsEmail;
use Zimbra\Account\Struct\DiscoverRightsInfo;
use Zimbra\Account\Struct\DiscoverRightsTarget;

use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Common\Enum\ContentType;
use Zimbra\Common\Enum\InfoSection;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Enum\ZimletPresence;

use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for GetInfo.
 */
class GetInfoTest extends ZimbraTestCase
{
    public function testGetInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;
        $modified = $this->faker->randomNumber;
        $sections = implode(',', $this->faker->randomElements(InfoSection::values(), 2));
        $rights = implode(',', [$this->faker->unique->word, $this->faker->unique->word]);
        $zimletName = $this->faker->word;
        $cid = $this->faker->uuid;

        $type = TargetType::ACCOUNT();
        $displayName = $this->faker->word;
        $addr = $this->faker->word;
        $right = $this->faker->word;

        $baseUrl = $this->faker->word;
        $priority = $this->faker->randomNumber;
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $hasKeyword = $this->faker->word;
        $extensionClass = $this->faker->word;
        $regex = $this->faker->word;

        $attachmentSizeLimit = $this->faker->randomNumber;
        $documentSizeLimit = $this->faker->randomNumber;
        $version = $this->faker->word;
        $accountId = $this->faker->uuid;
        $profileImageId = $this->faker->randomNumber;
        $accountName = $this->faker->word;
        $crumb = $this->faker->word;
        $lifetime = $this->faker->randomNumber;
        $restUrl = $this->faker->url;
        $quotaUsed = $this->faker->randomNumber;
        $previousSessionTime = $this->faker->unixTime;
        $lastWriteAccessTime = $this->faker->unixTime;
        $recentMessageCount = $this->faker->randomNumber;
        $soapURL = $this->faker->url;
        $publicURL = $this->faker->url;
        $changePasswordURL = $this->faker->url;
        $adminURL = $this->faker->url;
        $boshURL = $this->faker->url;

        $folderId = $this->faker->word;
        $host = $this->faker->ipv4;
        $port = $this->faker->randomNumber;
        $connectionType = ConnectionType::CLEAR_TEXT();
        $username = $this->faker->email;
        $password = $this->faker->word;
        $pollingInterval = $this->faker->word;
        $emailAddress = $this->faker->email;
        $defaultSignature = $this->faker->word;
        $forwardReplySignature = $this->faker->word;
        $fromDisplay = $this->faker->name;
        $replyToAddress = $this->faker->email;
        $replyToDisplay = $this->faker->name;
        $importClass = $this->faker->word;
        $failingSince = $this->faker->randomNumber;
        $lastError = $this->faker->word;
        $refreshToken = $this->faker->sha256;
        $refreshTokenUrl = $this->faker->url;
        $attribute1 = $this->faker->unique->word;
        $attribute2 = $this->faker->unique->word;
        $attributes = [
            $attribute1,
            $attribute2,
        ];

        $request = new GetInfoRequest($sections, $rights);
        $this->assertSame($sections, $request->getSections());
        $this->assertSame($rights, $request->getRights());

        $request = new GetInfoRequest();
        $request->setSections($sections)
            ->setRights($rights);
        $this->assertSame($sections, $request->getSections());
        $this->assertSame($rights, $request->getRights());

        $cos = new Cos($id, $name);
        $pref = new Pref($name, $value, $modified);
        $attr = new Attr($name, $value, TRUE);
        $prop = new Prop($zimletName, $name, $value);
        $childAccount = new ChildAccount($id, $name, TRUE, TRUE, [$attr]);
        $identity = new Identity($name, $id, [$attr]);
        $signature = new Signature($name, $id, $cid, [new SignatureContent($value, ContentType::TEXT_HTML())]);

        $zimletContext = new AccountZimletContext(
            $baseUrl, ZimletPresence::ENABLED(), $priority
        );
        $zimletDesc = new AccountZimletDesc(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletDesc->setServerExtension(new ZimletServerExtension($hasKeyword, $extensionClass, $regex))
            ->setZimletInclude(new AccountZimletInclude($value))
            ->setZimletIncludeCSS(new AccountZimletIncludeCSS($value));
        $property = new AccountZimletProperty($name, $value);
        $zimletConfig = new AccountZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletConfig->setGlobal(new AccountZimletGlobalConfigInfo([$property]))
            ->setHost(new AccountZimletHostConfigInfo($name, [$property]));
        $zimlet = new AccountZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );

        $imap = new AccountImapDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $pop3 = new AccountPop3DataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $pop3->setLeaveOnServer(TRUE);
        $caldav = new AccountCaldavDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $yab = new AccountYabDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $rss = new AccountRssDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $gal = new AccountGalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $cal = new AccountCalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $unknown = new AccountUnknownDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $dataSources = [
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ];
        $rightsInfo = new DiscoverRightsInfo($right, [
            new DiscoverRightsTarget($type, $id, $name, $displayName, [new DiscoverRightsEmail($addr)])
        ]);

        $response = new GetInfoResponse(
            $attachmentSizeLimit, $documentSizeLimit, $version, $accountId, $profileImageId, $accountName, $crumb, $lifetime, FALSE, $restUrl, $quotaUsed, $previousSessionTime, $lastWriteAccessTime, $recentMessageCount, $cos, [$pref], [$attr], [$zimlet], [$prop], [$identity], [$signature], $dataSources, [$childAccount], [$rightsInfo], $soapURL, $publicURL, $changePasswordURL, $adminURL, $boshURL, FALSE
        );
        $this->assertSame($attachmentSizeLimit, $response->getAttachmentSizeLimit());
        $this->assertSame($documentSizeLimit, $response->getDocumentSizeLimit());
        $this->assertSame($version, $response->getVersion());
        $this->assertSame($accountId, $response->getAccountId());
        $this->assertSame($profileImageId, $response->getProfileImageId());
        $this->assertSame($accountName, $response->getAccountName());
        $this->assertSame($crumb, $response->getCrumb());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertFalse($response->getAdminDelegated());
        $this->assertSame($restUrl, $response->getRestUrl());
        $this->assertSame($quotaUsed, $response->getQuotaUsed());
        $this->assertSame($previousSessionTime, $response->getPreviousSessionTime());
        $this->assertSame($lastWriteAccessTime, $response->getLastWriteAccessTime());
        $this->assertSame($recentMessageCount, $response->getRecentMessageCount());
        $this->assertSame($cos, $response->getCos());
        $this->assertSame([$pref], $response->getPrefs());
        $this->assertSame([$attr], $response->getAttrs());
        $this->assertSame([$zimlet], $response->getZimlets());
        $this->assertSame([$prop], $response->getProps());
        $this->assertSame([$identity], $response->getIdentities());
        $this->assertSame([$signature], $response->getSignatures());
        $this->assertSame($dataSources, $response->getDataSources());
        $this->assertSame([$childAccount], $response->getChildAccounts());
        $this->assertSame([$rightsInfo], $response->getDiscoveredRights());
        $this->assertSame($soapURL, $response->getSoapURL());
        $this->assertSame($publicURL, $response->getPublicURL());
        $this->assertSame($changePasswordURL, $response->getChangePasswordURL());
        $this->assertSame($adminURL, $response->getAdminURL());
        $this->assertSame($boshURL, $response->getBoshURL());
        $this->assertFalse($response->getIsTrackingIMAP());

        $response = new GetInfoResponse();
        $response->setAttachmentSizeLimit($attachmentSizeLimit)
            ->setDocumentSizeLimit($documentSizeLimit)
            ->setVersion($version)
            ->setAccountId($accountId)
            ->setProfileImageId($profileImageId)
            ->setAccountName($accountName)
            ->setCrumb($crumb)
            ->setLifetime($lifetime)
            ->setAdminDelegated(TRUE)
            ->setRestUrl($restUrl)
            ->setQuotaUsed($quotaUsed)
            ->setPreviousSessionTime($previousSessionTime)
            ->setLastWriteAccessTime($lastWriteAccessTime)
            ->setRecentMessageCount($recentMessageCount)
            ->setCos($cos)
            ->setPrefs([$pref])
            ->setAttrs([$attr])
            ->setZimlets([$zimlet])
            ->setProps([$prop])
            ->setIdentities([$identity])
            ->setSignatures([$signature])
            ->setDataSources([
                $imap,
                $pop3,
                $caldav,
                $yab,
                $rss,
                $gal,
                $cal,
                $unknown,
            ])
            ->setChildAccounts([$childAccount])
            ->setDiscoveredRights([$rightsInfo])
            ->setSoapURL($soapURL)
            ->setPublicURL($publicURL)
            ->setChangePasswordURL($changePasswordURL)
            ->setAdminURL($adminURL)
            ->setBoshURL($boshURL)
            ->setIsTrackingIMAP(TRUE);
        $this->assertSame($attachmentSizeLimit, $response->getAttachmentSizeLimit());
        $this->assertSame($documentSizeLimit, $response->getDocumentSizeLimit());
        $this->assertSame($version, $response->getVersion());
        $this->assertSame($accountId, $response->getAccountId());
        $this->assertSame($profileImageId, $response->getProfileImageId());
        $this->assertSame($accountName, $response->getAccountName());
        $this->assertSame($crumb, $response->getCrumb());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertTrue($response->getAdminDelegated());
        $this->assertSame($restUrl, $response->getRestUrl());
        $this->assertSame($quotaUsed, $response->getQuotaUsed());
        $this->assertSame($previousSessionTime, $response->getPreviousSessionTime());
        $this->assertSame($lastWriteAccessTime, $response->getLastWriteAccessTime());
        $this->assertSame($recentMessageCount, $response->getRecentMessageCount());
        $this->assertSame($cos, $response->getCos());
        $this->assertSame([$pref], $response->getPrefs());
        $this->assertSame([$attr], $response->getAttrs());
        $this->assertSame([$zimlet], $response->getZimlets());
        $this->assertSame([$prop], $response->getProps());
        $this->assertSame([$identity], $response->getIdentities());
        $this->assertSame([$signature], $response->getSignatures());
        $this->assertEquals($dataSources, $response->getDataSources());
        $this->assertSame([$childAccount], $response->getChildAccounts());
        $this->assertSame([$rightsInfo], $response->getDiscoveredRights());
        $this->assertSame($soapURL, $response->getSoapURL());
        $this->assertSame($publicURL, $response->getPublicURL());
        $this->assertSame($changePasswordURL, $response->getChangePasswordURL());
        $this->assertSame($adminURL, $response->getAdminURL());
        $this->assertSame($boshURL, $response->getBoshURL());
        $this->assertTrue($response->getIsTrackingIMAP());
        $response = new GetInfoResponse(
            $attachmentSizeLimit, $documentSizeLimit, $version, $accountId, $profileImageId, $accountName, $crumb, $lifetime, TRUE, $restUrl, $quotaUsed, $previousSessionTime, $lastWriteAccessTime, $recentMessageCount, $cos, [$pref], [$attr], [$zimlet], [$prop], [$identity], [$signature], $dataSources, [$childAccount], [$rightsInfo], $soapURL, $publicURL, $changePasswordURL, $adminURL, $boshURL, TRUE
        );

        $body = new GetInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetInfoBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetInfoRequest sections="$sections" rights="$rights" />
        <urn:GetInfoResponse attSizeLimit="$attachmentSizeLimit" docSizeLimit="$documentSizeLimit">
            <urn:version>$version</urn:version>
            <urn:id>$accountId</urn:id>
            <urn:profileImageId>$profileImageId</urn:profileImageId>
            <urn:name>$accountName</urn:name>
            <urn:crumb>$crumb</urn:crumb>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:adminDelegated>true</urn:adminDelegated>
            <urn:rest>$restUrl</urn:rest>
            <urn:used>$quotaUsed</urn:used>
            <urn:prevSession>$previousSessionTime</urn:prevSession>
            <urn:accessed>$lastWriteAccessTime</urn:accessed>
            <urn:recent>$recentMessageCount</urn:recent>
            <urn:cos id="$id" name="$name" />
            <urn:prefs>
                <urn:pref name="$name" modified="$modified">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:zimlets>
                <urn:zimlet>
                    <urn:zimletContext baseUrl="$baseUrl" priority="$priority" presence="enabled" />
                    <urn:zimlet name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <urn:serverExtension hasKeyword="$hasKeyword" extensionClass="$extensionClass" regex="$regex" />
                        <urn:include>$value</urn:include>
                        <urn:includeCSS>$value</urn:includeCSS>
                    </urn:zimlet>
                    <urn:zimletConfig name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <urn:global>
                            <urn:property name="$name">$value</urn:property>
                        </urn:global>
                        <urn:host name="$name">
                            <urn:property name="$name">$value</urn:property>
                        </urn:host>
                    </urn:zimletConfig>
                </urn:zimlet>
            </urn:zimlets>
            <urn:props>
                <urn:prop zimlet="$zimletName" name="$name">$value</urn:prop>
            </urn:props>
            <urn:identities>
                <urn:identity name="$name" id="$id">
                    <urn:a name="$name" pd="true">$value</urn:a>
                </urn:identity>
            </urn:identities>
            <urn:signatures>
                <urn:signature name="$name" id="$id">
                    <urn:cid>$cid</urn:cid>
                    <urn:content type="text/html">$value</urn:content>
                </urn:signature>
            </urn:signatures>
            <urn:dataSources>
                <urn:imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:imap>
                <urn:pop3 id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" leaveOnServer="true">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:pop3>
                <urn:caldav id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:caldav>
                <urn:yab id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:yab>
                <urn:rss id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:rss>
                <urn:gal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:gal>
                <urn:cal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:cal>
                <urn:unknown id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:unknown>
            </urn:dataSources>
            <urn:childAccounts>
                <urn:childAccount id="$id" name="$name" visible="true" active="true">
                    <urn:attrs>
                        <urn:attr name="$name" pd="true">$value</urn:attr>
                    </urn:attrs>
                </urn:childAccount>
            </urn:childAccounts>
            <urn:rights>
                <urn:targets right="$right">
                    <urn:target type="$type" id="$id" name="$name" d="$displayName">
                        <urn:email addr="$addr" />
                    </urn:target>
                </urn:targets>
            </urn:rights>
            <urn:soapURL>$soapURL</urn:soapURL>
            <urn:publicURL>$publicURL</urn:publicURL>
            <urn:changePasswordURL>$changePasswordURL</urn:changePasswordURL>
            <urn:adminURL>$adminURL</urn:adminURL>
            <urn:boshURL>$boshURL</urn:boshURL>
            <urn:isTrackingIMAP>true</urn:isTrackingIMAP>
        </urn:GetInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetInfoEnvelope::class, 'xml'));
    }
}
