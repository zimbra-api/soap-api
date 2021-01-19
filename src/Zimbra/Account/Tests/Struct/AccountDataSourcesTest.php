<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Common\SerializerFactory;
use Zimbra\Account\SerializerHandler;
use Zimbra\Account\Struct\AccountDataSources;
use Zimbra\Account\Struct\AccountImapDataSource;
use Zimbra\Account\Struct\AccountPop3DataSource;
use Zimbra\Account\Struct\AccountCaldavDataSource;
use Zimbra\Account\Struct\AccountYabDataSource;
use Zimbra\Account\Struct\AccountRssDataSource;
use Zimbra\Account\Struct\AccountGalDataSource;
use Zimbra\Account\Struct\AccountCalDataSource;
use Zimbra\Account\Struct\AccountUnknownDataSource;
use Zimbra\Enum\ConnectionType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AccountDataSources.
 */
class AccountDataSourcesTest extends ZimbraStructTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testAccountDataSources()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
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

        $imap = new AccountImapDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $pop3 = new AccountPop3DataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
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
        $pop3->setLeaveOnServer(TRUE);

        $dataSources = new AccountDataSources([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ]);
        $this->assertEquals([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ], $dataSources->getDataSources());

        $dataSources = new AccountDataSources();
        $dataSources->setDataSources([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
        ])
        ->addDataSource($unknown);
        $this->assertEquals([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ], $dataSources->getDataSources());

        $xml = <<<EOT
<?xml version="1.0"?>
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
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dataSources, 'xml'));
        $this->assertEquals($dataSources, $this->serializer->deserialize($xml, AccountDataSources::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dataSources, 'json'));
        $this->assertEquals($dataSources, $this->serializer->deserialize($json, AccountDataSources::class, 'json'));
    }
}
