<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin;

use Zimbra\Admin\{AdminApi, AdminApiInterface};
use Zimbra\Soap\ClientInterface;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for account api.
 */
class AdminApiTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testAdminApi()
    {
        $api = $this->createStub(AdminApi::class);
        $this->assertTrue($api instanceof AdminApiInterface);
    }

    public function testAddAccountAlias()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddAccountAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->addAccountAlias($this->faker->uuid, $this->faker->email);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\AddAccountAliasResponse);
    }

    public function testAddAccountLogger()
    {
        $category = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddAccountLoggerResponse>
            <urn:logger category="$category" level="info" />
        </urn:AddAccountLoggerResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->addAccountLogger(new \Zimbra\Admin\Struct\LoggerInfo());
        $logger = new \Zimbra\Admin\Struct\LoggerInfo($category, \Zimbra\Common\Enum\LoggingLevel::INFO());
        $this->assertEquals([$logger], $response->getLoggers());
    }

    public function testAddDistributionListAlias()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddDistributionListAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->addDistributionListAlias($this->faker->uuid, $this->faker->email);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\AddDistributionListAliasResponse);
    }

    public function testAddDistributionListMember()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:AddDistributionListMemberResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->addDistributionListMember($this->faker->uuid, []);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\AddDistributionListMemberResponse);
    }

    public function testAddGalSyncDataSource()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $domain = $this->faker->domainName;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AddGalSyncDataSourceResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:AddGalSyncDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->addGalSyncDataSource(
            new \Zimbra\Common\Struct\AccountSelector(), $name, $domain, \Zimbra\Common\Enum\GalMode::BOTH()
        );
        $account = new \Zimbra\Admin\Struct\AccountInfo($name, $id, TRUE, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($account, $response->getAccount());
    }

    public function testAdminCreateWaitSet()
    {
        $waitSetId = $this->faker->uuid;
        $defaultInterests = $this->faker->word;
        $id = $this->faker->uuid;
        $type = $this->faker->word;
        $sequence = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AdminCreateWaitSetResponse waitSet="$waitSetId" defTypes="$defaultInterests" seq="$sequence">
            <urn:error id="$id" type="$type" />
        </urn:AdminCreateWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->adminCreateWaitSet(
            $defaultInterests
        );
        $error = new \Zimbra\Common\Struct\IdAndType($id, $type);
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertSame($defaultInterests, $response->getDefaultInterests());
        $this->assertSame($sequence, $response->getSequence());
        $this->assertEquals([$error], $response->getErrors());
    }

    public function testAdminDestroyWaitSet()
    {
        $waitSetId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AdminDestroyWaitSetResponse waitSet="$waitSetId" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->adminDestroyWaitSet(
            $waitSetId
        );
        $this->assertSame($waitSetId, $response->getWaitSetId());
    }

    public function testAdminWaitSet()
    {
        $waitSetId = $this->faker->uuid;
        $name = $this->faker->word;
        $id = $this->faker->randomNumber;
        $uid = $this->faker->uuid;
        $seqNo = $this->faker->word;
        $type = $this->faker->word;
        $folderId = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;
        $flags = $this->faker->randomNumber;
        $tags = $this->faker->word;
        $path = $this->faker->word;
        $changeBitmask = $this->faker->randomNumber;
        $lastChangeId = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:AdminWaitSetResponse waitSet="$waitSetId" canceled="true" seq="$seqNo">
            <urn:a id="$id" changeid="$lastChangeId">
                <urn1:mods id="$folderId">
                    <urn1:created>
                        <urn1:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
                    </urn1:created>
                    <urn1:deleted id="$id" t="$type" />
                    <urn1:modMsgs change="$changeBitmask">
                        <urn1:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
                    </urn1:modMsgs>
                    <urn1:modTags change="$changeBitmask">
                        <urn1:id>$id</urn1:id>
                        <urn1:name>$name</urn1:name>
                    </urn1:modTags>
                    <urn1:modFolders id="$folderId" path="$path" change="$changeBitmask" />
                </urn1:mods>
            </urn:a>
            <urn:error id="$uid" type="$type" />
        </urn:AdminWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->adminWaitSet(
            $waitSetId, $this->faker->word
        );
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertTrue($response->getCanceled());
        $this->assertSame($seqNo, $response->getSeqNo());

        $msgInfo = new \Zimbra\Mail\Struct\ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $created = new \Zimbra\Mail\Struct\CreateItemNotification($msgInfo);
        $deleted = new \Zimbra\Mail\Struct\DeleteItemNotification($id, $type);
        $modMsg = new \Zimbra\Mail\Struct\ModifyItemNotification($msgInfo, $changeBitmask);
        $modTag = new \Zimbra\Mail\Struct\ModifyTagNotification($id, $name, $changeBitmask);
        $modFolder = new \Zimbra\Mail\Struct\RenameFolderNotification($folderId, $path, $changeBitmask);
        $mod = new \Zimbra\Mail\Struct\PendingFolderModifications($folderId, [$created], [$deleted], [$modMsg], [$modTag], [$modFolder]);
        $account = new \Zimbra\Mail\Struct\AccountWithModifications($id, [$mod], $lastChangeId);
        $error = new \Zimbra\Common\Struct\IdAndType($uid, $type);

        $this->assertEquals([$account], $response->getSignalledAccounts());
        $this->assertEquals([$error], $response->getErrors());
    }

    public function testAuth()
    {
        $authToken = $this->faker->sha256;
        $csrfToken = $this->faker->sha256;
        $lifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AuthResponse>
            <urn:authToken>$authToken</urn:authToken>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:lifetime>$lifetime</urn:lifetime>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->auth();
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($lifetime, $response->getLifetime());
    }

    public function testAutoCompleteGal()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AutoCompleteGalResponse more="true" tokenizeKey="true" paginationSupported="true">
            <urn:cn />
        </urn:AutoCompleteGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->autoCompleteGal($this->faker->domainName, $this->faker->word);
        $this->assertTrue($response->getMore());
        $this->assertTrue($response->getTokenizeKey());
        $this->assertTrue($response->getPagingSupported());
        $this->assertEquals([new \Zimbra\Admin\Struct\ContactInfo()], $response->getContacts());
    }

    public function testAutoProvAccount()
    {
        $name = $this->faker->email;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AutoProvAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:AutoProvAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->autoProvAccount(
            new \Zimbra\Admin\Struct\DomainSelector(), new \Zimbra\Admin\Struct\PrincipalSelector()
        );
        $account = new \Zimbra\Admin\Struct\AccountInfo($name, $id, TRUE, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($account, $response->getAccount());
    }

    public function testAutoProvTaskControl()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AutoProvTaskControlResponse status="started" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->autoProvTaskControl(
            \Zimbra\Common\Enum\AutoProvTaskAction::START()
        );
        $this->assertEquals(\Zimbra\Common\Enum\AutoProvTaskStatus::STARTED(), $response->getStatus());
    }

    public function testChangePrimaryEmail()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ChangePrimaryEmailResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:ChangePrimaryEmailResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->changePrimaryEmail(
            new \Zimbra\Common\Struct\AccountSelector(), $this->faker->email
        );
        $account = new \Zimbra\Admin\Struct\AccountInfo($name, $id, TRUE, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($account, $response->getAccount());
    }

    public function testCheckAuthConfig()
    {
        $code = $this->faker->uuid;
        $bindDn = $this->faker->uuid;
        $message = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckAuthConfigResponse>
            <urn:code>$code</urn:code>
            <urn:bindDn>$bindDn</urn:bindDn>
            <urn:message>$message</urn:message>
        </urn:CheckAuthConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkAuthConfig(
            $this->faker->word, $this->faker->word
        );
        $this->assertSame($code, $response->getCode());
        $this->assertSame($bindDn, $response->getBindDn());
        $this->assertSame($message, $response->getMessage());
    }

    public function testCheckBlobConsistency()
    {
        $id = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;
        $volumeId = $this->faker->randomNumber;
        $blobPath = $this->faker->word;
        $version = $this->faker->randomNumber;
        $path = $this->faker->word;
        $fileSize = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckBlobConsistencyResponse>
            <urn:mbox id ="$id">
                <urn:missingBlobs>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId" blobPath="$blobPath" external="true" version="$version" />
                </urn:missingBlobs>
                <urn:incorrectSizes>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
                        <urn:blob path="$path" s="$size" fileSize="$fileSize" external="true" />
                    </urn:item>
                </urn:incorrectSizes>
                <urn:unexpectedBlobs>
                    <urn:blob volumeId="$volumeId" path="$path" fileSize="$fileSize" external="true" />
                </urn:unexpectedBlobs>
                <urn:incorrectRevisions>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
                        <urn:blob path="$path" fileSize="$fileSize" rev="$revision" external="true" />
                    </urn:item>
                </urn:incorrectRevisions>
                <urn:usedBlobs>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
                        <urn:blob path="$path" s="$size" fileSize="$fileSize" external="true" />
                    </urn:item>
                </urn:usedBlobs>
            </urn:mbox>
        </urn:CheckBlobConsistencyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkBlobConsistency();

        $missingBlobs = [
            new \Zimbra\Admin\Struct\MissingBlobInfo(
                $id, $revision, $size, $volumeId, $blobPath, TRUE, $version
            )
        ];
        $incorrectSizes = [
            new \Zimbra\Admin\Struct\IncorrectBlobSizeInfo(
                $id, $revision, $size, $volumeId, new \Zimbra\Admin\Struct\BlobSizeInfo(
                    $path, $size, $fileSize, TRUE
                )
            )
        ];
        $unexpectedBlobs = [
            new \Zimbra\Admin\Struct\UnexpectedBlobInfo(
                $volumeId, $path, $fileSize, TRUE
            )
        ];
        $incorrectRevisions = [
            new \Zimbra\Admin\Struct\IncorrectBlobRevisionInfo(
                $id, $revision, $size, $volumeId, new \Zimbra\Admin\Struct\BlobRevisionInfo(
                    $path, $fileSize, $revision, TRUE
                )
            )
        ];
        $usedBlobs = [
            new \Zimbra\Admin\Struct\UsedBlobInfo(
                $id, $revision, $size, $volumeId, new \Zimbra\Admin\Struct\BlobSizeInfo(
                    $path, $size, $fileSize, TRUE
                )
            )
        ];
        $mbox = new \Zimbra\Admin\Struct\MailboxBlobConsistency(
            $id, $missingBlobs, $incorrectSizes, $unexpectedBlobs, $incorrectRevisions, $usedBlobs
        );
        $this->assertEquals([$mbox], $response->getMailboxes());
    }

    public function testCheckDirectory()
    {
        $path = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckDirectoryResponse>
            <urn:directory path="$path" exists="true" isDirectory="true" readable="true" writable="true" />
        </urn:CheckDirectoryResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkDirectory();
        $dirInfo = new \Zimbra\Admin\Struct\DirPathInfo($path, TRUE, TRUE, TRUE, TRUE);
        $this->assertEquals([$dirInfo], $response->getPaths());
    }

    public function testCheckDomainMXRecord()
    {
        $entry = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckDomainMXRecordResponse>
            <urn:entry>$entry</urn:entry>
            <urn:code>$code</urn:code>
            <urn:message>$message</urn:message>
        </urn:CheckDomainMXRecordResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkDomainMXRecord();
        $this->assertSame([$entry], $response->getEntries());
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
    }

    public function testCheckExchangeAuth()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckExchangeAuthResponse>
            <urn:code>$code</urn:code>
            <urn:message>$message</urn:message>
        </urn:CheckExchangeAuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkExchangeAuth();
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
    }

    public function testCheckGalConfig()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckGalConfigResponse>
            <urn:code>$code</urn:code>
            <urn:message>$message</urn:message>
            <urn:cn id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:cn>
        </urn:CheckGalConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkGalConfig();
        $cn = new \Zimbra\Admin\Struct\GalContactInfo($id, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
        $this->assertEquals([$cn], $response->getGalContacts());
    }

    public function testCheckHealth()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckHealthResponse healthy="true" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkHealth();
        $this->assertTrue($response->isHealthy());
    }

    public function testCheckHostnameResolve()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckHostnameResolveResponse>
            <urn:code>$code</urn:code>
            <urn:message>$message</urn:message>
        </urn:CheckHostnameResolveResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkHostnameResolve($this->faker->domainName);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
    }

    public function testCheckPasswordStrength()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckPasswordStrengthResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkPasswordStrength($this->faker->uuid, $this->faker->word);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\CheckPasswordStrengthResponse);
    }

    public function testCheckRight()
    {
        $type = $this->faker->word;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckRightResponse allow="true">
            <urn:via>
                <urn:target type="$type">$value</urn:target>
                <urn:grantee type="$type">$value</urn:grantee>
                <urn:right>$value</urn:right>
            </urn:via>
        </urn:CheckRightResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector();
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector();
        $right = new \Zimbra\Admin\Struct\CheckedRight();
        $via = new \Zimbra\Admin\Struct\RightViaInfo(
            new \Zimbra\Admin\Struct\TargetWithType($type, $value),
            new \Zimbra\Admin\Struct\GranteeWithType($type, $value),
            new \Zimbra\Admin\Struct\CheckedRight($value)
        );

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->checkRight($target, $grantee, $right);
        $this->assertTrue($response->getAllow());
        $this->assertEquals($via, $response->getVia());
    }

    public function testClearCookie()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ClearCookieResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->clearCookie();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ClearCookieResponse);
    }

    public function testCompactIndexEnvelope()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CompactIndexResponse status="running" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->compactIndex(new \Zimbra\Admin\Struct\MailboxByAccountIdSelector());
        $this->assertEquals(\Zimbra\Common\Enum\CompactIndexStatus::RUNNING(), $response->getStatus());
    }

    public function testComputeAggregateQuotaUsage()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ComputeAggregateQuotaUsageResponse>
            <urn:domain name="$name" id="$id" used="$quotaUsed" />
        </urn:ComputeAggregateQuotaUsageResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->computeAggregateQuotaUsage();
        $domain = new \Zimbra\Admin\Struct\DomainAggregateQuotaInfo($name, $id, $quotaUsed);
        $this->assertEquals([$domain], $response->getDomainQuotas());
    }

    public function testConfigureZimlet()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ConfigureZimletResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->configureZimlet(new \Zimbra\Admin\Struct\AttachmentIdAttrib());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ConfigureZimletResponse);
    }

    public function testContactBackup()
    {
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ContactBackupResponse>
            <urn:servers>
                <urn:server name="$name" status="stopped" />
            </urn:servers>
        </urn:ContactBackupResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->contactBackup();
        $server = new \Zimbra\Admin\Struct\ContactBackupServer(
            $name, \Zimbra\Common\Enum\ContactBackupStatus::STOPPED()
        );
        $this->assertEquals([$server], $response->getServers());
    }

    public function testCopyCos()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CopyCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:CopyCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->copyCos();
        $cosInfo = new \Zimbra\Admin\Struct\CosInfo($name, $id, TRUE, [
            new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, FALSE)
        ]);
        $this->assertEquals($cosInfo, $response->getCos());
    }

    public function testCountAccount()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CountAccountResponse>
            <urn:cos name="$name" id="$id">$count</urn:cos>
        </urn:CountAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->countAccount(new \Zimbra\Admin\Struct\DomainSelector());
        $cos = new \Zimbra\Admin\Struct\CosCountInfo($name, $id, $count);
        $this->assertEquals([$cos], $response->getCos());
    }

    public function testCountObjects()
    {
        $num = $this->faker->randomNumber;
        $type = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CountObjectsResponse num="$num" type="$type" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->countObjects();
        $this->assertSame($num, $response->getNum());
        $this->assertSame($type, $response->getType());
    }

    public function testCreateAccount()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:CreateAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createAccount($name);
        $account = new \Zimbra\Admin\Struct\AccountInfo($name, $id, TRUE, [
            new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($account, $response->getAccount());
    }

    public function testCreateAlwaysOnCluster()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateAlwaysOnClusterResponse>
            <urn:alwaysOnCluster name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:alwaysOnCluster>
        </urn:CreateAlwaysOnClusterResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createAlwaysOnCluster($name);
        $cluster = new \Zimbra\Admin\Struct\AlwaysOnClusterInfo($name, $id, [
            new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($cluster, $response->getAlwaysOnCluster());
    }

    public function testCreateCalendarResource()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateCalendarResourceResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:CreateCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createCalendarResource($name);
        $calResource = new \Zimbra\Admin\Struct\CalendarResourceInfo($name, $id, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($calResource, $response->getCalResource());
    }

    public function testCreateCos()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="true">$value</urn:a>
            </urn:cos>
        </urn:CreateCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createCos($name);
        $cos = new \Zimbra\Admin\Struct\CosInfo($name, $id, TRUE, [
            new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, TRUE)
        ]);
        $this->assertEquals($cos, $response->getCos());
    }

    public function testCreateDataSource()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateDataSourceResponse>
            <urn:dataSource name="$name" id="$id" type="imap">
                <urn:a n="$key">$value</urn:a>
            </urn:dataSource>
        </urn:CreateDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createDataSource(new \Zimbra\Admin\Struct\DataSourceSpecifier());
        $dsInfo = new \Zimbra\Admin\Struct\DataSourceInfo($name, $id, \Zimbra\Common\Enum\DataSourceType::IMAP(), [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($dsInfo, $response->getDataSource());
    }

    public function testCreateDistributionList()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $member = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateDistributionListResponse>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
        </urn:CreateDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createDistributionList($name);
        $owner = new \Zimbra\Admin\Struct\GranteeInfo(
            $id, $name, \Zimbra\Common\Enum\GranteeType::ALL()
        );
        $dl = new \Zimbra\Admin\Struct\DistributionListInfo($name, $id, [$member], [], [$owner], TRUE);
        $this->assertEquals($dl, $response->getDl());
    }

    public function testCreateDomain()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->domainName;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateDomainResponse>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
        </urn:CreateDomainResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createDomain($name);
        $domain = new \Zimbra\Admin\Struct\DomainInfo($name, $id, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($domain, $response->getDomain());
    }

    public function testCreateGalSyncAccount()
    {
        $name = $this->faker->word;
        $value= $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateGalSyncAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:CreateGalSyncAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createGalSyncAccount(new \Zimbra\Common\Struct\AccountSelector(), $name, $name, $name);
        $account = new \Zimbra\Admin\Struct\AccountInfo($name, $id, TRUE, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($account, $response->getAccount());
    }

    public function testCreateLDAPEntry()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateLDAPEntryResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:CreateLDAPEntryResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createLDAPEntry($name);
        $ldap = new \Zimbra\Admin\Struct\LDAPEntryInfo($name, [new \Zimbra\Admin\Struct\Attr($key, $value)]);
        $this->assertEquals($ldap, $response->getLDAPEntry());
    }

    public function testCreateServer()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateServerResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:CreateServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createServer($name);
        $server = new \Zimbra\Admin\Struct\ServerInfo($name, $id, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($server, $response->getServer());
    }

    public function testCreateSystemRetentionPolicy()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $lifetime = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:CreateSystemRetentionPolicyResponse>
            <urn1:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:CreateSystemRetentionPolicyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createSystemRetentionPolicy();
        $policy = new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime);
        $this->assertEquals($policy, $response->getPolicy());
    }

    public function testCreateUCService()
    {
        $name = $this->faker->word;
        $value= $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateUCServiceResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:CreateUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createUCService($name);
        $ucservice = new \Zimbra\Admin\Struct\UCServiceInfo($name, $id, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($ucservice, $response->getUCService());
    }

    public function testCreateVolume()
    {
        $id = $this->faker->randomNumber;
        $type = $this->faker->randomElement(\Zimbra\Common\Enum\VolumeType::toArray());
        $threshold = $this->faker->randomNumber;
        $mgbits = $this->faker->randomNumber;
        $mbits = $this->faker->randomNumber;
        $fgbits = $this->faker->randomNumber;
        $fbits = $this->faker->randomNumber;
        $name = $this->faker->word;
        $rootPath = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateVolumeResponse>
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" />
        </urn:CreateVolumeResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, $name, $rootPath, $type, TRUE, $threshold, $mgbits, $mbits, $fgbits, $fbits, FALSE
        );
        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createVolume($volume);
        $this->assertEquals($volume, $response->getVolume());
    }

    public function testCreateXMPPComponent()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $domainName = $this->faker->domainName;
        $serverName = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateXMPPComponentResponse>
            <urn:xmppcomponent name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName">
                <urn:a n="$key">$value</urn:a>
            </urn:xmppcomponent>
        </urn:CreateXMPPComponentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createXMPPComponent(new \Zimbra\Admin\Struct\XMPPComponentSpec(
            $name, new \Zimbra\Admin\Struct\DomainSelector(), new \Zimbra\Admin\Struct\ServerSelector()
        ));
        $xmpp = new \Zimbra\Admin\Struct\XMPPComponentInfo($name, $id, $domainName, $serverName, [
            new \Zimbra\Admin\Struct\Attr($key, $value)
        ]);
        $this->assertEquals($xmpp, $response->getComponent());
    }

    public function testCreateZimlet()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $hasKeyword = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateZimletResponse>
            <urn:zimlet name="$name" id="$id" hasKeyword="$hasKeyword">
                <urn:a n="$key">$value</urn:a>
            </urn:zimlet>
        </urn:CreateZimletResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->createZimlet($name);
        $zimlet = new \Zimbra\Admin\Struct\ZimletInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)], $hasKeyword
        );
        $this->assertEquals($zimlet, $response->getZimlet());
    }

    public function testDedupeBlobs()
    {
        $totalSize = $this->faker->randomNumber;
        $totalCount = $this->faker->randomNumber;
        $volumeId = $this->faker->word;
        $progress = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DedupeBlobsResponse status="stopped" totalSize="$totalSize" totalCount="$totalCount">
            <urn:volumeBlobsProgress volumeId="$volumeId" progress="$progress" />
            <urn:blobDigestsProgress volumeId="$volumeId" progress="$progress" />
        </urn:DedupeBlobsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->dedupeBlobs();
        $this->assertEquals(\Zimbra\Common\Enum\DedupStatus::STOPPED(), $response->getStatus());
        $this->assertSame($totalSize, $response->getTotalSize());
        $this->assertSame($totalCount, $response->getTotalCount());

        $progress = new \Zimbra\Admin\Struct\VolumeIdAndProgress($volumeId, $progress);
        $this->assertEquals([$progress], $response->getVolumeBlobsProgress());
        $this->assertEquals([$progress], $response->getBlobDigestsProgress());
    }

    public function testDelegateAuth()
    {
        $authToken = $this->faker->sha256;
        $lifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DelegateAuthResponse>
            <urn:authToken>$authToken</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
        </urn:DelegateAuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->delegateAuth(new \Zimbra\Common\Struct\AccountSelector());
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
    }

    public function testDeleteAccount()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteAccount($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteAccountResponse);
    }

    public function testDeleteAlwaysOnCluster()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteAlwaysOnClusterResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteAlwaysOnCluster($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteAlwaysOnClusterResponse);
    }

    public function testDeleteCalendarResource()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteCalendarResourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteCalendarResource($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteCalendarResourceResponse);
    }

    public function testDeleteCos()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteCosResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteCos($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteCosResponse);
    }

    public function testDeleteDataSource()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteDataSource(new \Zimbra\Common\Struct\Id(), $this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteDataSourceResponse);
    }

    public function testDeleteDistributionList()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteDistributionListResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteDistributionList($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteDistributionListResponse);
    }

    public function testDeleteDomain()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteDomainResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteDomain($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteDomainResponse);
    }

    public function testDeleteGalSyncAccount()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteGalSyncAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteGalSyncAccount(new \Zimbra\Common\Struct\AccountSelector());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteGalSyncAccountResponse);
    }

    public function testDeleteLDAPEntry()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteLDAPEntryResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteLDAPEntry($this->faker->word);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteLDAPEntryResponse);
    }

    public function testDeleteMailbox()
    {
        $id = $this->faker->uuid;
        $mbxid = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteMailboxResponse>
            <urn:mbox mbxid="$mbxid" id="$id" s="$size" />
        </urn:DeleteMailboxResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $mbox = new \Zimbra\Admin\Struct\MailboxWithMailboxId($mbxid, $id, $size);
        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteMailbox();
        $this->assertEquals($mbox, $response->getMbox());
    }

    public function testDeleteServer()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteServerResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteServer($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteServerResponse);
    }

    public function testDeleteSystemRetentionPolicy()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:DeleteSystemRetentionPolicyResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteSystemRetentionPolicy(new \Zimbra\Mail\Struct\Policy());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteSystemRetentionPolicyResponse);
    }

    public function testDeleteUCService()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteUCServiceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteUCService($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteUCServiceResponse);
    }

    public function testDeleteVolume()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteVolumeResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteVolume($this->faker->randomNumber);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteVolumeResponse);
    }

    public function testDeleteXMPPComponent()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteXMPPComponentResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteXMPPComponent();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteXMPPComponentResponse);
    }

    public function testDeleteZimlet()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteZimletResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deleteZimlet(new \Zimbra\Common\Struct\NamedElement());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\DeleteZimletResponse);
    }

    public function testDeployZimlet()
    {
        $server = $this->faker->word;
        $error = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeployZimletResponse>
            <urn:progress server="$server" status="succeeded" error="$error" />
        </urn:DeployZimletResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->deployZimlet(new \Zimbra\Admin\Struct\AttachmentIdAttrib());
        $progress = new \Zimbra\Admin\Struct\ZimletDeploymentStatus(
            $server, \Zimbra\Common\Enum\ZimletDeployStatus::SUCCEEDED(), $error
        );
        $this->assertEquals([$progress], $response->getProgresses());
    }

    public function testDumpSessions()
    {
        $sessionId = $this->faker->uuid;
        $createdDate = $this->faker->unixTime;
        $lastAccessedDate = $this->faker->unixTime;
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $activeAccounts = $this->faker->randomNumber;
        $activeSessions = $this->faker->randomNumber;
        $totalActiveSessions = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DumpSessionsResponse activeSessions="$totalActiveSessions">
            <urn:soap activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:soap>
            <urn:imap activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:imap>
            <urn:admin activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:admin>
            <urn:wiki activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:wiki>
            <urn:synclistener activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:synclistener>
            <urn:waitset activeAccounts="$activeAccounts" activeSessions="$activeSessions">
                <urn:zid name="$name" id="$id">
                    <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
                </urn:zid>
                <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
            </urn:waitset>
        </urn:DumpSessionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $account = new \Zimbra\Admin\Struct\AccountSessionInfo($name, $id, [
            new \Zimbra\Admin\Struct\SessionInfo(
                $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
            )
        ]);
        $session = new \Zimbra\Admin\Struct\InfoForSessionType(
            $activeSessions, $activeAccounts, [$account], [
                new \Zimbra\Admin\Struct\SessionInfo(
                    $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
                )
            ]
        );
        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->dumpSessions();

        $this->assertSame($totalActiveSessions, $response->getTotalActiveSessions());
        $this->assertEquals($session, $response->getSoapSessions());
        $this->assertEquals($session, $response->getImapSessions());
        $this->assertEquals($session, $response->getAdminSessions());
        $this->assertEquals($session, $response->getWikiSessions());
        $this->assertEquals($session, $response->getSynclistenerSessions());
        $this->assertEquals($session, $response->getWaitsetSessions());
    }

    public function testExportAndDeleteItems()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ExportAndDeleteItemsResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->exportAndDeleteItems(new \Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ExportAndDeleteItemsResponse);
    }

    public function testFixCalendarEndTime()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FixCalendarEndTimeResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->fixCalendarEndTime();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\FixCalendarEndTimeResponse);
    }

    public function testFixCalendarPriority()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FixCalendarPriorityResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->fixCalendarPriority();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\FixCalendarPriorityResponse);
    }

    public function testFixCalendarTZ()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FixCalendarTZResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->fixCalendarTZ();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\FixCalendarTZResponse);
    }

    public function testFlushCache()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FlushCacheResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->flushCache();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\FlushCacheResponse);
    }

    public function testGetAccount()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:GetAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAccount(new \Zimbra\Common\Struct\AccountSelector());
        $account = new \Zimbra\Admin\Struct\AccountInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($account, $response->getAccount());
    }

    public function testGetAccountInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $soapURL = $this->faker->word;
        $adminSoapURL = $this->faker->word;
        $publicMailURL = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountInfoResponse>
            <urn:name>$name</urn:name>
            <urn:a n="$key">$value</urn:a>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="true">$value</urn:a>
            </urn:cos>
            <urn:soapURL>$soapURL</urn:soapURL>
            <urn:adminSoapURL>$adminSoapURL</urn:adminSoapURL>
            <urn:publicMailURL>$publicMailURL</urn:publicMailURL>
        </urn:GetAccountInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAccountInfo(new \Zimbra\Common\Struct\AccountSelector());

        $attr = new \Zimbra\Admin\Struct\Attr($key, $value);
        $cos = new \Zimbra\Admin\Struct\CosInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, TRUE)]
        );

        $this->assertSame($name, $response->getName());
        $this->assertEquals([$attr], $response->getAttrList());
        $this->assertEquals($cos, $response->getCos());
        $this->assertSame([$soapURL], $response->getSoapURLList());
        $this->assertSame($adminSoapURL, $response->getAdminSoapURL());
        $this->assertSame($publicMailURL, $response->getPublicMailURL());
    }

    public function testGetAccountLoggers()
    {
        $category = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountLoggersResponse>
            <urn:logger category="$category" level="info" />
        </urn:GetAccountLoggersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAccountLoggers();
        $logger = new \Zimbra\Admin\Struct\LoggerInfo(
            $category, \Zimbra\Common\Enum\LoggingLevel::INFO()
        );
        $this->assertEquals([$logger], $response->getLoggers());
    }

    public function testGetAccountMembership()
    {
        $via = $this->faker->email;
        $name = $this->faker->email;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAccountMembershipResponse>
            <urn:dl name="$name" id="$id" dynamic="true" via="$via">
                <urn:a n="$key">$value</urn:a>
            </urn:dl>
        </urn:GetAccountMembershipResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAccountMembership(new \Zimbra\Common\Struct\AccountSelector());
        $dl = new \Zimbra\Admin\Struct\DLInfo(
            $via, $name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$dl], $response->getDlList());
    }

    public function testGetAdminConsoleUIComp()
    {
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAdminConsoleUICompResponse>
            <urn:a inherited="true">$value</urn:a>
        </urn:GetAdminConsoleUICompResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAdminConsoleUIComp();
        $val = new \Zimbra\Admin\Struct\InheritedFlaggedValue(TRUE, $value);
        $this->assertEquals([$val], $response->getValues());
    }

    public function testGetAdminExtensionZimlets()
    {
        $baseUrl = $this->faker->word;
        $priority = $this->faker->randomNumber;
        $name = $this->faker->word;
        $version = $this->faker->word;
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $value = $this->faker->word;
        $hasKeyword = $this->faker->word;
        $extensionClass = $this->faker->word;
        $regex = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAdminExtensionZimletsResponse>
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
        </urn:GetAdminExtensionZimletsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAdminExtensionZimlets();

        $zimletContext = new \Zimbra\Admin\Struct\AdminZimletContext(
            $baseUrl, \Zimbra\Common\Enum\ZimletPresence::ENABLED(), $priority
        );
        $serverExtension = new \Zimbra\Admin\Struct\ZimletServerExtension(
            $hasKeyword, $extensionClass, $regex
        );
        $include = new \Zimbra\Admin\Struct\AdminZimletInclude($value);
        $includeCSS = new \Zimbra\Admin\Struct\AdminZimletIncludeCSS($value);
        $zimletDesc = new \Zimbra\Admin\Struct\AdminZimletDesc(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletDesc->setServerExtension($serverExtension)
            ->setZimletInclude($include)
            ->setZimletIncludeCSS($includeCSS);
        $property = new \Zimbra\Admin\Struct\AdminZimletProperty($name, $value);
        $global = new \Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo([$property]);
        $host = new \Zimbra\Admin\Struct\AdminZimletHostConfigInfo($name, [$property]);
        $zimletConfig = new \Zimbra\Admin\Struct\AdminZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletConfig->setGlobal($global)
            ->setHost($host);
        $zimlet = new \Zimbra\Admin\Struct\AdminZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );

        $this->assertEquals([$zimlet], $response->getZimlets());
    }

    public function testGetAdminSavedSearches()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAdminSavedSearchesResponse>
            <urn:search name="$name">$value</urn:search>
        </urn:GetAdminSavedSearchesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAdminSavedSearches();
        $search = new \Zimbra\Common\Struct\NamedValue($name, $value);
        $this->assertEquals([$search], $response->getSearches());
    }

    public function testGetAggregateQuotaUsageOnServer()
    {
        $name = $this->faker->domainName;
        $id = $this->faker->uuid;
        $quotaUsed = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAggregateQuotaUsageOnServerResponse>
            <urn:domain name="$name" id="$id" used="$quotaUsed" />
        </urn:GetAggregateQuotaUsageOnServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAggregateQuotaUsageOnServer();
        $domain = new \Zimbra\Admin\Struct\DomainAggregateQuotaInfo($name, $id, $quotaUsed);
        $this->assertEquals([$domain], $response->getDomainQuotas());
    }

    public function testGetAllAccountLoggers()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $category = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAccountLoggersResponse>
            <urn:accountLogger name="$name" id="$id">
                <urn:logger category="$category" level="info" />
            </urn:accountLogger>
        </urn:GetAllAccountLoggersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllAccountLoggers();
        $logger = new \Zimbra\Admin\Struct\AccountLoggerInfo(
            $name, $id, [
                new \Zimbra\Admin\Struct\LoggerInfo($category, \Zimbra\Common\Enum\LoggingLevel::INFO())
            ]
        );
        $this->assertEquals([$logger], $response->getLoggers());
    }

    public function testGetAllAccounts()
    {
        $name = $this->faker->email;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAccountsResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:GetAllAccountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllAccounts();
        $account = new \Zimbra\Admin\Struct\AccountInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$account], $response->getAccountList());
    }

    public function testGetAllActiveServers()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllActiveServersResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:GetAllActiveServersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllActiveServers();
        $server = new \Zimbra\Admin\Struct\ServerInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$server], $response->getServerList());
    }

    public function testGetAllAdminAccounts()
    {
        $name = $this->faker->email;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAdminAccountsResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:GetAllAdminAccountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllAdminAccounts();
        $account = new \Zimbra\Admin\Struct\AccountInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$account], $response->getAccountList());
    }

    public function testGetAllAlwaysOnClusters()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllAlwaysOnClustersResponse>
            <urn:alwaysOnCluster name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:alwaysOnCluster>
        </urn:GetAllAlwaysOnClustersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllAlwaysOnClusters();
        $cluster = new \Zimbra\Admin\Struct\AlwaysOnClusterInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$cluster], $response->getAlwaysOnClusterList());
    }

    public function testGetAllCalendarResources()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllCalendarResourcesResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:GetAllCalendarResourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllCalendarResources();
        $resource = new \Zimbra\Admin\Struct\CalendarResourceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$resource], $response->getCalendarResourceList());
    }

    public function testGetAllConfig()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllConfigResponse>
            <urn:a n="$key">$value</urn:a>
        </urn:GetAllConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllConfig();
        $attr = new \Zimbra\Admin\Struct\Attr($key, $value);
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testGetAllCos()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:GetAllCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllCos();
        $cos = new \Zimbra\Admin\Struct\CosInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, FALSE)]
        );
        $this->assertEquals([$cos], $response->getCosList());
    }

    public function testGetAllDistributionLists()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllDistributionListsResponse>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:a n="$key">$value</urn:a>
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
        </urn:GetAllDistributionListsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllDistributionLists();
        $attr = new \Zimbra\Admin\Struct\Attr($key, $value);
        $owner = new \Zimbra\Admin\Struct\GranteeInfo(
            $id, $name, \Zimbra\Common\Enum\GranteeType::ALL()
        );
        $dl = new \Zimbra\Admin\Struct\DistributionListInfo($name, $id, [$member], [$attr], [$owner], TRUE);
        $this->assertEquals([$dl], $response->getDls());
    }

    public function testGetAllDomains()
    {
        $name = $this->faker->domainName;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllDomainsResponse>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
        </urn:GetAllDomainsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllDomains();
        $domain = new \Zimbra\Admin\Struct\DomainInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$domain], $response->getDomainList());
    }

    public function testGetAllEffectiveRights()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $value1 = $this->faker->unique->word;
        $value2 = $this->faker->unique->word;
        $min = $this->faker->word;
        $max = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllEffectiveRightsResponse>
            <urn:grantee id="$id" name="$name" type="all" />
            <urn:target type="account">
                <urn:all>
                    <urn:right n="$name" />
                    <urn:setAttrs all="true">
                        <urn:a n="$name">
                            <urn:constraint>
                                <urn:min>$min</urn:min>
                                <urn:max>$max</urn:max>
                                <urn:values>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:values>
                            </urn:constraint>
                            <urn:default>
                                <urn:v>$value1</urn:v>
                                <urn:v>$value2</urn:v>
                            </urn:default>
                        </urn:a>
                    </urn:setAttrs>
                    <urn:getAttrs all="false">
                        <urn:a n="$name">
                            <urn:constraint>
                                <urn:min>$min</urn:min>
                                <urn:max>$max</urn:max>
                                <urn:values>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:values>
                            </urn:constraint>
                            <urn:default>
                                <urn:v>$value1</urn:v>
                                <urn:v>$value2</urn:v>
                            </urn:default>
                        </urn:a>
                    </urn:getAttrs>
                </urn:all>
                <urn:inDomains>
                    <urn:domain name="$name" />
                    <urn:rights>
                        <urn:right n="$name" />
                        <urn:setAttrs all="true">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:default>
                            </urn:a>
                        </urn:setAttrs>
                        <urn:getAttrs all="false">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:default>
                            </urn:a>
                        </urn:getAttrs>
                    </urn:rights>
                </urn:inDomains>
                <urn:entries>
                    <urn:entry name="$name" />
                    <urn:rights>
                        <urn:right n="$name" />
                        <urn:setAttrs all="true">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:default>
                            </urn:a>
                        </urn:setAttrs>
                        <urn:getAttrs all="false">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:default>
                            </urn:a>
                        </urn:getAttrs>
                    </urn:rights>
                </urn:entries>
            </urn:target>
        </urn:GetAllEffectiveRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $granteeInfo = new \Zimbra\Admin\Struct\GranteeInfo(
            $id, $name, \Zimbra\Common\Enum\GranteeType::ALL()
        );

        $right = new \Zimbra\Admin\Struct\RightWithName($name);
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new \Zimbra\Admin\Struct\EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new \Zimbra\Admin\Struct\EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new \Zimbra\Admin\Struct\EffectiveAttrsInfo(FALSE, [$attr]);
        $rights = new \Zimbra\Admin\Struct\EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);

        $domain = new \Zimbra\Common\Struct\NamedElement($name);
        $entry = new \Zimbra\Common\Struct\NamedElement($name);
        $inDomains = new \Zimbra\Admin\Struct\InDomainInfo($rights, [$domain]);
        $entries = new \Zimbra\Admin\Struct\RightsEntriesInfo($rights, [$entry]);

        $target = new \Zimbra\Admin\Struct\EffectiveRightsTarget(
            \Zimbra\Common\Enum\TargetType::ACCOUNT(), $rights, [$inDomains], [$entries]
        );

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllEffectiveRights();
        $this->assertEquals($granteeInfo, $response->getGrantee());
        $this->assertEquals([$target], $response->getTargets());
    }

    public function testGetAllFreeBusyProviders()
    {
        $name = $this->faker->word;
        $start = $this->faker->randomNumber;
        $end = $this->faker->randomNumber;
        $queue = $this->faker->word;
        $prefix = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllFreeBusyProvidersResponse>
            <urn:provider name="$name" propagate="true" start="$start" end="$end" queue="$queue" prefix="$prefix" />
        </urn:GetAllFreeBusyProvidersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllFreeBusyProviders();
        $provider = new \Zimbra\Admin\Struct\FreeBusyProviderInfo(
            $name, TRUE, $start, $end, $queue, $prefix
        );
        $this->assertEquals([$provider], $response->getProviders());
    }

    public function testGetAllLocales()
    {
        $id = $this->faker->word;
        $name = $this->faker->locale;
        $localName = $this->faker->countryCode;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllLocalesResponse>
            <urn:locale id="$id" name="$name" localName="$localName" />
        </urn:GetAllLocalesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllLocales();
        $locale = new \Zimbra\Admin\Struct\LocaleInfo($id, $name, $localName);
        $this->assertEquals([$locale], $response->getLocales());
    }

    public function testGetAllMailboxes()
    {
        $id = $this->faker->randomNumber;
        $groupId = $this->faker->randomNumber;
        $accountId = $this->faker->uuid;
        $indexVolumeId = $this->faker->randomNumber;
        $itemIdCheckPoint = $this->faker->randomNumber;
        $contactCount = $this->faker->randomNumber;
        $sizeCheckPoint = $this->faker->randomNumber;
        $changeCheckPoint = $this->faker->randomNumber;
        $trackingSync = $this->faker->randomNumber;
        $lastBackupAt = $this->faker->randomNumber;
        $lastSoapAccess = $this->faker->randomNumber;
        $newMessages = $this->faker->randomNumber;
        $searchTotal = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllMailboxesResponse more="true" searchTotal="$searchTotal">
            <urn:mbox id="$id" groupId="$groupId" accountId="$accountId" indexVolumeId="$indexVolumeId" itemIdCheckPoint="$itemIdCheckPoint" contactCount="$contactCount" sizeCheckPoint="$sizeCheckPoint" changeCheckPoint="$changeCheckPoint" trackingSync="$trackingSync" trackingImap="true" lastBackupAt="$lastBackupAt" lastSoapAccess="$lastSoapAccess" newMessages="$newMessages" />
        </urn:GetAllMailboxesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllMailboxes();
        $mbox = new \Zimbra\Admin\Struct\MailboxInfo(
            $id, $groupId, $accountId, $indexVolumeId, $itemIdCheckPoint,
            $contactCount, $sizeCheckPoint, $changeCheckPoint, $trackingSync, TRUE,
            $lastBackupAt, $lastSoapAccess, $newMessages
        );
        $this->assertTrue($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertEquals([$mbox], $response->getMboxes());
    }

    public function testGetAllRights()
    {
        $name = $this->faker->word;
        $targetType = $this->faker->word;
        $desc = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllRightsResponse>
            <urn:right name="$name" type="preset" targetType="$targetType" rightClass="ALL">
                <urn:desc>$desc</urn:desc>
                <urn:attrs all="true">
                    <urn:a n="$key">$value</urn:a>
                </urn:attrs>
                <urn:rights>
                    <urn:r n="$name" type="preset" targetType="$targetType" />
                </urn:rights>
            </urn:right>
        </urn:GetAllRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllRights();
        $attrs = new \Zimbra\Admin\Struct\RightsAttrs(TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]);
        $rights = new \Zimbra\Admin\Struct\ComboRights([new \Zimbra\Admin\Struct\ComboRightInfo(
            $name, \Zimbra\Common\Enum\RightType::PRESET(), $targetType
        )]);
        $right = new \Zimbra\Admin\Struct\RightInfo(
            $name, \Zimbra\Common\Enum\RightType::PRESET(),
            \Zimbra\Common\Enum\RightClass::ALL(), $desc, $targetType, $attrs, $rights
        );
        $this->assertEquals([$right], $response->getRights());
    }

    public function testGetAllServers()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllServersResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:GetAllServersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllServers();
        $server = new \Zimbra\Admin\Struct\ServerInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$server], $response->getServerList());
    }

    public function testGetAllSkins()
    {
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllSkinsResponse>
            <urn:skin name="$name" />
        </urn:GetAllSkinsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllSkins();
        $skin = new \Zimbra\Common\Struct\NamedElement($name);
        $this->assertEquals([$skin], $response->getSkins());
    }

    public function testGetAllUCServices()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllUCServicesResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:GetAllUCServicesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllUCServices();
        $ucservice = new \Zimbra\Admin\Struct\UCServiceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$ucservice], $response->getUCServiceList());
    }

    public function testGetAllVolumes()
    {
        $id = $this->faker->randomNumber;
        $type = $this->faker->randomElement(\Zimbra\Common\Enum\VolumeType::toArray());
        $threshold = $this->faker->randomNumber;
        $mgbits = $this->faker->randomNumber;
        $mbits = $this->faker->randomNumber;
        $fgbits = $this->faker->randomNumber;
        $fbits = $this->faker->randomNumber;
        $name = $this->faker->word;
        $rootPath = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllVolumesResponse>
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="false" />
        </urn:GetAllVolumesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllVolumes();
        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, $name, $rootPath, $type, TRUE, $threshold, $mgbits, $mbits, $fgbits, $fbits, FALSE
        );
        $this->assertEquals([$volume], $response->getVolumes());
    }

    public function testGetAllXMPPComponents()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $domainName = $this->faker->word;
        $serverName = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllXMPPComponentsResponse>
            <urn:xmppcomponent name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName">
                <urn:a n="$key">$value</urn:a>
            </urn:xmppcomponent>
        </urn:GetAllXMPPComponentsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllXMPPComponents();
        $xmpp = new \Zimbra\Admin\Struct\XMPPComponentInfo(
            $name, $id, $domainName, $serverName, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$xmpp], $response->getComponents());
    }

    public function testGetAllZimlets()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $hasKeyword = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllZimletsResponse>
            <urn:zimlet name="$name" id="$id" hasKeyword="$hasKeyword">
                <urn:a n="$key">$value</urn:a>
            </urn:zimlet>
        </urn:GetAllZimletsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAllZimlets();
        $zimlet = new \Zimbra\Admin\Struct\ZimletInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)], $hasKeyword
        );
        $this->assertEquals([$zimlet], $response->getZimlets());
    }

    public function testGetAlwaysOnCluster()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAlwaysOnClusterResponse>
            <urn:alwaysOnCluster name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:alwaysOnCluster>
        </urn:GetAlwaysOnClusterResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAlwaysOnCluster();
        $clusterInfo = new \Zimbra\Admin\Struct\AlwaysOnClusterInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($clusterInfo, $response->getAlwaysOnCluster());
    }

    public function testGetAttributeInfo()
    {
        $name = $this->faker->word;
        $description = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAttributeInfoResponse>
            <urn:a n="$name" desc="$description" />
        </urn:GetAttributeInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getAttributeInfo();
        $attr = new \Zimbra\Admin\Struct\AttributeDescription($name, $description);
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testGetCalendarResource()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCalendarResourceResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:GetCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getCalendarResource();
        $calResource = new \Zimbra\Admin\Struct\CalendarResourceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($calResource, $response->getCalResource());
    }

    public function testGetConfig()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetConfigResponse>
            <urn:a n="$key">$value</urn:a>
        </urn:GetConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $attr = new \Zimbra\Admin\Struct\Attr($key, $value);
        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getConfig($attr);
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testGetCos()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:GetCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getCos(new \Zimbra\Admin\Struct\CosSelector());
        $cosInfo = new \Zimbra\Admin\Struct\CosInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, FALSE)]
        );
        $this->assertEquals($cosInfo, $response->getCos());
    }

    public function testGetCreateObjectAttrs()
    {
        $type = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $value1 = $this->faker->unique->word;
        $value2 = $this->faker->unique->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCreateObjectAttrsResponse>
            <urn:setAttrs all="true">
                <urn:a n="$name">
                    <urn:constraint>
                        <urn:min>$min</urn:min>
                        <urn:max>$max</urn:max>
                        <urn:values>
                            <urn:v>$value1</urn:v>
                            <urn:v>$value2</urn:v>
                        </urn:values>
                    </urn:constraint>
                    <urn:default>
                        <urn:v>$value1</urn:v>
                        <urn:v>$value2</urn:v>
                    </urn:default>
                </urn:a>
            </urn:setAttrs>
        </urn:GetCreateObjectAttrsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getCreateObjectAttrs(new \Zimbra\Admin\Struct\TargetWithType());

        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new \Zimbra\Admin\Struct\EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new \Zimbra\Admin\Struct\EffectiveAttrsInfo(TRUE, [$attr]);
        $this->assertEquals($setAttrs, $response->getSetAttrs());
    }

    public function testGetCurrentVolumes()
    {
        $type = $this->faker->randomNumber;
        $id = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCurrentVolumesResponse>
            <urn:volume type="$type" id="$id" />
        </urn:GetCurrentVolumesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getCurrentVolumes();
        $volume = new \Zimbra\Admin\Struct\CurrentVolumeInfo($type, $id);
        $this->assertEquals([$volume], $response->getVolumes());
    }

    public function testGetDataSources()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDataSourcesResponse>
            <urn:dataSource name="$name" id="$id" type="pop3">
                <urn:a n="$key">$value</urn:a>
            </urn:dataSource>
        </urn:GetDataSourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getDataSources($id);
        $dataSource = new \Zimbra\Admin\Struct\DataSourceInfo(
            $name, $id, \Zimbra\Common\Enum\DataSourceType::POP3(), [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$dataSource], $response->getDataSources());
    }

    public function testGetDelegatedAdminConstraints()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDelegatedAdminConstraintsResponse>
            <urn:a name="$name">
                <urn:constraint>
                    <urn:min>$min</urn:min>
                    <urn:max>$max</urn:max>
                    <urn:values>
                        <urn:v>$value</urn:v>
                    </urn:values>
                </urn:constraint>
            </urn:a>
        </urn:GetDelegatedAdminConstraintsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getDelegatedAdminConstraints(\Zimbra\Common\Enum\TargetType::ACCOUNT());
        $attr = new \Zimbra\Admin\Struct\ConstraintAttr(
            new \Zimbra\Admin\Struct\ConstraintInfo($min, $max, [$value]), $name
        );
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testGetDistributionList()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $value = $this->faker->word;
        $member = $this->faker->email;
        $total = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDistributionListResponse more="true" total="$total">
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
        </urn:GetDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getDistributionList(new \Zimbra\Admin\Struct\DistributionListSelector());
        $owner = new \Zimbra\Admin\Struct\GranteeInfo(
            $id, $name, \Zimbra\Common\Enum\GranteeType::ALL()
        );
        $dl = new \Zimbra\Admin\Struct\DistributionListInfo(
            $name, $id, [$member], [], [$owner], TRUE
        );
        $this->assertEquals($dl, $response->getDl());
        $this->assertTrue($response->isMore());
        $this->assertSame($total, $response->getTotal());
    }

    public function testGetDistributionListMembership()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $value = $this->faker->word;
        $via = $this->faker->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDistributionListMembershipResponse>
            <urn:dl id="$id" name="$name" via="$via" />
        </urn:GetDistributionListMembershipResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getDistributionListMembership(new \Zimbra\Admin\Struct\DistributionListSelector());
        $dl = new \Zimbra\Admin\Struct\DistributionListMembershipInfo($id, $name, $via);
        $this->assertEquals([$dl], $response->getDls());
    }

    public function testGetDomain()
    {
        $name = $this->faker->domainName;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDomainResponse>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
        </urn:GetDomainResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getDomain(new \Zimbra\Admin\Struct\DomainSelector());
        $domain = new \Zimbra\Admin\Struct\DomainInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($domain, $response->getDomain());
    }

    public function testGetDomainInfo()
    {
        $name = $this->faker->domainName;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDomainInfoResponse>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
        </urn:GetDomainInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getDomainInfo(new \Zimbra\Admin\Struct\DomainSelector());
        $domain = new \Zimbra\Admin\Struct\DomainInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($domain, $response->getDomain());
    }

    public function testGetEffectiveRights()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $value1 = $this->faker->unique->word;
        $value2 = $this->faker->unique->word;
        $min = $this->faker->word;
        $max = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetEffectiveRightsResponse>
            <urn:grantee id="$id" name="$name" type="all" />
            <urn:target type="account" id="$id" name="$name">
                <urn:right n="$name" />
                <urn:setAttrs all="true">
                    <urn:a n="$name">
                        <urn:constraint>
                            <urn:min>$min</urn:min>
                            <urn:max>$max</urn:max>
                            <urn:values>
                                <urn:v>$value1</urn:v>
                                <urn:v>$value2</urn:v>
                            </urn:values>
                        </urn:constraint>
                        <urn:default>
                            <urn:v>$value1</urn:v>
                            <urn:v>$value2</urn:v>
                        </urn:default>
                    </urn:a>
                </urn:setAttrs>
                <urn:getAttrs all="false">
                    <urn:a n="$name">
                        <urn:constraint>
                            <urn:min>$min</urn:min>
                            <urn:max>$max</urn:max>
                            <urn:values>
                                <urn:v>$value1</urn:v>
                                <urn:v>$value2</urn:v>
                            </urn:values>
                        </urn:constraint>
                        <urn:default>
                            <urn:v>$value1</urn:v>
                            <urn:v>$value2</urn:v>
                        </urn:default>
                    </urn:a>
                </urn:getAttrs>
            </urn:target>
        </urn:GetEffectiveRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getEffectiveRights(new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector());

        $granteeInfo = new \Zimbra\Admin\Struct\GranteeInfo(
            $id, $name, \Zimbra\Common\Enum\GranteeType::ALL()
        );

        $right = new \Zimbra\Admin\Struct\RightWithName($name);
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new \Zimbra\Admin\Struct\EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new \Zimbra\Admin\Struct\EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new \Zimbra\Admin\Struct\EffectiveAttrsInfo(FALSE, [$attr]);
        $rights = new \Zimbra\Admin\Struct\EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);

        $inDomains = new \Zimbra\Admin\Struct\InDomainInfo($rights, [new \Zimbra\Common\Struct\NamedElement($name)]);
        $entries = new \Zimbra\Admin\Struct\RightsEntriesInfo($rights, [new \Zimbra\Common\Struct\NamedElement($name)]);

        $targetInfo = new \Zimbra\Admin\Struct\EffectiveRightsTargetInfo(
            \Zimbra\Common\Enum\TargetType::ACCOUNT(), $id, $name, $setAttrs, $getAttrs, [$right]
        );

        $this->assertEquals($granteeInfo, $response->getGrantee());
        $this->assertEquals($targetInfo, $response->getTarget());
    }

    public function testGetFilterRules()
    {
        $type = \Zimbra\Common\Enum\AdminFilterType::BEFORE();
        $index = $this->faker->randomNumber;
        $header = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $time = $this->faker->time;
        $date = $this->faker->unixTime;
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = $this->faker->randomNumber;
        $origHeaders = $this->faker->word;
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:GetFilterRulesResponse type="$type">
            <urn:account by="name">$value</urn:account>
            <urn:domain by="name">$value</urn:domain>
            <urn:cos by="name">$value</urn:cos>
            <urn:server by="name">$value</urn:server>
            <urn:filterRules>
                <urn1:filterRule name="$name" active="true">
                    <urn1:filterVariables index="$index">
                        <urn1:filterVariable name="$name" value="$value" />
                    </urn1:filterVariables>
                    <urn1:filterTests condition="allof">
                        <urn1:addressBookTest index="$index" negative="true" header="$header" />
                        <urn1:addressTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" />
                        <urn1:envelopeTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" />
                        <urn1:attachmentTest index="$index" negative="true" />
                        <urn1:bodyTest index="$index" negative="true" value="$value" caseSensitive="true" />
                        <urn1:bulkTest index="$index" negative="true" />
                        <urn1:contactRankingTest index="$index" negative="true" header="$header" />
                        <urn1:conversationTest index="$index" negative="true" where="$where" />
                        <urn1:currentDayOfWeekTest index="$index" negative="true" value="$value" />
                        <urn1:currentTimeTest index="$index" negative="true" dateComparison="before" time="$time" />
                        <urn1:dateTest index="$index" negative="true" dateComparison="before" date="$date" />
                        <urn1:facebookTest index="$index" negative="true" />
                        <urn1:flaggedTest index="$index" negative="true" flagName="$flag" />
                        <urn1:headerExistsTest index="$index" negative="true" header="$header" />
                        <urn1:headerTest index="$index" negative="true" header="$header" stringComparison="is" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" value="$value" caseSensitive="true" />
                        <urn1:importanceTest index="$index" negative="true" imp="high" />
                        <urn1:inviteTest index="$index" negative="true">
                            <urn1:method>$method</urn1:method>
                        </urn1:inviteTest>
                        <urn1:linkedinTest index="$index" negative="true" />
                        <urn1:listTest index="$index" negative="true" />
                        <urn1:meTest index="$index" negative="true" header="$header" />
                        <urn1:mimeHeaderTest index="$index" negative="true" header="$header" stringComparison="is" value="$value" caseSensitive="true" />
                        <urn1:sizeTest index="$index" negative="true" numberComparison="over" s="$size" />
                        <urn1:socialcastTest index="$index" negative="true" />
                        <urn1:trueTest index="$index" negative="true" />
                        <urn1:twitterTest index="$index" negative="true" />
                        <urn1:communityRequestsTest index="$index" negative="true" />
                        <urn1:communityContentTest index="$index" negative="true" />
                        <urn1:communityConnectionsTest index="$index" negative="true" />
                    </urn1:filterTests>
                    <urn1:filterActions>
                        <urn1:filterVariables index="$index">
                            <urn1:filterVariable name="$name" value="$value" />
                        </urn1:filterVariables>
                        <urn1:actionKeep index="$index" />
                        <urn1:actionDiscard index="$index" />
                        <urn1:actionFileInto index="$index" folderPath="$folder" copy="true" />
                        <urn1:actionFlag index="$index" flagName="$flag" />
                        <urn1:actionTag index="$index" tagName="$tag" />
                        <urn1:actionRedirect index="$index" a="$address" copy="true" />
                        <urn1:actionReply index="$index">
                            <urn1:content>$content</urn1:content>
                        </urn1:actionReply>
                        <urn1:actionNotify index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders">
                            <urn1:content>$content</urn1:content>
                        </urn1:actionNotify>
                        <urn1:actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
                            <urn1:method>$method</urn1:method>
                        </urn1:actionRFCCompliantNotify>
                        <urn1:actionStop index="$index" />
                        <urn1:actionReject index="$index">$content</urn1:actionReject>
                        <urn1:actionEreject index="$index">$content</urn1:actionEreject>
                        <urn1:actionLog index="$index" level="info">$content</urn1:actionLog>
                        <urn1:actionAddheader index="$index" last="true">
                            <urn1:headerName>$headerName</urn1:headerName>
                            <urn1:headerValue>$headerValue</urn1:headerValue>
                        </urn1:actionAddheader>
                        <urn1:actionDeleteheader index="$index" last="true" offset="$offset">
                            <urn1:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn1:headerName>$headerName</urn1:headerName>
                                <urn1:headerValue>$headerValue</urn1:headerValue>
                            </urn1:test>
                        </urn1:actionDeleteheader>
                        <urn1:actionReplaceheader index="$index" last="true" offset="$offset">
                            <urn1:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn1:headerName>$headerName</urn1:headerName>
                                <urn1:headerValue>$headerValue</urn1:headerValue>
                            </urn1:test>
                            <urn1:newName>$newName</urn1:newName>
                            <urn1:newValue>$newValue</urn1:newValue>
                        </urn1:actionReplaceheader>
                    </urn1:filterActions>
                    <urn1:nestedRule>
                        <urn1:filterTests condition="allof" />
                    </urn1:nestedRule>
                </urn1:filterRule>
            </urn:filterRules>
        </urn:GetFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $account = new \Zimbra\Common\Struct\AccountSelector(\Zimbra\Common\Enum\AccountBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(\Zimbra\Common\Enum\DomainBy::NAME(), $value);
        $cos = new \Zimbra\Admin\Struct\CosSelector(\Zimbra\Common\Enum\CosBy::NAME(), $value);
        $server = new \Zimbra\Admin\Struct\ServerSelector(\Zimbra\Common\Enum\ServerBy::NAME(), $value);

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getFilterRules($type, $account, $domain, $cos, $server);

        $this->assertEquals($type, $response->getType());
        $this->assertEquals($account, $response->getAccount());
        $this->assertEquals($domain, $response->getDomain());
        $this->assertEquals($cos, $response->getCos());
        $this->assertEquals($server, $response->getServer());

        $filterVariables = new \Zimbra\Mail\Struct\FilterVariables($index, [new \Zimbra\Mail\Struct\FilterVariable($name, $value)]);
        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            $index, TRUE, $header
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $envelopeTest = new \Zimbra\Mail\Struct\EnvelopeTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            $index, TRUE
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            $index, TRUE, $value, TRUE
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            $index, TRUE
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            $index, TRUE, $header
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            $index, TRUE, $where
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            $index, TRUE, $value
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $time
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $date
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            $index, TRUE
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            $index, TRUE, $flag
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            $index, TRUE, $header
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $value, TRUE
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            $index, TRUE, \Zimbra\Common\Enum\Importance::HIGH()
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            $index, TRUE, [$method]
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            $index, TRUE
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            $index, TRUE
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            $index, TRUE, $header
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), $value, TRUE
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            $index, TRUE, \Zimbra\Common\Enum\NumberComparison::OVER(), $size
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            $index, TRUE
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            $index, TRUE
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            $index, TRUE
        );
        $communityRequestsTest = new \Zimbra\Mail\Struct\CommunityRequestsTest(
            $index, TRUE
        );
        $communityContentTest = new \Zimbra\Mail\Struct\CommunityContentTest(
            $index, TRUE
        );
        $communityConnectionsTest = new \Zimbra\Mail\Struct\CommunityConnectionsTest(
            $index, TRUE
        );
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            \Zimbra\Common\Enum\FilterCondition::ALL_OF(), [
                $addressBookTest,
                $addressTest,
                $envelopeTest,
                $attachmentTest,
                $bodyTest,
                $bulkTest,
                $contactRankingTest,
                $conversationTest,
                $currentDayOfWeekTest,
                $currentTimeTest,
                $dateTest,
                $facebookTest,
                $flaggedTest,
                $headerExistsTest,
                $headerTest,
                $importanceTest,
                $inviteTest,
                $linkedinTest,
                $listTest,
                $meTest,
                $mimeHeaderTest,
                $sizeTest,
                $socialcastTest,
                $trueTest,
                $twitterTest,
                $communityRequestsTest,
                $communityContentTest,
                $communityConnectionsTest,
            ]
        );
        $actionKeep = new \Zimbra\Mail\Struct\KeepAction($index);
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction($index);
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction($index, $folder, TRUE);
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction($index, $flag);
        $actionTag = new \Zimbra\Mail\Struct\TagAction($index, $tag, TRUE);
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction($index, $address, TRUE);
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction($index, $content, TRUE);
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $actionRFCCompliantNotify = new \Zimbra\Mail\Struct\RFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $actionStop = new \Zimbra\Mail\Struct\StopAction($index);
        $actionReject = new \Zimbra\Mail\Struct\RejectAction($index, $content);
        $actionEreject = new \Zimbra\Mail\Struct\ErejectAction($index, $content);
        $actionLog = new \Zimbra\Mail\Struct\LogAction($index, \Zimbra\Common\Enum\LoggingLevel::INFO(), $content);
        $actionAddheader = new \Zimbra\Mail\Struct\AddheaderAction($index, $headerName, $headerValue, TRUE);
        $actionDeleteheader = new \Zimbra\Mail\Struct\DeleteheaderAction(
            $index, TRUE, $offset
            , new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue])
        );
        $actionReplaceheader = new \Zimbra\Mail\Struct\ReplaceheaderAction(
            $index, TRUE, $offset,
            new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue]),
            $newName, $newValue
        );
        $child = new \Zimbra\Mail\Struct\NestedRule(new \Zimbra\Mail\Struct\FilterTests(\Zimbra\Common\Enum\FilterCondition::ALL_OF()));
        $filterRule = new \Zimbra\Mail\Struct\FilterRule($filterTests, $name, TRUE, $filterVariables, [
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], $child);

        $this->assertEquals([$filterRule], $response->getFilterRules());
    }

    public function testGetFreeBusyQueueInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetFreeBusyQueueInfoResponse>
            <urn:provider name="$name">
                <urn:account id="$id" />
            </urn:provider>
        </urn:GetFreeBusyQueueInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getFreeBusyQueueInfo();
        $provider = new \Zimbra\Admin\Struct\FreeBusyQueueProvider(
            $name, [new \Zimbra\Common\Struct\Id($id)]
        );
        $this->assertEquals([$provider], $response->getProviders());
    }

    public function testGetGrants()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $type = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetGrantsResponse>
            <urn:grant>
                <urn:target type="$type" id="$id" name="$name" />
                <urn:grantee id="$id" name="$name" type="usr" />
                <urn:right deny="true" canDelegate="true" disinheritSubGroups="true" subDomain="true">$value</urn:right>
            </urn:grant>
        </urn:GetGrantsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getGrants();
        $grant = new \Zimbra\Admin\Struct\GrantInfo(
            new \Zimbra\Admin\Struct\TypeIdName($type, $id, $name),
            new \Zimbra\Admin\Struct\GranteeInfo($id, $name, \Zimbra\Common\Enum\GranteeType::USR()),
            new \Zimbra\Admin\Struct\RightModifierInfo($value, TRUE, TRUE, TRUE, TRUE)
        );
        $this->assertEquals([$grant], $response->getGrants());
    }

    public function testGetIndexStats()
    {
        $id = $this->faker->uuid;
        $maxDocs = $this->faker->randomNumber;
        $numDeletedDocs = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetIndexStatsResponse>
            <urn:stats maxDocs="$maxDocs" deletedDocs="$numDeletedDocs" />
        </urn:GetIndexStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getIndexStats(new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id));
        $stats = new \Zimbra\Admin\Struct\IndexStats($maxDocs, $numDeletedDocs);
        $this->assertEquals($stats, $response->getStats());
    }

    public function testGetLDAPEntries()
    {
        $ldapSearchBase = $this->faker->word;
        $sortBy = $this->faker->word;
        $query = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetLDAPEntriesResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:GetLDAPEntriesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getLDAPEntries($ldapSearchBase);
        $LDAPEntry = new \Zimbra\Admin\Struct\LDAPEntryInfo(
            $name, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals([$LDAPEntry], $response->getLDAPEntries());
    }

    public function testGetLicenseInfo()
    {
        $date = $this->faker->date;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetLicenseInfoResponse>
            <urn:expiration date="$date" />
        </urn:GetLicenseInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getLicenseInfo();
        $expiration = new \Zimbra\Admin\Struct\LicenseExpirationInfo($date);
        $this->assertEquals($expiration, $response->getExpiration());
    }

    public function testGetLoggerStats()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $note = $this->faker->word;
        $limit = $this->faker->word;
        $time = $this->faker->iso8601;
        $t = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetLoggerStatsResponse>
            <urn:hostname hn="$name">
                <urn:stats name="$name">
                    <urn:values t="$t">
                        <urn:stat name="$name" value="$value" />
                    </urn:values>
                </urn:stats>
            </urn:hostname>
            <urn:note>$note</urn:note>
        </urn:GetLoggerStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getLoggerStats();

        $hostStats = new \Zimbra\Admin\Struct\HostStats(
            $name, new \Zimbra\Admin\Struct\StatsInfo($name, new \Zimbra\Admin\Struct\StatsValues($t, [new \Zimbra\Admin\Struct\NameAndValue($name, $value)]))
        );
        $this->assertEquals([$hostStats], $response->getHostNames());
        $this->assertSame($note, $response->getNote());
    }

    public function testGetMailbox()
    {
        $id = $this->faker->uuid;
        $mbxid = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailboxResponse>
            <urn:mbox mbxid="$mbxid" id="$id" s="$size" />
        </urn:GetMailboxResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getMailbox();
        $mbox = new \Zimbra\Admin\Struct\MailboxWithMailboxId($mbxid, $id, $size);
        $this->assertEquals($mbox, $response->getMbox());
    }

    public function testGetMailboxStats()
    {
        $numMboxes = $this->faker->randomNumber;
        $totalSize = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailboxStatsResponse>
            <urn:stats numMboxes="$numMboxes" totalSize="$totalSize" />
        </urn:GetMailboxStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getMailboxStats();
        $stats = new \Zimbra\Admin\Struct\MailboxStats($numMboxes, $totalSize);
        $this->assertEquals($stats, $response->getStats());
    }

    public function testGetMailQueue()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $offset = $this->faker->randomNumber;
        $wait = $this->faker->randomNumber;
        $scanTime = $this->faker->unixTime;
        $total = $this->faker->randomNumber;
        $id = $this->faker->word;
        $time = $this->faker->word;
        $fromdomain = $this->faker->word;
        $size = $this->faker->word;
        $from = $this->faker->word;
        $to = $this->faker->word;
        $host = $this->faker->word;
        $addr = $this->faker->word;
        $reason = $this->faker->word;
        $filter = $this->faker->word;
        $todomain = $this->faker->word;
        $received = $this->faker->word;
        $count = $this->faker->randomNumber;
        $term = $this->faker->word;
        $type = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailQueueResponse>
            <urn:server name="$name">
                <urn:queue name="$name" time="$scanTime" scan="true" total="$total" more="true">
                    <urn:qs type="$type">
                        <urn:qsi n="$count" t="$term" />
                    </urn:qs>
                    <urn:qi id="$id" time="$time" fromdomain="$fromdomain" size="$size" from="$from" to="$to" host="$host" addr="$addr" reason="$reason" filter="$filter" todomain="$todomain" received="$received" />
                </urn:queue>
            </urn:server>
        </urn:GetMailQueueResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $query = new \Zimbra\Admin\Struct\QueueQuery(
            [new \Zimbra\Admin\Struct\QueueQueryField($name, [new \Zimbra\Admin\Struct\ValueAttrib($value)])],
            $limit,
            $offset
        );
        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, $name, TRUE, $wait);
        $server = new \Zimbra\Admin\Struct\ServerMailQueueQuery($queue, $name);

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getMailQueue($server);

        $qs = new \Zimbra\Admin\Struct\QueueSummary($type, [new \Zimbra\Admin\Struct\QueueSummaryItem($count, $term)]);
        $qi = new \Zimbra\Admin\Struct\QueueItem(
            $id, $time, $fromdomain, $size, $from, $to, $host, $addr, $reason, $filter, $todomain, $received
        );
        $queue = new \Zimbra\Admin\Struct\MailQueueDetails($name, $scanTime, TRUE, $total, TRUE, [$qs], [$qi]);
        $server = new \Zimbra\Admin\Struct\ServerMailQueueDetails($queue, $name);
        $this->assertEquals($server, $response->getServer());
    }

    public function testGetMailQueueInfo()
    {
        $name = $this->faker->word;
        $count = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMailQueueInfoResponse>
            <urn:server name="$name">
                <urn:queue name="$name" n="$count" />
            </urn:server>
        </urn:GetMailQueueInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getMailQueueInfo(new \Zimbra\Common\Struct\NamedElement($name));
        $server = new \Zimbra\Admin\Struct\ServerQueues(
            $name, [new \Zimbra\Admin\Struct\MailQueueCount($name, $count)]
        );
        $this->assertEquals($server, $response->getServer());
    }

    public function testGetMemcachedClientConfig()
    {
        $serverList = $this->faker->word;
        $hashAlgorithm = $this->faker->word;
        $defaultExpirySeconds = $this->faker->randomNumber;
        $defaultTimeoutMillis = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMemcachedClientConfigResponse serverList="$serverList" hashAlgorithm="$hashAlgorithm" binaryProtocol="true" defaultExpirySeconds="$defaultExpirySeconds" defaultTimeoutMillis="$defaultTimeoutMillis" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getMemcachedClientConfig();
        $this->assertSame($serverList, $response->getServerList());
        $this->assertSame($hashAlgorithm, $response->getHashAlgorithm());
        $this->assertTrue($response->getBinaryProtocolEnabled());
        $this->assertSame($defaultExpirySeconds, $response->getDefaultExpirySeconds());
        $this->assertSame($defaultTimeoutMillis, $response->getDefaultTimeoutMillis());
    }

    public function testGetOutgoingFilterRules()
    {
        $type = \Zimbra\Common\Enum\AdminFilterType::BEFORE();
        $index = $this->faker->randomNumber;
        $header = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $where = $this->faker->word;
        $time = $this->faker->time;
        $date = $this->faker->unixTime;
        $flag = $this->faker->word;
        $tag = $this->faker->word;
        $method = $this->faker->word;
        $size = $this->faker->word;
        $folder = $this->faker->word;
        $address = $this->faker->word;
        $content = $this->faker->word;
        $subject = $this->faker->word;
        $maxBodySize = $this->faker->randomNumber;
        $origHeaders = $this->faker->word;
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $newName = $this->faker->word;
        $newValue = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:GetOutgoingFilterRulesResponse type="$type">
            <urn:account by="name">$value</urn:account>
            <urn:domain by="name">$value</urn:domain>
            <urn:cos by="name">$value</urn:cos>
            <urn:server by="name">$value</urn:server>
            <urn:filterRules>
                <urn1:filterRule name="$name" active="true">
                    <urn1:filterVariables index="$index">
                        <urn1:filterVariable name="$name" value="$value" />
                    </urn1:filterVariables>
                    <urn1:filterTests condition="allof">
                        <urn1:addressBookTest index="$index" negative="true" header="$header" />
                        <urn1:addressTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" />
                        <urn1:envelopeTest index="$index" negative="true" header="$header" part="all" stringComparison="is" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" />
                        <urn1:attachmentTest index="$index" negative="true" />
                        <urn1:bodyTest index="$index" negative="true" value="$value" caseSensitive="true" />
                        <urn1:bulkTest index="$index" negative="true" />
                        <urn1:contactRankingTest index="$index" negative="true" header="$header" />
                        <urn1:conversationTest index="$index" negative="true" where="$where" />
                        <urn1:currentDayOfWeekTest index="$index" negative="true" value="$value" />
                        <urn1:currentTimeTest index="$index" negative="true" dateComparison="before" time="$time" />
                        <urn1:dateTest index="$index" negative="true" dateComparison="before" date="$date" />
                        <urn1:facebookTest index="$index" negative="true" />
                        <urn1:flaggedTest index="$index" negative="true" flagName="$flag" />
                        <urn1:headerExistsTest index="$index" negative="true" header="$header" />
                        <urn1:headerTest index="$index" negative="true" header="$header" stringComparison="is" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;octet" value="$value" caseSensitive="true" />
                        <urn1:importanceTest index="$index" negative="true" imp="high" />
                        <urn1:inviteTest index="$index" negative="true">
                            <urn1:method>$method</urn1:method>
                        </urn1:inviteTest>
                        <urn1:linkedinTest index="$index" negative="true" />
                        <urn1:listTest index="$index" negative="true" />
                        <urn1:meTest index="$index" negative="true" header="$header" />
                        <urn1:mimeHeaderTest index="$index" negative="true" header="$header" stringComparison="is" value="$value" caseSensitive="true" />
                        <urn1:sizeTest index="$index" negative="true" numberComparison="over" s="$size" />
                        <urn1:socialcastTest index="$index" negative="true" />
                        <urn1:trueTest index="$index" negative="true" />
                        <urn1:twitterTest index="$index" negative="true" />
                        <urn1:communityRequestsTest index="$index" negative="true" />
                        <urn1:communityContentTest index="$index" negative="true" />
                        <urn1:communityConnectionsTest index="$index" negative="true" />
                    </urn1:filterTests>
                    <urn1:filterActions>
                        <urn1:filterVariables index="$index">
                            <urn1:filterVariable name="$name" value="$value" />
                        </urn1:filterVariables>
                        <urn1:actionKeep index="$index" />
                        <urn1:actionDiscard index="$index" />
                        <urn1:actionFileInto index="$index" folderPath="$folder" copy="true" />
                        <urn1:actionFlag index="$index" flagName="$flag" />
                        <urn1:actionTag index="$index" tagName="$tag" />
                        <urn1:actionRedirect index="$index" a="$address" copy="true" />
                        <urn1:actionReply index="$index">
                            <urn1:content>$content</urn1:content>
                        </urn1:actionReply>
                        <urn1:actionNotify index="$index" a="$address" su="$subject" maxBodySize="$maxBodySize" origHeaders="$origHeaders">
                            <urn1:content>$content</urn1:content>
                        </urn1:actionNotify>
                        <urn1:actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
                            <urn1:method>$method</urn1:method>
                        </urn1:actionRFCCompliantNotify>
                        <urn1:actionStop index="$index" />
                        <urn1:actionReject index="$index">$content</urn1:actionReject>
                        <urn1:actionEreject index="$index">$content</urn1:actionEreject>
                        <urn1:actionLog index="$index" level="info">$content</urn1:actionLog>
                        <urn1:actionAddheader index="$index" last="true">
                            <urn1:headerName>$headerName</urn1:headerName>
                            <urn1:headerValue>$headerValue</urn1:headerValue>
                        </urn1:actionAddheader>
                        <urn1:actionDeleteheader index="$index" last="true" offset="$offset">
                            <urn1:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn1:headerName>$headerName</urn1:headerName>
                                <urn1:headerValue>$headerValue</urn1:headerValue>
                            </urn1:test>
                        </urn1:actionDeleteheader>
                        <urn1:actionReplaceheader index="$index" last="true" offset="$offset">
                            <urn1:test matchType="is" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;octet">
                                <urn1:headerName>$headerName</urn1:headerName>
                                <urn1:headerValue>$headerValue</urn1:headerValue>
                            </urn1:test>
                            <urn1:newName>$newName</urn1:newName>
                            <urn1:newValue>$newValue</urn1:newValue>
                        </urn1:actionReplaceheader>
                    </urn1:filterActions>
                    <urn1:nestedRule>
                        <urn1:filterTests condition="allof" />
                    </urn1:nestedRule>
                </urn1:filterRule>
            </urn:filterRules>
        </urn:GetOutgoingFilterRulesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $account = new \Zimbra\Common\Struct\AccountSelector(\Zimbra\Common\Enum\AccountBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(\Zimbra\Common\Enum\DomainBy::NAME(), $value);
        $cos = new \Zimbra\Admin\Struct\CosSelector(\Zimbra\Common\Enum\CosBy::NAME(), $value);
        $server = new \Zimbra\Admin\Struct\ServerSelector(\Zimbra\Common\Enum\ServerBy::NAME(), $value);

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getOutgoingFilterRules($type, $account, $domain, $cos, $server);

        $this->assertEquals($type, $response->getType());
        $this->assertEquals($account, $response->getAccount());
        $this->assertEquals($domain, $response->getDomain());
        $this->assertEquals($cos, $response->getCos());
        $this->assertEquals($server, $response->getServer());

        $filterVariables = new \Zimbra\Mail\Struct\FilterVariables($index, [new \Zimbra\Mail\Struct\FilterVariable($name, $value)]);
        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            $index, TRUE, $header
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $envelopeTest = new \Zimbra\Mail\Struct\EnvelopeTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\AddressPart::ALL(), \Zimbra\Common\Enum\StringComparison::IS(), TRUE, $value, \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET()
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            $index, TRUE
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            $index, TRUE, $value, TRUE
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            $index, TRUE
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            $index, TRUE, $header
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            $index, TRUE, $where
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            $index, TRUE, $value
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $time
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            $index, TRUE, \Zimbra\Common\Enum\DateComparison::BEFORE(), $date
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            $index, TRUE
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            $index, TRUE, $flag
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            $index, TRUE, $header
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), \Zimbra\Common\Enum\ValueComparison::EQUAL(), \Zimbra\Common\Enum\CountComparison::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $value, TRUE
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            $index, TRUE, \Zimbra\Common\Enum\Importance::HIGH()
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            $index, TRUE, [$method]
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            $index, TRUE
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            $index, TRUE
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            $index, TRUE, $header
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            $index, TRUE, $header, \Zimbra\Common\Enum\StringComparison::IS(), $value, TRUE
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            $index, TRUE, \Zimbra\Common\Enum\NumberComparison::OVER(), $size
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            $index, TRUE
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            $index, TRUE
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            $index, TRUE
        );
        $communityRequestsTest = new \Zimbra\Mail\Struct\CommunityRequestsTest(
            $index, TRUE
        );
        $communityContentTest = new \Zimbra\Mail\Struct\CommunityContentTest(
            $index, TRUE
        );
        $communityConnectionsTest = new \Zimbra\Mail\Struct\CommunityConnectionsTest(
            $index, TRUE
        );
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            \Zimbra\Common\Enum\FilterCondition::ALL_OF(), [
                $addressBookTest,
                $addressTest,
                $envelopeTest,
                $attachmentTest,
                $bodyTest,
                $bulkTest,
                $contactRankingTest,
                $conversationTest,
                $currentDayOfWeekTest,
                $currentTimeTest,
                $dateTest,
                $facebookTest,
                $flaggedTest,
                $headerExistsTest,
                $headerTest,
                $importanceTest,
                $inviteTest,
                $linkedinTest,
                $listTest,
                $meTest,
                $mimeHeaderTest,
                $sizeTest,
                $socialcastTest,
                $trueTest,
                $twitterTest,
                $communityRequestsTest,
                $communityContentTest,
                $communityConnectionsTest,
            ]
        );
        $actionKeep = new \Zimbra\Mail\Struct\KeepAction($index);
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction($index);
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction($index, $folder, TRUE);
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction($index, $flag);
        $actionTag = new \Zimbra\Mail\Struct\TagAction($index, $tag, TRUE);
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction($index, $address, TRUE);
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction($index, $content, TRUE);
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction($index, $address, $subject, $maxBodySize, $content, $origHeaders);
        $actionRFCCompliantNotify = new \Zimbra\Mail\Struct\RFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $actionStop = new \Zimbra\Mail\Struct\StopAction($index);
        $actionReject = new \Zimbra\Mail\Struct\RejectAction($index, $content);
        $actionEreject = new \Zimbra\Mail\Struct\ErejectAction($index, $content);
        $actionLog = new \Zimbra\Mail\Struct\LogAction($index, \Zimbra\Common\Enum\LoggingLevel::INFO(), $content);
        $actionAddheader = new \Zimbra\Mail\Struct\AddheaderAction($index, $headerName, $headerValue, TRUE);
        $actionDeleteheader = new \Zimbra\Mail\Struct\DeleteheaderAction(
            $index, TRUE, $offset
            , new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue])
        );
        $actionReplaceheader = new \Zimbra\Mail\Struct\ReplaceheaderAction(
            $index, TRUE, $offset,
            new \Zimbra\Mail\Struct\EditheaderTest(\Zimbra\Common\Enum\MatchType::IS(), TRUE, TRUE, \Zimbra\Common\Enum\RelationalComparator::EQUAL(), \Zimbra\Common\Enum\ComparisonComparator::OCTET(), $headerName, [$headerValue]),
            $newName, $newValue
        );
        $child = new \Zimbra\Mail\Struct\NestedRule(new \Zimbra\Mail\Struct\FilterTests(\Zimbra\Common\Enum\FilterCondition::ALL_OF()));
        $filterRule = new \Zimbra\Mail\Struct\FilterRule($filterTests, $name, TRUE, $filterVariables, [
            $filterVariables,
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionRFCCompliantNotify,
            $actionStop,
            $actionReject,
            $actionEreject,
            $actionLog,
            $actionAddheader,
            $actionDeleteheader,
            $actionReplaceheader,
        ], $child);

        $this->assertEquals([$filterRule], $response->getFilterRules());
    }

    public function testGetQuotaUsage()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = $this->faker->randomNumber;
        $quotaLimit = $this->faker->randomNumber;
        $searchTotal = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetQuotaUsageResponse more="true" searchTotal="$searchTotal">
            <urn:account name="$name" id="$id" used="$quotaUsed" limit="$quotaLimit" />
        </urn:GetQuotaUsageResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getQuotaUsage();

        $account = new \Zimbra\Admin\Struct\AccountQuotaInfo(
            $name, $id, $quotaUsed, $quotaLimit
        );
        $this->assertTrue($response->isMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertEquals([$account], $response->getAccountQuotas());
    }

    public function testGetRight()
    {
        $right = $this->faker->word;
        $name = $this->faker->word;
        $targetType = $this->faker->word;
        $desc = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetRightResponse>
            <urn:right name="$name" type="preset" targetType="$targetType" rightClass="ALL">
                <urn:desc>$desc</urn:desc>
                <urn:attrs all="true">
                    <urn:a n="$key">$value</urn:a>
                </urn:attrs>
                <urn:rights>
                    <urn:r n="$name" type="preset" targetType="$targetType" />
                </urn:rights>
            </urn:right>
        </urn:GetRightResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getRight($right);

        $rights = new \Zimbra\Admin\Struct\ComboRights([new \Zimbra\Admin\Struct\ComboRightInfo(
            $name, \Zimbra\Common\Enum\RightType::PRESET(), $targetType
        )]);
        $rightInfo = new \Zimbra\Admin\Struct\RightInfo(
            $name, \Zimbra\Common\Enum\RightType::PRESET(), \Zimbra\Common\Enum\RightClass::ALL(), $desc, $targetType, new \Zimbra\Admin\Struct\RightsAttrs(TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]), $rights
        );
        $this->assertEquals($rightInfo, $response->getRight());
    }

    public function testGetRightsDoc()
    {
        $name = $this->faker->word;
        $desc = $this->faker->word;
        $note = $this->faker->word;
        $notUsed = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetRightsDocResponse>
            <urn:package name="$name">
                <urn:cmd name="$name">
                    <urn:rights>
                        <urn:right name="$name" />
                    </urn:rights>
                    <urn:desc>
                        <urn:note>$note</urn:note>
                    </urn:desc>
                </urn:cmd>
            </urn:package>
            <urn:notUsed>$notUsed</urn:notUsed>
            <urn:domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template>
                <urn:right name="$name" type="preset">
                    <urn:desc>$desc</urn:desc>
                    <urn:rights>
                        <urn:r n="$name" />
                    </urn:rights>
                </urn:right>
            </urn:domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template>
        </urn:GetRightsDocResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getRightsDoc();

        $package = new \Zimbra\Admin\Struct\PackageRightsInfo(
            $name, [new \Zimbra\Admin\Struct\CmdRightsInfo($name, [new \Zimbra\Common\Struct\NamedElement($name)], [$note])]
        );
        $right = new \Zimbra\Admin\Struct\DomainAdminRight(
            $name, \Zimbra\Common\Enum\RightType::PRESET(), $desc, [new \Zimbra\Admin\Struct\RightWithName($name)]
        );
        $this->assertEquals([$package], $response->getPackages());
        $this->assertSame([$notUsed], $response->getNotUsed());
        $this->assertEquals([$right], $response->getRights());
    }

    public function testGetServer()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServerResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:GetServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getServer(new \Zimbra\Admin\Struct\ServerSelector());
        $server = new \Zimbra\Admin\Struct\ServerInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($server, $response->getServer());
    }

    public function testGetServerNIfs()
    {
        $value = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServerNIfsResponse>
            <urn:ni>
                <urn:a n="$key">$value</urn:a>
            </urn:ni>
        </urn:GetServerNIfsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getServerNIfs(new \Zimbra\Admin\Struct\ServerSelector());
        $ni = new \Zimbra\Admin\Struct\NetworkInformation([new \Zimbra\Admin\Struct\Attr($key, $value)]);
        $this->assertEquals([$ni], $response->getNetworkInterfaces());
    }

    public function testGetServerStats()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $description = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServerStatsResponse>
            <urn:stat name="$name" description="$description">$value</urn:stat>
        </urn:GetServerStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getServerStats();
        $stat = new \Zimbra\Admin\Struct\Stat($value, $name, $description);
        $this->assertEquals([$stat], $response->getStats());
    }

    public function testGetServiceStatus()
    {
        $id = $this->faker->uuid;
        $displayName = $this->faker->name;
        $server = $this->faker->word;
        $service = $this->faker->word;
        $time = $this->faker->unixTime;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServiceStatusResponse>
            <urn:timezone id="$id" displayName="$displayName" />
            <urn:status server="$server" service="$service" t="$time">1</urn:status>
        </urn:GetServiceStatusResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getServiceStatus();
        $timezone = new \Zimbra\Admin\Struct\TimeZoneInfo($id, $displayName);
        $status = new \Zimbra\Admin\Struct\ServiceStatus(
            $server, $service, $time, \Zimbra\Common\Enum\ZeroOrOne::ONE()
        );
        $this->assertEquals($timezone, $response->getTimezone());
        $this->assertEquals([$status], $response->getServiceStatuses());
    }

    public function testGetSessions()
    {
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $sessionId = $this->faker->uuid;
        $createdDate = $this->faker->unixTime;
        $lastAccessedDate = $this->faker->unixTime;
        $total = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetSessionsResponse more="true" total="$total">
            <urn:s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
        </urn:GetSessionsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getSessions(\Zimbra\Common\Enum\SessionType::SOAP());
        $session = new \Zimbra\Admin\Struct\SimpleSessionInfo(
            $zimbraId, $name, $sessionId, $createdDate, $lastAccessedDate
        );
        $this->assertTrue($response->getMore());
        $this->assertSame($total, $response->getTotal());
        $this->assertEquals([$session], $response->getSessions());
    }

    public function testGetShareInfo()
    {
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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetShareInfoResponse>
            <urn:share ownerId="$ownerId" ownerEmail="$ownerEmail" ownerName="$ownerDisplayName" folderId="$folderId" folderUuid="$folderUuid" folderPath="$folderPath" view="$defaultView" rights="$rights" granteeType="$granteeType" granteeId="$granteeId" granteeName="$granteeName" granteeDisplayName="$granteeDisplayName" mid="$mountpointId" />
        </urn:GetShareInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getShareInfo(new \Zimbra\Common\Struct\AccountSelector());
        $share = new \Zimbra\Common\Struct\ShareInfo(
            $ownerId, $ownerEmail, $ownerDisplayName,
            $folderId, $folderUuid, $folderPath,
            $defaultView, $rights,
            $granteeType, $granteeId, $granteeName, $granteeDisplayName,
            $mountpointId
        );
        $this->assertEquals([$share], $response->getShares());
    }

    public function testGetSystemRetentionPolicy()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $lifetime = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:GetSystemRetentionPolicyResponse>
            <urn1:retentionPolicy>
                <urn1:keep>
                    <urn1:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                </urn1:keep>
                <urn1:purge>
                    <urn1:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                </urn1:purge>
            </urn1:retentionPolicy>
        </urn:GetSystemRetentionPolicyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getSystemRetentionPolicy();
        $retention = new \Zimbra\Mail\Struct\RetentionPolicy(
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime)],
            [new \Zimbra\Mail\Struct\Policy(\Zimbra\Common\Enum\Type::USER(), $id, $name, $lifetime)]
        );
        $this->assertEquals($retention, $response->getRetentionPolicy());
    }

    public function testGetUCService()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetUCServiceResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:GetUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getUCService(new \Zimbra\Admin\Struct\UcServiceSelector());
        $ucservice = new \Zimbra\Admin\Struct\UCServiceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($ucservice, $response->getUCService());
    }

    public function testGetVersionInfo()
    {
        $type = $this->faker->word;
        $version = $this->faker->semver;
        $release = $this->faker->word;
        $buildDate = $this->faker->date;
        $host = $this->faker->ipv4;
        $majorVersion = $this->faker->word;
        $minorVersion = $this->faker->word;
        $microVersion = $this->faker->word;
        $platform = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetVersionInfoResponse>
            <urn:info type="$type" version="$version" release="$release" buildDate="$buildDate" host="$host" majorversion="$majorVersion" minorversion="$minorVersion" microversion="$microVersion" platform="$platform" />
        </urn:GetVersionInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getVersionInfo();
        $info = new \Zimbra\Admin\Struct\VersionInfo(
            $type, $version, $release, $buildDate, $host, $majorVersion, $minorVersion, $microVersion, $platform
        );
        $this->assertEquals($info, $response->getInfo());
    }

    public function testGetVolume()
    {
        $id = $this->faker->randomNumber;
        $type = $this->faker->randomElement(\Zimbra\Common\Enum\VolumeType::toArray());
        $threshold = $this->faker->randomNumber;
        $mgbits = $this->faker->randomNumber;
        $mbits = $this->faker->randomNumber;
        $fgbits = $this->faker->randomNumber;
        $fbits = $this->faker->randomNumber;
        $name = $this->faker->word;
        $rootPath = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetVolumeResponse>
            <urn:volume id="$id" name="$name" rootpath="$rootPath" type="$type" compressBlobs="true" compressionThreshold="$threshold" mgbits="$mgbits" mbits="$mbits" fgbits="$fgbits" fbits="$fbits" isCurrent="true" />
        </urn:GetVolumeResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getVolume($id);
        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, $name, $rootPath, $type, TRUE, $threshold, $mgbits, $mbits, $fgbits, $fbits, TRUE
        );
        $this->assertEquals($volume, $response->getVolume());
    }

    public function testGetXMPPComponent()
    {
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $domainName = $this->faker->domainName;
        $serverName = $this->faker->ipv4;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetXMPPComponentResponse>
            <urn:xmppcomponent name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName">
                <urn:a n="$key">$value</urn:a>
            </urn:xmppcomponent>
        </urn:GetXMPPComponentResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getXMPPComponent(new \Zimbra\Admin\Struct\XMPPComponentSelector());
        $xmpp = new \Zimbra\Admin\Struct\XMPPComponentInfo(
            $name, $id, $domainName, $serverName, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($xmpp, $response->getComponent());
    }

    public function testGetZimlet()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $hasKeyword = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetZimletResponse>
            <urn:zimlet name="$name" id="$id" hasKeyword="$hasKeyword">
                <urn:a n="$key">$value</urn:a>
            </urn:zimlet>
        </urn:GetZimletResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getZimlet(new \Zimbra\Common\Struct\NamedElement($name));
        $zimlet = new \Zimbra\Admin\Struct\ZimletInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)], $hasKeyword
        );
        $this->assertEquals($zimlet, $response->getZimlet());
    }

    public function testGetZimletStatus()
    {
        $name = $this->faker->name;
        $priority = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetZimletStatusResponse>
            <urn:zimlets>
                <urn:zimlet name="$name" status="enabled" extension="true" priority="$priority" />
            </urn:zimlets>
            <urn:cos name="$name">
                <urn:zimlet name="$name" status="enabled" extension="true" priority="$priority" />
            </urn:cos>
        </urn:GetZimletStatusResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->getZimletStatus();

        $zimlet = new \Zimbra\Admin\Struct\ZimletStatus(
            $name, \Zimbra\Common\Enum\ZimletStatusSetting::ENABLED(), TRUE, $priority
        );
        $zimlets = new \Zimbra\Admin\Struct\ZimletStatusParent([$zimlet]);
        $cos = new \Zimbra\Admin\Struct\ZimletStatusCos($name, [$zimlet]);
        $this->assertEquals($zimlets, $response->getZimlets());
        $this->assertEquals([$cos], $response->getCoses());
    }

    public function testGrantRight()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GrantRightResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->grantRight(
            new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(),
            new \Zimbra\Admin\Struct\GranteeSelector(),
            new \Zimbra\Admin\Struct\RightModifierInfo()
        );
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\GrantRightResponse);
    }

    public function testLockoutMailbox()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:LockoutMailboxResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->lockoutMailbox(
            new \Zimbra\Common\Struct\AccountNameSelector()
        );
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\LockoutMailboxResponse);
    }

    public function testMailQueueAction()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:MailQueueActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $action = new \Zimbra\Admin\Struct\MailQueueAction(
            new \Zimbra\Admin\Struct\QueueQuery()
        );
        $server = new \Zimbra\Admin\Struct\ServerWithQueueAction(
            new \Zimbra\Admin\Struct\MailQueueWithAction($action)
        );
        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->mailQueueAction($server);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\MailQueueActionResponse);
    }

    public function testMailQueueFlush()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:MailQueueFlushResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->mailQueueFlush(new \Zimbra\Common\Struct\NamedElement());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\MailQueueFlushResponse);
    }

    public function testMigrateAccount()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:MigrateAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->migrateAccount(new \Zimbra\Admin\Struct\IdAndAction());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\MigrateAccountResponse);
    }

    public function testModifyAccount()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->name;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:ModifyAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyAccount($id);
        $account = new \Zimbra\Admin\Struct\AccountInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($account, $response->getAccount());
    }

    public function testModifyAdminSavedSearches()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyAdminSavedSearchesResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyAdminSavedSearches();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyAdminSavedSearchesResponse);
    }

    public function testModifyAlwaysOnCluster()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->name;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyAlwaysOnClusterResponse>
            <urn:alwaysOnCluster name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:alwaysOnCluster>
        </urn:ModifyAlwaysOnClusterResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyAlwaysOnCluster($id);
        $cluster = new \Zimbra\Admin\Struct\AlwaysOnClusterInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($cluster, $response->getAlwaysOnCluster());
    }

    public function testModifyCalendarResource()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->name;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyCalendarResourceResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:ModifyCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyCalendarResource($id);
        $calResource = new \Zimbra\Admin\Struct\CalendarResourceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($calResource, $response->getCalResource());
    }

    public function testModifyConfig()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyConfigResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyConfig();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyConfigResponse);
    }

    public function testModifyCos()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="true">$value</urn:a>
            </urn:cos>
        </urn:ModifyCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyCos($id);
        $cos = new \Zimbra\Admin\Struct\CosInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, TRUE)]
        );
        $this->assertEquals($cos, $response->getCos());
    }

    public function testModifyDataSource()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyDataSource($this->faker->uuid, new \Zimbra\Admin\Struct\DataSourceInfo());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyDataSourceResponse);
    }

    public function testModifyDelegatedAdminConstraints()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDelegatedAdminConstraintsResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyDelegatedAdminConstraints();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyDelegatedAdminConstraintsResponse);
    }

    public function testModifyDistributionList()
    {
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $member = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDistributionListResponse>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:a n="$key">$value</urn:a>
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="usr" />
                </urn:owners>
            </urn:dl>
        </urn:ModifyDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyDistributionList($id);
        $dl = new \Zimbra\Admin\Struct\DistributionListInfo(
            $name, $id, [$member],
            [new \Zimbra\Admin\Struct\Attr($key, $value)],
            [new \Zimbra\Admin\Struct\GranteeInfo($id, $name, \Zimbra\Common\Enum\GranteeType::USR())],
            TRUE
        );
        $this->assertEquals($dl, $response->getDl());
    }

    public function testModifyDomain()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDomainResponse>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
        </urn:ModifyDomainResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyDomain($id);
        $domain = new \Zimbra\Admin\Struct\DomainInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($domain, $response->getDomain());
    }

    public function testModifyFilterRules()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyFilterRulesResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyFilterRules();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyFilterRulesResponse);
    }

    public function testModifyLDAPEntry()
    {
        $dn = $this->faker->word;
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyLDAPEntryResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:ModifyLDAPEntryResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyLDAPEntry($dn);
        $LDAPEntry = new \Zimbra\Admin\Struct\LDAPEntryInfo(
            $name, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($LDAPEntry, $response->getLDAPEntry());
    }

    public function testModifyOutgoingFilterRules()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyOutgoingFilterRulesResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyOutgoingFilterRules();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyOutgoingFilterRulesResponse);
    }

    public function testModifyServer()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyServerResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:ModifyServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyServer($id);
        $server = new \Zimbra\Admin\Struct\ServerInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($server, $response->getServer());
    }

    public function testModifySystemRetentionPolicy()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $lifetime = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:ModifySystemRetentionPolicyResponse>
            <urn1:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:ModifySystemRetentionPolicyResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $policy = new \Zimbra\Mail\Struct\Policy(
            \Zimbra\Common\Enum\Type::SYSTEM(), $id, $name, $lifetime
        );
        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifySystemRetentionPolicy($policy);
        $this->assertEquals($policy, $response->getPolicy());
    }

    public function testModifyUCService()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyUCServiceResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:ModifyUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyUCService($id);
        $ucservice = new \Zimbra\Admin\Struct\UCServiceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($ucservice, $response->getUCService());
    }

    public function testModifyVolume()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyVolumeResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyVolume(new \Zimbra\Admin\Struct\VolumeInfo());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyVolumeResponse);
    }

    public function testModifyZimlet()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyZimletResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->modifyZimlet(new \Zimbra\Admin\Struct\ZimletAclStatusPri());
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ModifyZimletResponse);
    }

    public function testNoOp()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:NoOpResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->noOp();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\NoOpResponse);
    }

    public function testPing()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PingResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->ping();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\PingResponse);
    }

    public function testPurgeAccountCalendarCache()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PurgeAccountCalendarCacheResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->purgeAccountCalendarCache($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\PurgeAccountCalendarCacheResponse);
    }

    public function testPurgeFreeBusyQueue()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PurgeFreeBusyQueueResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->purgeFreeBusyQueue();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\PurgeFreeBusyQueueResponse);
    }

    public function testPurgeMessages()
    {
        $id = $this->faker->uuid;
        $mbxid = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PurgeMessagesResponse>
            <urn:mbox mbxid="$mbxid" id="$id" s="$size" />
        </urn:PurgeMessagesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->purgeMessages();
        $mbox = new \Zimbra\Admin\Struct\MailboxWithMailboxId($mbxid, $id, $size);
        $this->assertEquals([$mbox], $response->getMailboxes());
    }

    public function testPushFreeBusy()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PushFreeBusyResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->pushFreeBusy();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\PushFreeBusyResponse);
    }

    public function testQueryWaitSet()
    {
        $id = $this->faker->uuid;
        $type = $this->faker->word;
        $waitSetId = $this->faker->uuid;
        $owner = $this->faker->uuid;
        $defaultInterests = $this->faker->word;
        $lastAccessDate = $this->faker->randomNumber;
        $accounts = $this->faker->word;
        $cbSeqNo = $this->faker->word;
        $currentSeqNo = $this->faker->word;
        $nextSeqNo = $this->faker->word;
        $aid = $this->faker->uuid;
        $cid = $this->faker->uuid;

        $account = $this->faker->uuid;
        $interests = $this->faker->word;
        $mboxSyncToken = $this->faker->randomNumber;
        $mboxSyncTokenDiff = $this->faker->randomNumber;
        $acctIdError = $this->faker->uuid;

        $interestMask = $this->faker->word;
        $highestChangeId = $this->faker->randomNumber;
        $lastAccessTime = $this->faker->randomNumber;
        $creationTime = $this->faker->randomNumber;
        $sessionId = $this->faker->uuid;
        $token = $this->faker->uuid;
        $folderInterests = $this->faker->word;
        $changedFolders = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:QueryWaitSetResponse>
            <urn:waitSet id="$waitSetId" owner="$owner" defTypes="$defaultInterests" ld="$lastAccessDate" cbSeqNo="$cbSeqNo" currentSeqNo="$currentSeqNo" nextSeqNo="$nextSeqNo">
                <urn:errors>
                    <urn:error id="$id" type="$type" />
                </urn:errors>
                <urn:ready accounts="$accounts" />
                <urn:buffered>
                    <urn:commit aid="$aid" cid="$cid" />
                </urn:buffered>
                <urn:session account="$account" types="$interests" token="$token" mboxSyncToken="$mboxSyncToken" mboxSyncTokenDiff="$mboxSyncTokenDiff" acctIdError="$acctIdError">
                    <urn:WaitSetSession interestMask="$interestMask" highestChangeId="$highestChangeId" lastAccessTime="$lastAccessTime" creationTime="$creationTime" sessionId="$sessionId" token="$token" folderInterests="$folderInterests" changedFolders="$changedFolders" />
                </urn:session>
            </urn:waitSet>
        </urn:QueryWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->queryWaitSet();

        $error = new \Zimbra\Common\Struct\IdAndType($id, $type);
        $signalledAccounts = new \Zimbra\Admin\Struct\AccountsAttrib($accounts);
        $commit = new \Zimbra\Admin\Struct\BufferedCommitInfo($aid, $cid);
        $WaitSetSession = new \Zimbra\Admin\Struct\WaitSetSessionInfo(
            $interestMask, $highestChangeId, $lastAccessTime, $creationTime, $sessionId, $token, $folderInterests, $changedFolders
        );
        $session = new \Zimbra\Admin\Struct\SessionForWaitSet(
            $account, $interests, $token, $mboxSyncToken, $mboxSyncTokenDiff, $acctIdError, $WaitSetSession
        );
        $waitSet = new \Zimbra\Admin\Struct\WaitSetInfo(
            $waitSetId, $owner, $defaultInterests, $lastAccessDate, [$error], $signalledAccounts, $cbSeqNo, $currentSeqNo, $nextSeqNo, [$commit], [$session]
        );
        $this->assertEquals([$waitSet], $response->getWaitsets());
    }

    public function testRecalculateMailboxCounts()
    {
        $id = $this->faker->uuid;
        $quotaUsed = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RecalculateMailboxCountsResponse>
            <urn:mbox id="$id" used="$quotaUsed" />
        </urn:RecalculateMailboxCountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->recalculateMailboxCounts();
        $mbox = new \Zimbra\Admin\Struct\MailboxQuotaInfo($id, $quotaUsed);
        $this->assertEquals($mbox, $response->getMailbox());
    }

    public function testRefreshRegisteredAuthTokens()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:RefreshRegisteredAuthTokensResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->refreshRegisteredAuthTokens();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\RefreshRegisteredAuthTokensResponse);
    }

    public function testReIndexEnvelope()
    {
        $numSucceeded = $this->faker->randomNumber;
        $numFailed = $this->faker->randomNumber;
        $numRemaining = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ReIndexResponse status="running">
            <urn:progress numSucceeded="$numSucceeded" numFailed="$numFailed" numRemaining="$numRemaining" />
        </urn:ReIndexResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->reIndex(new \Zimbra\Admin\Struct\ReindexMailboxInfo());
        $progress = new \Zimbra\Admin\Struct\ReindexProgressInfo($numSucceeded, $numFailed, $numRemaining);
        $this->assertEquals(\Zimbra\Common\Enum\ReIndexStatus::RUNNING(), $response->getStatus());
        $this->assertEquals($progress, $response->getProgress());
    }

    public function testReloadLocalConfig()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ReloadLocalConfigResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->reloadLocalConfig();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ReloadLocalConfigResponse);
    }

    public function testReloadMemcachedClientConfig()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ReloadMemcachedClientConfigResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->reloadMemcachedClientConfig();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ReloadMemcachedClientConfigResponse);
    }

    public function testRemoveAccountAlias()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RemoveAccountAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->removeAccountAlias($this->faker->uuid, $this->faker->email);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\RemoveAccountAliasResponse);
    }

    public function testRemoveAccountLogger()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RemoveAccountLoggerResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->removeAccountLogger();
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\RemoveAccountLoggerResponse);
    }

    public function testRemoveDistributionListAlias()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RemoveDistributionListAliasResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->removeDistributionListAlias($this->faker->uuid, $this->faker->email);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\RemoveDistributionListAliasResponse);
    }

    public function testRemoveDistributionListMember()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:RemoveDistributionListMemberResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->removeDistributionListMember($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\RemoveDistributionListMemberResponse);
    }

    public function testRenameAccount()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameAccountResponse>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
        </urn:RenameAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->renameAccount($id, $name);
        $account = new \Zimbra\Admin\Struct\AccountInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($account, $response->getAccount());
    }

    public function testRenameCalendarResource()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameCalendarResourceResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:RenameCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->renameCalendarResource($id, $name);
        $calResource = new \Zimbra\Admin\Struct\CalendarResourceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($calResource, $response->getCalResource());
    }

    public function testRenameCos()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="true">$value</urn:a>
            </urn:cos>
        </urn:RenameCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->renameCos($id, $name);
        $cos = new \Zimbra\Admin\Struct\CosInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, TRUE)]
        );
        $this->assertEquals($cos, $response->getCos());
    }

    public function testRenameDistributionList()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $member = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameDistributionListResponse>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
        </urn:RenameDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->renameDistributionList($id, $name);

        $owner = new \Zimbra\Admin\Struct\GranteeInfo(
            $id, $name, \Zimbra\Common\Enum\GranteeType::ALL()
        );
        $dl = new \Zimbra\Admin\Struct\DistributionListInfo($name, $id, [$member], [], [$owner], TRUE);
        $this->assertEquals($dl, $response->getDl());
    }

    public function testRenameLDAPEntry()
    {
        $name = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameLDAPEntryResponse>
            <urn:LDAPEntry name="$name">
                <urn:a n="$key">$value</urn:a>
            </urn:LDAPEntry>
        </urn:RenameLDAPEntryResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->renameLDAPEntry($name, $name);
        $LDAPEntry = new \Zimbra\Admin\Struct\LDAPEntryInfo(
            $name, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($LDAPEntry, $response->getLDAPentry());
    }

    public function testRenameUCService()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameUCServiceResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:RenameUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->renameUCService($id, $name);
        $ucService = new \Zimbra\Admin\Struct\UCServiceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertEquals($ucService, $response->getUCService());
    }

    public function testResetAllLoggers()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ResetAllLoggersResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->resetAllLoggers($this->faker->uuid);
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\ResetAllLoggersResponse);
    }

    public function testRevokeRight()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RevokeRightResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->revokeRight(
            new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(),
            new \Zimbra\Admin\Struct\GranteeSelector(),
            new \Zimbra\Admin\Struct\RightModifierInfo()
        );
        $this->assertTrue($response instanceof \Zimbra\Admin\Message\RevokeRightResponse);
    }

    public function testRunUnitTests()
    {
        $name = $this->faker->word;
        $execSeconds = $this->faker->randomNumber;
        $className = $this->faker->word;
        $throwable = $this->faker->word;
        $numExecuted = $this->faker->randomNumber;
        $numFailed = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:RunUnitTestsResponse numExecuted="$numExecuted" numFailed="$numFailed">
            <urn:results>
                <urn:completed name="$name" execSeconds="$execSeconds" class="$className"/>
                <urn:failure name="$name" execSeconds="$execSeconds" class="$className">$throwable</urn:failure>
            </urn:results>
        </urn:RunUnitTestsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->runUnitTests();

        $completed = new \Zimbra\Admin\Struct\CompletedTestInfo($name, $execSeconds, $className);
        $failure = new \Zimbra\Admin\Struct\FailedTestInfo($name, $execSeconds, $className, $throwable);
        $results = new \Zimbra\Admin\Struct\TestResultInfo([$completed], [$failure]);
        $this->assertEquals($results, $response->getResults());
        $this->assertSame($numExecuted, $response->getNumExecuted());
        $this->assertSame($numFailed, $response->getNumFailed());
    }

    public function testSearchAccounts()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $member = $this->faker->word;
        $targetName = $this->faker->word;
        $targetType = \Zimbra\Common\Enum\TargetType::ACCOUNT();
        $searchTotal = $this->faker->randomNumber;
        $query = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchAccountsResponse more="true" searchTotal="$searchTotal">
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:a n="$key">$value</urn:a>
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
            <urn:alias name="$name" id="$id" targetName="$targetName" type="$targetType">
                <urn:a n="$key">$value</urn:a>
            </urn:alias>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:SearchAccountsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->searchAccounts($query);

        $calResource = new \Zimbra\Admin\Struct\CalendarResourceInfo($name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]);
        $dl = new \Zimbra\Admin\Struct\DistributionListInfo(
            $name, $id, [$member], [new \Zimbra\Admin\Struct\Attr($key, $value)], [new \Zimbra\Admin\Struct\GranteeInfo($id, $name, \Zimbra\Common\Enum\GranteeType::ALL())], TRUE
        );
        $alias = new \Zimbra\Admin\Struct\AliasInfo($name, $id, $targetName, $targetType, [new \Zimbra\Admin\Struct\Attr($key, $value)]);
        $account = new \Zimbra\Admin\Struct\AccountInfo($name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]);
        $domainInfo = new \Zimbra\Admin\Struct\DomainInfo($name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]);
        $cos = new \Zimbra\Admin\Struct\CosInfo($name, $id, TRUE, [new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, FALSE)]);

        $this->assertTrue($response->getMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertEquals([$calResource], $response->getCalendarResources());
        $this->assertEquals([$dl], $response->getDistributionLists());
        $this->assertEquals([$alias], $response->getAliases());
        $this->assertEquals([$account], $response->getAccounts());
        $this->assertEquals([$domainInfo], $response->getDomains());
        $this->assertEquals([$cos], $response->getCOSes());
    }

    public function testSearchAutoProvDirectory()
    {
        $dn = $this->faker->word;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $searchTotal = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchAutoProvDirectoryResponse more="true" searchTotal="$searchTotal">
            <urn:entry dn="$dn">
                <urn:a n="$key">$value</urn:a>
                <urn:key>$key</urn:key>
            </urn:entry>
        </urn:SearchAutoProvDirectoryResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->searchAutoProvDirectory(new \Zimbra\Admin\Struct\DomainSelector());
        $entry = new \Zimbra\Admin\Struct\AutoProvDirectoryEntry(
            $dn, [$key], [new \Zimbra\Common\Struct\KeyValuePair($key, $value)]
        );
        $this->assertTrue($response->getMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertEquals([$entry], $response->getEntries());
    }

    public function testSearchCalendarResources()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $searchTotal = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchCalendarResourcesResponse more="true" searchTotal="$searchTotal">
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:SearchCalendarResourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->searchCalendarResources();
        $calResources = new \Zimbra\Admin\Struct\CalendarResourceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $this->assertTrue($response->getMore());
        $this->assertSame($searchTotal, $response->getSearchTotal());
        $this->assertEquals([$calResources], $response->getCalResources());
    }

    public function testSearchDirectory()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $member = $this->faker->word;
        $targetName = $this->faker->word;
        $targetType = \Zimbra\Common\Enum\TargetType::ACCOUNT();
        $searchTotal = $this->faker->randomNumber;
        $num = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SearchDirectoryResponse num="$num" more="true" searchTotal="$searchTotal">
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:a n="$key">$value</urn:a>
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
            <urn:alias name="$name" id="$id" targetName="$targetName" type="$targetType">
                <urn:a n="$key">$value</urn:a>
            </urn:alias>
            <urn:account name="$name" id="$id" isExternal="true">
                <urn:a n="$key">$value</urn:a>
            </urn:account>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:SearchDirectoryResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAdminApi($this->mockSoapClient($xml));
        $response = $api->searchDirectory();

        $calResource = new \Zimbra\Admin\Struct\CalendarResourceInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $dl = new \Zimbra\Admin\Struct\DistributionListInfo(
            $name, $id, [$member], [new \Zimbra\Admin\Struct\Attr($key, $value)], [new \Zimbra\Admin\Struct\GranteeInfo($id, $name, \Zimbra\Common\Enum\GranteeType::ALL())], TRUE
        );
        $alias = new \Zimbra\Admin\Struct\AliasInfo(
            $name, $id, $targetName, $targetType, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $account = new \Zimbra\Admin\Struct\AccountInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $domainInfo = new \Zimbra\Admin\Struct\DomainInfo(
            $name, $id, [new \Zimbra\Admin\Struct\Attr($key, $value)]
        );
        $cos = new \Zimbra\Admin\Struct\CosInfo(
            $name, $id, TRUE, [new \Zimbra\Admin\Struct\CosInfoAttr($key, $value, TRUE, FALSE)]
        );

        $this->assertSame($num, $response->getNum());
        $this->assertTrue($response->isMore());
        $this->assertEquals($searchTotal, $response->getSearchTotal());
        $this->assertEquals([$calResource], $response->getCalendarResources());
        $this->assertEquals([$dl], $response->getDistributionLists());
        $this->assertEquals([$alias], $response->getAliases());
        $this->assertEquals([$account], $response->getAccounts());
        $this->assertEquals([$domainInfo], $response->getDomains());
        $this->assertEquals([$cos], $response->getCOSes());
    }
}

class StubAdminApi extends AdminApi
{
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }
}
