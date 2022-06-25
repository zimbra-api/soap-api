<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Account\Struct\AccountImapDataSource;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountImapDataSource.
 */
class AccountImapDataSourceTest extends ZimbraTestCase
{
    public function testAccountImapDataSource()
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
    <lastError>$lastError</lastError>
    <a>$attribute1</a>
    <a>$attribute2</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($imap, 'xml'));
        $this->assertEquals($imap, $this->serializer->deserialize($xml, AccountImapDataSource::class, 'xml'));
    }
}
