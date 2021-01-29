<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetInfoEnvelope;
use Zimbra\Account\Message\GetInfoBody;
use Zimbra\Account\Message\GetInfoRequest;
use Zimbra\Account\Message\GetInfoResponse;

use Zimbra\Common\SerializerFactory;
use Zimbra\Account\SerializerHandler;

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

use Zimbra\Enum\ConnectionType;
use Zimbra\Enum\ContentType;
use Zimbra\Enum\InfoSection;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\ZimletPresence;

use Zimbra\Tests\Struct\ZimbraStructTestCase;
/**
 * Testcase class for GetInfo.
 */
class GetInfoTest extends ZimbraStructTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testGetInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;
        $modified = mt_rand(1, 100);
        $sections = implode(',', $this->faker->randomElements(InfoSection::values(), 2));
        $rights = implode(',', [$this->faker->word, $this->faker->word]);
        $zimletName = $this->faker->word;
        $cid = $this->faker->word;

        $type = TargetType::ACCOUNT();
        $displayName = $this->faker->word;
        $addr = $this->faker->word;
        $right = $this->faker->word;

        $baseUrl = $this->faker->word;
        $priority = mt_rand(1, 10);
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $hasKeyword = $this->faker->word;
        $extensionClass = $this->faker->word;
        $regex = $this->faker->word;

        $attachmentSizeLimit = mt_rand(1, 100);
        $documentSizeLimit = mt_rand(1, 100);
        $version = $this->faker->word;
        $accountId = $this->faker->uuid;
        $profileImageId = mt_rand(1, 100);
        $accountName = $this->faker->word;
        $crumb = $this->faker->word;
        $lifetime = mt_rand(1, 100);
        $restUrl = $this->faker->url;
        $quotaUsed = mt_rand(1, 100);
        $previousSessionTime = mt_rand(1, 100);
        $lastWriteAccessTime = mt_rand(1, 100);
        $recentMessageCount = mt_rand(1, 100);
        $soapURL = $this->faker->url;
        $publicURL = $this->faker->url;
        $changePasswordURL = $this->faker->url;
        $adminURL = $this->faker->url;
        $boshURL = $this->faker->url;

        $folderId = $this->faker->word;
        $host = $this->faker->ipv4;
        $port = mt_rand(1, 100);
        $connectionType = ConnectionType::CLEAR_TEXT();
        $username = $this->faker->email;
        $password = $this->faker->text;
        $pollingInterval = $this->faker->word;
        $emailAddress = $this->faker->email;
        $defaultSignature = $this->faker->word;
        $forwardReplySignature = $this->faker->word;
        $fromDisplay = $this->faker->name;
        $replyToAddress = $this->faker->email;
        $replyToDisplay = $this->faker->name;
        $importClass = $this->faker->text;
        $failingSince = mt_rand(1, 100);
        $lastError = $this->faker->text;
        $refreshToken = $this->faker->text;
        $refreshTokenUrl = $this->faker->url;
        $attribute1 = $this->faker->text;
        $attribute2 = $this->faker->text;
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
            ->addPref($pref)
            ->setAttrs([$attr])
            ->addAttr($attr)
            ->setZimlets([$zimlet])
            ->addZimlet($zimlet)
            ->setProps([$prop])
            ->addProp($prop)
            ->setIdentities([$identity])
            ->addIdentity($identity)
            ->setSignatures([$signature])
            ->addSignature($signature)
            ->setDataSources([
                $imap,
                $pop3,
                $caldav,
                $yab,
                $rss,
                $gal,
                $cal,
            ])
            ->addDataSource($unknown)
            ->setChildAccounts([$childAccount])
            ->addChildAccount($childAccount)
            ->setDiscoveredRights([$rightsInfo])
            ->addDiscoveredRight($rightsInfo)
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
        $this->assertSame([$pref, $pref], $response->getPrefs());
        $this->assertSame([$attr, $attr], $response->getAttrs());
        $this->assertSame([$zimlet, $zimlet], $response->getZimlets());
        $this->assertSame([$identity, $identity], $response->getIdentities());
        $this->assertSame([$signature, $signature], $response->getSignatures());
        $this->assertEquals($dataSources, $response->getDataSources());
        $this->assertSame([$childAccount, $childAccount], $response->getChildAccounts());
        $this->assertSame([$rightsInfo, $rightsInfo], $response->getDiscoveredRights());
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
            <version>$version</version>
            <id>$accountId</id>
            <profileImageId>$profileImageId</profileImageId>
            <name>$accountName</name>
            <crumb>$crumb</crumb>
            <lifetime>$lifetime</lifetime>
            <adminDelegated>true</adminDelegated>
            <rest>$restUrl</rest>
            <used>$quotaUsed</used>
            <prevSession>$previousSessionTime</prevSession>
            <accessed>$lastWriteAccessTime</accessed>
            <recent>$recentMessageCount</recent>
            <cos id="$id" name="$name" />
            <prefs>
                <pref name="$name" modified="$modified">$value</pref>
            </prefs>
            <attrs>
                <attr name="$name" pd="true">$value</attr>
            </attrs>
            <zimlets>
                <zimlet>
                    <zimletContext baseUrl="$baseUrl" priority="$priority" presence="enabled" />
                    <zimlet name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <serverExtension hasKeyword="$hasKeyword" extensionClass="$extensionClass" regex="$regex" />
                        <include>$value</include>
                        <includeCSS>$value</includeCSS>
                    </zimlet>
                    <zimletConfig name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <global>
                            <property name="$name">$value</property>
                        </global>
                        <host name="$name">
                            <property name="$name">$value</property>
                        </host>
                    </zimletConfig>
                </zimlet>
            </zimlets>
            <props>
                <prop zimlet="$zimletName" name="$name">$value</prop>
            </props>
            <identities>
                <identity name="$name" id="$id">
                    <a name="$name" pd="true">$value</a>
                </identity>
            </identities>
            <signatures>
                <signature name="$name" id="$id">
                    <cid>$cid</cid>
                    <content type="text/html">$value</content>
                </signature>
            </signatures>
            <dataSources>
                <imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </imap>
                <pop3 id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" leaveOnServer="true">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </pop3>
                <caldav id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </caldav>
                <yab id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </yab>
                <rss id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </rss>
                <gal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </gal>
                <cal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </cal>
                <unknown id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <lastError>$lastError</lastError>
                    <a>$attribute1</a>
                    <a>$attribute2</a>
                </unknown>
            </dataSources>
            <childAccounts>
                <childAccount id="$id" name="$name" visible="true" active="true">
                    <attrs>
                        <attr name="$name" pd="true">$value</attr>
                    </attrs>
                </childAccount>
            </childAccounts>
            <rights>
                <targets right="$right">
                    <target type="$type" id="$id" name="$name" d="$displayName">
                        <email addr="$addr" />
                    </target>
                </targets>
            </rights>
            <soapURL>$soapURL</soapURL>
            <publicURL>$publicURL</publicURL>
            <changePasswordURL>$changePasswordURL</changePasswordURL>
            <adminURL>$adminURL</adminURL>
            <boshURL>$boshURL</boshURL>
            <isTrackingIMAP>true</isTrackingIMAP>
        </urn:GetInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetInfoEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetInfoRequest' => [
                    'sections' => $sections,
                    'rights' => $rights,
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetInfoResponse' => [
                    'attSizeLimit' => $attachmentSizeLimit,
                    'docSizeLimit' => $documentSizeLimit,
                    'version' => [
                        '_content' => $version,
                    ],
                    'id' => [
                        '_content' => $accountId,
                    ],
                    'profileImageId' => [
                        '_content' => $profileImageId,
                    ],
                    'name' => [
                        '_content' => $accountName,
                    ],
                    'crumb' => [
                        '_content' => $crumb,
                    ],
                    'lifetime' => [
                        '_content' => $lifetime,
                    ],
                    'adminDelegated' => [
                        '_content' => TRUE,
                    ],
                    'rest' => [
                        '_content' => $restUrl,
                    ],
                    'used' => [
                        '_content' => $quotaUsed,
                    ],
                    'prevSession' => [
                        '_content' => $previousSessionTime,
                    ],
                    'accessed' => [
                        '_content' => $lastWriteAccessTime,
                    ],
                    'recent' => [
                        '_content' => $recentMessageCount,
                    ],
                    'cos' => [
                        'name' => $name,
                        'id' => $id,
                    ],
                    'prefs' => [
                        'pref' => [
                            [
                                'name' => $name,
                                'modified' => $modified,
                                '_content' => $value,
                           ],
                        ],
                    ],
                    'attrs' => [
                        'attr' => [
                            [
                                'name' => $name,
                                'pd' => TRUE,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    'zimlets' => [
                        'zimlet' => [
                            [
                                'zimletContext' => [
                                    'baseUrl' => $baseUrl,
                                    'priority' => $priority,
                                    'presence' => 'enabled',
                                ],
                                'zimlet' => [
                                    'name' => $name,
                                    'version' => $version,
                                    'description' => $description,
                                    'extension' => $extension,
                                    'target' => $target,
                                    'label' => $label,
                                    'serverExtension' => [
                                        'hasKeyword' => $hasKeyword,
                                        'extensionClass' => $extensionClass,
                                        'regex' => $regex,
                                    ],
                                    'include' => [
                                        '_content' => $value,
                                    ],
                                    'includeCSS' => [
                                        '_content' => $value,
                                    ],
                                ],
                                'zimletConfig' => [
                                    'name' => $name,
                                    'version' => $version,
                                    'description' => $description,
                                    'extension' => $extension,
                                    'target' => $target,
                                    'label' => $label,
                                    'global' => [
                                        'property' => [
                                            [
                                                'name' => $name,
                                                '_content' => $value,
                                            ],
                                        ],
                                    ],
                                    'host' => [
                                        'name' => $name,
                                        'property' => [
                                            [
                                                'name' => $name,
                                                '_content' => $value,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'props' => [
                        'prop' => [
                            [
                                'zimlet' => $zimletName,
                                'name' => $name,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    'identities' => [
                        'identity' => [
                            [
                                'name' => $name,
                                'id' => $id,
                                'a' => [
                                    [
                                        'name' => $name,
                                        'pd' => TRUE,
                                        '_content' => $value,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'signatures' => [
                        'signature' => [
                            [
                                'name' => $name,
                                'id' => $id,
                                'cid' => [
                                    '_content' => $cid,
                                ],
                                'content' => [
                                    [
                                        'type' => 'text/html',
                                        '_content' => $value,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'dataSources' => [
                        'imap' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                            ],
                        ],
                        'pop3' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                                'leaveOnServer' => TRUE,
                            ],
                        ],
                        'caldav' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                            ],
                        ],
                        'yab' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                            ],
                        ],
                        'rss' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                            ],
                        ],
                        'gal' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                            ],
                        ],
                        'cal' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                            ],
                        ],
                        'unknown' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'l' => $folderId,
                                'isEnabled' => TRUE,
                                'importOnly' => TRUE,
                                'host' => $host,
                                'port' => $port,
                                'connectionType' => $connectionType,
                                'username' => $username,
                                'password' => $password,
                                'pollingInterval' => $pollingInterval,
                                'emailAddress' => $emailAddress,
                                'useAddressForForwardReply' => TRUE,
                                'defaultSignature' => $defaultSignature,
                                'forwardReplySignature' => $forwardReplySignature,
                                'fromDisplay' => $fromDisplay,
                                'replyToAddress' => $replyToAddress,
                                'replyToDisplay' => $replyToDisplay,
                                'importClass' => $importClass,
                                'failingSince' => $failingSince,
                                'lastError' => [
                                    '_content' => $lastError,
                                ],
                                'a' => [
                                    [
                                        '_content' => $attribute1,
                                    ],
                                    [
                                        '_content' => $attribute2,
                                    ],
                                ],
                                'refreshToken' => $refreshToken,
                                'refreshTokenUrl' => $refreshTokenUrl,
                            ],
                        ],
                    ],
                    'childAccounts' => [
                        'childAccount' => [
                            [
                                'id' => $id,
                                'name' => $name,
                                'visible' => TRUE,
                                'active' => TRUE,
                                'attrs' => [
                                    'attr' => [
                                        [
                                            'name' => $name,
                                            'pd' => TRUE,
                                            '_content' => $value,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'rights' => [
                        'targets' => [
                            [
                                'right' => $right,
                                'target' => [
                                    [
                                        'type' => $type,
                                        'id' => $id,
                                        'name' => $name,
                                        'd' => $displayName,
                                        'email' => [
                                            [
                                                'addr' => $addr,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'soapURL' => [
                        '_content' => $soapURL,
                    ],
                    'publicURL' => [
                        '_content' => $publicURL,
                    ],
                    'changePasswordURL' => [
                        '_content' => $changePasswordURL,
                    ],
                    'adminURL' => [
                        '_content' => $adminURL,
                    ],
                    'boshURL' => [
                        '_content' => $boshURL,
                    ],
                    'isTrackingIMAP' => [
                        '_content' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetInfoEnvelope::class, 'json'));
    }
}
