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
}

class StubAdminApi extends AdminApi
{
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }
}
