<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ConnectionType;

use Zimbra\Mail\Message\ModifyDataSourceEnvelope;
use Zimbra\Mail\Message\ModifyDataSourceBody;
use Zimbra\Mail\Message\ModifyDataSourceRequest;
use Zimbra\Mail\Message\ModifyDataSourceResponse;

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
 * Testcase class for ModifyDataSource.
 */
class ModifyDataSourceTest extends ZimbraTestCase
{
    public function testModifyDataSource()
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

        $request = new ModifyDataSourceRequest($imap);
        $this->assertSame($imap, $request->getImapDataSource());
        $request = new ModifyDataSourceRequest($pop3);
        $this->assertSame($pop3, $request->getPop3DataSource());
        $request = new ModifyDataSourceRequest($caldav);
        $this->assertSame($caldav, $request->getCaldavDataSource());
        $request = new ModifyDataSourceRequest($yab);
        $this->assertSame($yab, $request->getYabDataSource());
        $request = new ModifyDataSourceRequest($rss);
        $this->assertSame($rss, $request->getRssDataSource());
        $request = new ModifyDataSourceRequest($gal);
        $this->assertSame($gal, $request->getGalDataSource());
        $request = new ModifyDataSourceRequest($cal);
        $this->assertSame($cal, $request->getCalDataSource());
        $request = new ModifyDataSourceRequest($unknown);
        $this->assertSame($unknown, $request->getUnknownDataSource());

        $request->setDataSource($imap);
        $this->assertSame($imap, $request->getImapDataSource());
        $request->setDataSource($pop3);
        $this->assertSame($pop3, $request->getPop3DataSource());
        $request->setDataSource($caldav);
        $this->assertSame($caldav, $request->getCaldavDataSource());
        $request->setDataSource($yab);
        $this->assertSame($yab, $request->getYabDataSource());
        $request->setDataSource($rss);
        $this->assertSame($rss, $request->getRssDataSource());
        $request->setDataSource($gal);
        $this->assertSame($gal, $request->getGalDataSource());
        $request->setDataSource($cal);
        $this->assertSame($cal, $request->getCalDataSource());
        $request->setDataSource($unknown);
        $this->assertSame($unknown, $request->getUnknownDataSource());

        $request = new ModifyDataSourceRequest($imap);
        $response = new ModifyDataSourceResponse();

        $body = new ModifyDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyDataSourceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyDataSourceRequest>
            <urn:imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" oauthToken="$oauthToken" clientId="$clientId" clientSecret="$clientSecret" test="true">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:imap>
        </urn:ModifyDataSourceRequest>
        <urn:ModifyDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyDataSourceEnvelope::class, 'xml'));
    }
}
