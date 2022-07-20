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
}

class StubAdminApi extends AdminApi
{
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }
}
