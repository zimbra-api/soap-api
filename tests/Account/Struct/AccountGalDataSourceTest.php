<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Account\Struct\AccountGalDataSource;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountGalDataSource.
 */
class AccountGalDataSourceTest extends ZimbraTestCase
{
    public function testAccountGalDataSource()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $folderId = $this->faker->word;
        $host = $this->faker->ipv4;
        $port = mt_rand(1, 100);
        $connectionType = ConnectionType::CLEAR_TEXT;
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

        $gal = new MockAccountGalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="cleartext" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" xmlns:urn="urn:zimbraAccount">
    <urn:lastError>$lastError</urn:lastError>
    <urn:a>$attribute1</urn:a>
    <urn:a>$attribute2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($gal, 'xml'));
        $this->assertEquals($gal, $this->serializer->deserialize($xml, MockAccountGalDataSource::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockAccountGalDataSource extends AccountGalDataSource
{
}
