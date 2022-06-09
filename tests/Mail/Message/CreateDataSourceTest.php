<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\SerializerFactory;
use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Mail\SerializerHandler;

use Zimbra\Mail\Message\CreateDataSourceEnvelope;
use Zimbra\Mail\Message\CreateDataSourceBody;
use Zimbra\Mail\Message\CreateDataSourceRequest;
use Zimbra\Mail\Message\CreateDataSourceResponse;

use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;
use Zimbra\Mail\Struct\MailCaldavDataSource;
use Zimbra\Mail\Struct\MailYabDataSource;
use Zimbra\Mail\Struct\MailRssDataSource;
use Zimbra\Mail\Struct\MailGalDataSource;
use Zimbra\Mail\Struct\MailCalDataSource;
use Zimbra\Mail\Struct\MailUnknownDataSource;

use Zimbra\Mail\Struct\ImapDataSourceId;
use Zimbra\Mail\Struct\Pop3DataSourceId;
use Zimbra\Mail\Struct\CaldavDataSourceId;
use Zimbra\Mail\Struct\YabDataSourceId;
use Zimbra\Mail\Struct\RssDataSourceId;
use Zimbra\Mail\Struct\GalDataSourceId;
use Zimbra\Mail\Struct\CalDataSourceId;
use Zimbra\Mail\Struct\UnknownDataSourceId;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateDataSource.
 */
class CreateDataSourceTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testCreateDataSource()
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
        $oauthToken = $this->faker->text;
        $clientId = $this->faker->text;
        $clientSecret = $this->faker->text;

        $imap = new MailImapDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $imap->setOAuthToken($oauthToken)
            ->setClientId($clientId)
            ->setClientSecret($clientSecret)
            ->setTest(TRUE);
        $pop3 = new MailPop3DataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            TRUE, $smtpHost, $smtpPort, $smtpConnectionType, TRUE, $smtpUsername, $smtpPassword,
            TRUE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $pop3->setLeaveOnServer(TRUE);
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

        $request = new CreateDataSourceRequest($imap);
        $this->assertSame($imap, $request->getDataSource());
        $request = new CreateDataSourceRequest($pop3);
        $this->assertSame($pop3, $request->getDataSource());
        $request = new CreateDataSourceRequest($caldav);
        $this->assertSame($caldav, $request->getDataSource());
        $request = new CreateDataSourceRequest($yab);
        $this->assertSame($yab, $request->getDataSource());
        $request = new CreateDataSourceRequest($rss);
        $this->assertSame($rss, $request->getDataSource());
        $request = new CreateDataSourceRequest($gal);
        $this->assertSame($gal, $request->getDataSource());
        $request = new CreateDataSourceRequest($cal);
        $this->assertSame($cal, $request->getDataSource());
        $request = new CreateDataSourceRequest($unknown);
        $this->assertSame($unknown, $request->getDataSource());

        $request->setDataSource($imap);
        $this->assertSame($imap, $request->getDataSource());
        $request->setDataSource($pop3);
        $this->assertSame($pop3, $request->getDataSource());
        $request->setDataSource($caldav);
        $this->assertSame($caldav, $request->getDataSource());
        $request->setDataSource($yab);
        $this->assertSame($yab, $request->getDataSource());
        $request->setDataSource($rss);
        $this->assertSame($rss, $request->getDataSource());
        $request->setDataSource($gal);
        $this->assertSame($gal, $request->getDataSource());
        $request->setDataSource($cal);
        $this->assertSame($cal, $request->getDataSource());
        $request->setDataSource($unknown);
        $this->assertSame($unknown, $request->getDataSource());

        $imapId = new ImapDataSourceId($id);
        $pop3Id = new Pop3DataSourceId($id);
        $caldavId = new CaldavDataSourceId($id);
        $yabId = new YabDataSourceId($id);
        $rssId = new RssDataSourceId($id);
        $galId = new GalDataSourceId($id);
        $calId = new CalDataSourceId($id);
        $unknownId = new UnknownDataSourceId($id);

        $response = new CreateDataSourceResponse($imapId);
        $this->assertSame($imapId, $response->getDataSource());
        $response = new CreateDataSourceResponse($pop3Id);
        $this->assertSame($pop3Id, $response->getDataSource());
        $response = new CreateDataSourceResponse($caldavId);
        $this->assertSame($caldavId, $response->getDataSource());
        $response = new CreateDataSourceResponse($yabId);
        $this->assertSame($yabId, $response->getDataSource());
        $response = new CreateDataSourceResponse($rssId);
        $this->assertSame($rssId, $response->getDataSource());
        $response = new CreateDataSourceResponse($galId);
        $this->assertSame($galId, $response->getDataSource());
        $response = new CreateDataSourceResponse($calId);
        $this->assertSame($calId, $response->getDataSource());
        $response = new CreateDataSourceResponse($unknownId);
        $this->assertSame($unknownId, $response->getDataSource());

        $response->setDataSource($imapId);
        $this->assertSame($imapId, $response->getDataSource());
        $response->setDataSource($pop3Id);
        $this->assertSame($pop3Id, $response->getDataSource());
        $response->setDataSource($caldavId);
        $this->assertSame($caldavId, $response->getDataSource());
        $response->setDataSource($yabId);
        $this->assertSame($yabId, $response->getDataSource());
        $response->setDataSource($rssId);
        $this->assertSame($rssId, $response->getDataSource());
        $response->setDataSource($galId);
        $this->assertSame($galId, $response->getDataSource());
        $response->setDataSource($calId);
        $this->assertSame($calId, $response->getDataSource());
        $response->setDataSource($unknownId);
        $this->assertSame($unknownId, $response->getDataSource());

        $request = new CreateDataSourceRequest($imap);
        $response = new CreateDataSourceResponse($imapId);

        $body = new CreateDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateDataSourceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateDataSourceRequest>
            <imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" oauthToken="$oauthToken" clientId="$clientId" clientSecret="$clientSecret" test="true">
                <lastError>$lastError</lastError>
                <a>$attribute1</a>
                <a>$attribute2</a>
                <a>$attribute</a>
            </imap>
        </urn:CreateDataSourceRequest>
        <urn:CreateDataSourceResponse>
            <imap id="$id" />
        </urn:CreateDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDataSourceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateDataSourceRequest' => [
                    'imap' => [
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
                        'oauthToken' => $oauthToken,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'test' => TRUE,
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
                    '_jsns' => 'urn:zimbraMail',
                ],
                'CreateDataSourceResponse' => [
                    'imap' => [
                        'id' => $id,
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateDataSourceEnvelope::class, 'json'));
    }
}
