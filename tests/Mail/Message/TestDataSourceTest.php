<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\ConnectionType;

use Zimbra\Mail\Message\TestDataSourceEnvelope;
use Zimbra\Mail\Message\TestDataSourceBody;
use Zimbra\Mail\Message\TestDataSourceRequest;
use Zimbra\Mail\Message\TestDataSourceResponse;

use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;
use Zimbra\Mail\Struct\MailCaldavDataSource;
use Zimbra\Mail\Struct\MailYabDataSource;
use Zimbra\Mail\Struct\MailRssDataSource;
use Zimbra\Mail\Struct\MailGalDataSource;
use Zimbra\Mail\Struct\MailCalDataSource;
use Zimbra\Mail\Struct\MailUnknownDataSource;
use Zimbra\Mail\Struct\TestDataSource;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TestDataSource.
 */
class TestDataSourceTest extends ZimbraTestCase
{
    public function testTestDataSource()
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

        $request = new TestDataSourceRequest($imap);
        $this->assertSame($imap, $request->getImapDataSource());
        $request = new TestDataSourceRequest($pop3);
        $this->assertSame($pop3, $request->getPop3DataSource());
        $request = new TestDataSourceRequest($caldav);
        $this->assertSame($caldav, $request->getCaldavDataSource());
        $request = new TestDataSourceRequest($yab);
        $this->assertSame($yab, $request->getYabDataSource());
        $request = new TestDataSourceRequest($rss);
        $this->assertSame($rss, $request->getRssDataSource());
        $request = new TestDataSourceRequest($gal);
        $this->assertSame($gal, $request->getGalDataSource());
        $request = new TestDataSourceRequest($cal);
        $this->assertSame($cal, $request->getCalDataSource());
        $request = new TestDataSourceRequest($unknown);
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
        $request = new TestDataSourceRequest($imap);

        $error = $this->faker->text;
        $success = $this->faker->randomNumber;
        $test = new TestDataSource(
            $success, $error
        );
        $response = new TestDataSourceResponse();
        $response->setImapDataSources([$test])
            ->setPop3DataSources([$test])
            ->setCaldavDataSources([$test])
            ->setYabDataSources([$test])
            ->setRssDataSources([$test])
            ->setGalDataSources([$test])
            ->setCalDataSources([$test])
            ->setUnknownDataSources([$test]);
        $this->assertSame([$test], $response->getImapDataSources());
        $this->assertSame([$test], $response->getPop3DataSources());
        $this->assertSame([$test], $response->getCaldavDataSources());
        $this->assertSame([$test], $response->getYabDataSources());
        $this->assertSame([$test], $response->getRssDataSources());
        $this->assertSame([$test], $response->getGalDataSources());
        $this->assertSame([$test], $response->getCalDataSources());
        $this->assertSame([$test], $response->getUnknownDataSources());
        $this->assertSame([
            $test,
            $test,
            $test,
            $test,
            $test,
            $test,
            $test,
            $test,
        ], array_values($response->getDataSources()));

        $body = new TestDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new TestDataSourceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new TestDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new TestDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:TestDataSourceRequest>
            <urn:imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" oauthToken="$oauthToken" clientId="$clientId" clientSecret="$clientSecret" test="true">
                <urn:lastError>$lastError</urn:lastError>
                <urn:a>$attribute1</urn:a>
                <urn:a>$attribute2</urn:a>
                <urn:a>$attribute</urn:a>
            </urn:imap>
        </urn:TestDataSourceRequest>
        <urn:TestDataSourceResponse>
            <urn:imap success="$success" error="$error" />
            <urn:pop3 success="$success" error="$error" />
            <urn:caldav success="$success" error="$error" />
            <urn:yab success="$success" error="$error" />
            <urn:rss success="$success" error="$error" />
            <urn:gal success="$success" error="$error" />
            <urn:cal success="$success" error="$error" />
            <urn:unknown success="$success" error="$error" />
        </urn:TestDataSourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, TestDataSourceEnvelope::class, 'xml'));
    }
}
