<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\SerializerFactory;
use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Mail\SerializerHandler;

use Zimbra\Mail\Message\GetDataSourcesEnvelope;
use Zimbra\Mail\Message\GetDataSourcesBody;
use Zimbra\Mail\Message\GetDataSourcesRequest;
use Zimbra\Mail\Message\GetDataSourcesResponse;

use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;
use Zimbra\Mail\Struct\MailCaldavDataSource;
use Zimbra\Mail\Struct\MailYabDataSource;
use Zimbra\Mail\Struct\MailRssDataSource;
use Zimbra\Mail\Struct\MailGalDataSource;
use Zimbra\Mail\Struct\MailCalDataSource;
use Zimbra\Mail\Struct\MailUnknownDataSource;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDataSources.
 */
class GetDataSourcesTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testGetDataSources()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $folderId = $this->faker->word;
        $host = $this->faker->ipv4;
        $port = $this->faker->randomNumber;
        $connectionType = ConnectionType::CLEAR_TEXT();
        $username = $this->faker->email;
        $password = $this->faker->text;
        $pollingInterval = $this->faker->word;
        $emailAddress = $this->faker->email;
        $smtpHost = $this->faker->ipv4;
        $smtpPort = $this->faker->randomNumber;
        $smtpConnectionType = ConnectionType::CLEAR_TEXT();
        $smtpUsername = $this->faker->email;
        $smtpPassword = $this->faker->text;
        $defaultSignature = $this->faker->word;
        $forwardReplySignature = $this->faker->word;
        $fromDisplay = $this->faker->name;
        $replyToAddress = $this->faker->email;
        $replyToDisplay = $this->faker->name;
        $importClass = $this->faker->text;
        $failingSince = $this->faker->randomNumber;
        $lastError = $this->faker->text;
        $refreshToken = $this->faker->text;
        $refreshTokenUrl = $this->faker->url;
        $attribute = $this->faker->unique()->text;
        $attribute1 = $this->faker->unique()->text;
        $attribute2 = $this->faker->unique()->text;
        $attributes = [
            $attribute1,
            $attribute2,
            $attribute,
        ];

        $imap = new MailImapDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $pop3 = new MailPop3DataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $caldav = new MailCaldavDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $yab = new MailYabDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $rss = new MailRssDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $gal = new MailGalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $cal = new MailCalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $unknown = new MailUnknownDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );

        $request = new GetDataSourcesRequest();
        $response = new GetDataSourcesResponse([
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
        ], $response->getDataSources());
        $response = new GetDataSourcesResponse();
        $response->setDataSources([
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
        ], $response->getDataSources());

        $body = new GetDataSourcesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDataSourcesBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDataSourcesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDataSourcesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetDataSourcesRequest />
        <urn:GetDataSourcesResponse>
            <imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </imap>
            <pop3 id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </pop3>
            <caldav id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </caldav>
            <yab id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </yab>
            <rss id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </rss>
            <gal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </gal>
            <cal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </cal>
            <unknown id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </unknown>
        </urn:GetDataSourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDataSourcesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetDataSourcesRequest' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetDataSourcesResponse' => [
                    'imap' => [
                        [
                            'id' => $id,
                            'name' => $name,
                            'l' => $folderId,
                            'isEnabled' => TRUE,
                            'importOnly' => TRUE,
                            'host' => $host,
                            'port' => $port,
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
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
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
                                ],
                            ],
                            'refreshToken' => $refreshToken,
                            'refreshTokenUrl' => $refreshTokenUrl,
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
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
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
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
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
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
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
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
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
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
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
                            'connectionType' => 'cleartext',
                            'username' => $username,
                            'password' => $password,
                            'pollingInterval' => $pollingInterval,
                            'emailAddress' => $emailAddress,
                            'smtpEnabled' => TRUE,
                            'smtpHost' => $smtpHost,
                            'smtpPort' => $smtpPort,
                            'smtpConnectionType' => 'cleartext',
                            'smtpAuthRequired' => TRUE,
                            'smtpUsername' => $smtpUsername,
                            'smtpPassword' => $smtpPassword,
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
                                [
                                    '_content' => $attribute,
                                ],
                            ],
                            'refreshToken' => $refreshToken,
                            'refreshTokenUrl' => $refreshTokenUrl,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetDataSourcesEnvelope::class, 'json'));
    }
}
