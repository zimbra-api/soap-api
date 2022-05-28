<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Account\Struct\AccountDataSource;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountDataSource.
 */
class AccountDataSourceTest extends ZimbraTestCase
{
    public function testAccountDataSource()
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

        $dataSource = new AccountDataSource(
            $id, $name, $folderId, FALSE, FALSE, $host, $port, $connectionType, $username, $password,
            $pollingInterval, $emailAddress, FALSE, $defaultSignature, $forwardReplySignature,
            $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError,
            $attributes, $refreshToken, $refreshTokenUrl
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

        $dataSource = new AccountDataSource();
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
            ->setUseAddressForForwardReply(TRUE)
            ->setDefaultSignature($defaultSignature)
            ->setForwardReplySignature($forwardReplySignature)
            ->setFromDisplay($fromDisplay)
            ->setReplyToAddress($replyToAddress)
            ->setReplyToDisplay($replyToDisplay)
            ->setImportClass($importClass)
            ->setFailingSince($failingSince)
            ->setLastError($lastError)
            ->setAttributes($attributes)
            ->addAttribute($attribute)
            ->setRefreshToken($refreshToken)
            ->setRefreshTokenUrl($refreshTokenUrl);
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
<result id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
    <lastError>$lastError</lastError>
    <a>$attribute1</a>
    <a>$attribute2</a>
    <a>$attribute</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dataSource, 'xml'));
        $this->assertEquals($dataSource, $this->serializer->deserialize($xml, AccountDataSource::class, 'xml'));

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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dataSource, 'json'));
        $this->assertEquals($dataSource, $this->serializer->deserialize($json, AccountDataSource::class, 'json'));
    }
}
