<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Enum\ConnectionType;
use Zimbra\Account\Struct\AccountContactsDataSource;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountContactsDataSource.
 */
class AccountContactsDataSourceTest extends ZimbraTestCase
{
    public function testAccountContactsDataSource()
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

        $contacts = new AccountContactsDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<contacts id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
    <lastError>$lastError</lastError>
    <a>$attribute1</a>
    <a>$attribute2</a>
</contacts>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($contacts, 'xml'));
        $this->assertEquals($contacts, $this->serializer->deserialize($xml, AccountContactsDataSource::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($contacts, 'json'));
        $this->assertEquals($contacts, $this->serializer->deserialize($json, AccountContactsDataSource::class, 'json'));
    }
}