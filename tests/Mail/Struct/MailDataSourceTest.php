<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Mail\Struct\MailDataSource;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailDataSource.
 */
class MailDataSourceTest extends ZimbraTestCase
{
    public function testMailDataSource()
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
        ];

        $dataSource = new StubMailDataSource(
            $id, $name, $folderId, FALSE, FALSE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress,
            FALSE, $smtpHost, $smtpPort, $smtpConnectionType, FALSE, $smtpUsername, $smtpPassword,
            FALSE, $defaultSignature, $forwardReplySignature,$fromDisplay, $replyToAddress, $replyToDisplay, $importClass,
            $failingSince, $lastError, $refreshToken, $refreshTokenUrl, $attributes
        );
        $this->assertSame($id, $dataSource->getId());
        $this->assertSame($name, $dataSource->getName());
        $this->assertSame($folderId, $dataSource->getFolderId());
        $this->assertFalse($dataSource->isEnabled());
        $this->assertFalse($dataSource->isImportOnly());
        $this->assertSame($host, $dataSource->getHost());
        $this->assertSame($port, $dataSource->getPort());
        $this->assertSame($connectionType, $dataSource->getConnectionType());
        $this->assertSame($username, $dataSource->getUsername());
        $this->assertSame($password, $dataSource->getPassword());
        $this->assertSame($pollingInterval, $dataSource->getPollingInterval());
        $this->assertSame($emailAddress, $dataSource->getEmailAddress());
        $this->assertFalse($dataSource->isSmtpEnabled());
        $this->assertSame($smtpHost, $dataSource->getSmtpHost());
        $this->assertSame($smtpPort, $dataSource->getSmtpPort());
        $this->assertSame($smtpConnectionType, $dataSource->getSmtpConnectionType());
        $this->assertFalse($dataSource->isSmtpAuthRequired());
        $this->assertSame($smtpUsername, $dataSource->getSmtpUsername());
        $this->assertSame($smtpPassword, $dataSource->getSmtpPassword());
        $this->assertFalse($dataSource->isUseAddressForForwardReply());
        $this->assertSame($defaultSignature, $dataSource->getDefaultSignature());
        $this->assertSame($forwardReplySignature, $dataSource->getForwardReplySignature());
        $this->assertSame($fromDisplay, $dataSource->getFromDisplay());
        $this->assertSame($replyToAddress, $dataSource->getReplyToAddress());
        $this->assertSame($replyToDisplay, $dataSource->getReplyToDisplay());
        $this->assertSame($importClass, $dataSource->getImportClass());
        $this->assertSame($failingSince, $dataSource->getFailingSince());
        $this->assertSame($lastError, $dataSource->getLastError());
        $this->assertSame($attributes, $dataSource->getAttributes());
        $this->assertSame($refreshToken, $dataSource->getRefreshToken());
        $this->assertSame($refreshTokenUrl, $dataSource->getRefreshTokenUrl());

        $dataSource = new StubMailDataSource();
        $dataSource->setId($id)
            ->setName($name)
            ->setFolderId($folderId)
            ->setEnabled(TRUE)
            ->setImportOnly(TRUE)
            ->setHost($host)
            ->setPort($port)
            ->setConnectionType($connectionType)
            ->setUsername($username)
            ->setPassword($password)
            ->setPollingInterval($pollingInterval)
            ->setEmailAddress($emailAddress)
            ->setSmtpEnabled(TRUE)
            ->setSmtpHost($smtpHost)
            ->setSmtpPort($smtpPort)
            ->setSmtpConnectionType($smtpConnectionType)
            ->setSmtpAuthRequired(TRUE)
            ->setSmtpUsername($smtpUsername)
            ->setSmtpPassword($smtpPassword)
            ->setUseAddressForForwardReply(TRUE)
            ->setDefaultSignature($defaultSignature)
            ->setForwardReplySignature($forwardReplySignature)
            ->setFromDisplay($fromDisplay)
            ->setReplyToAddress($replyToAddress)
            ->setReplyToDisplay($replyToDisplay)
            ->setImportClass($importClass)
            ->setFailingSince($failingSince)
            ->setLastError($lastError)
            ->setRefreshToken($refreshToken)
            ->setRefreshTokenUrl($refreshTokenUrl)
            ->setAttributes($attributes)
            ->addAttribute($attribute);
        $this->assertSame($id, $dataSource->getId());
        $this->assertSame($name, $dataSource->getName());
        $this->assertSame($folderId, $dataSource->getFolderId());
        $this->assertTrue($dataSource->isEnabled());
        $this->assertTrue($dataSource->isImportOnly());
        $this->assertSame($host, $dataSource->getHost());
        $this->assertSame($port, $dataSource->getPort());
        $this->assertSame($connectionType, $dataSource->getConnectionType());
        $this->assertSame($username, $dataSource->getUsername());
        $this->assertSame($password, $dataSource->getPassword());
        $this->assertSame($pollingInterval, $dataSource->getPollingInterval());
        $this->assertSame($emailAddress, $dataSource->getEmailAddress());
        $this->assertTrue($dataSource->isSmtpEnabled());
        $this->assertSame($smtpHost, $dataSource->getSmtpHost());
        $this->assertSame($smtpPort, $dataSource->getSmtpPort());
        $this->assertSame($smtpConnectionType, $dataSource->getSmtpConnectionType());
        $this->assertTrue($dataSource->isSmtpAuthRequired());
        $this->assertSame($smtpUsername, $dataSource->getSmtpUsername());
        $this->assertSame($smtpPassword, $dataSource->getSmtpPassword());
        $this->assertTrue($dataSource->isUseAddressForForwardReply());
        $this->assertSame($defaultSignature, $dataSource->getDefaultSignature());
        $this->assertSame($forwardReplySignature, $dataSource->getForwardReplySignature());
        $this->assertSame($fromDisplay, $dataSource->getFromDisplay());
        $this->assertSame($replyToAddress, $dataSource->getReplyToAddress());
        $this->assertSame($replyToDisplay, $dataSource->getReplyToDisplay());
        $this->assertSame($importClass, $dataSource->getImportClass());
        $this->assertSame($failingSince, $dataSource->getFailingSince());
        $this->assertSame($lastError, $dataSource->getLastError());
        $this->assertSame([
            $attribute1,
            $attribute2,
            $attribute,
        ], $dataSource->getAttributes());
        $this->assertSame($refreshToken, $dataSource->getRefreshToken());
        $this->assertSame($refreshTokenUrl, $dataSource->getRefreshTokenUrl());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" smtpEnabled="true" smtpHost="$smtpHost" smtpPort="$smtpPort" smtpConnectionType="cleartext" smtpAuthRequired="true" smtpUsername="$smtpUsername" smtpPassword="$smtpPassword" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" xmlns:urn="urn:zimbraMail">
    <urn:lastError>$lastError</urn:lastError>
    <urn:a>$attribute1</urn:a>
    <urn:a>$attribute2</urn:a>
    <urn:a>$attribute</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dataSource, 'xml'));
        $this->assertEquals($dataSource, $this->serializer->deserialize($xml, StubMailDataSource::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubMailDataSource extends MailDataSource
{
}
