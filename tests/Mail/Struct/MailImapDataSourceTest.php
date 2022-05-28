<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Mail\Struct\MailDataSource;
use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailImapDataSource.
 */
class MailImapDataSourceTest extends ZimbraTestCase
{
    public function testMailImapDataSource()
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
        $this->assertEquals($oauthToken, $imap->getOAuthToken());
        $this->assertEquals($clientId, $imap->getClientId());
        $this->assertEquals($clientSecret, $imap->getClientSecret());
        $this->assertTrue($imap->isTest());
        $this->assertTrue($imap instanceof MailDataSource);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" oauthToken="$oauthToken" clientId="$clientId" clientSecret="$clientSecret" test="true">
    <lastError>$lastError</lastError>
    <a>$attribute1</a>
    <a>$attribute2</a>
    <a>$attribute</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($imap, 'xml'));
        $this->assertEquals($imap, $this->serializer->deserialize($xml, MailImapDataSource::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($imap, 'json'));
        $this->assertEquals($imap, $this->serializer->deserialize($json, MailImapDataSource::class, 'json'));
    }
}
