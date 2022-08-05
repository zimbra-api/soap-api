<?php declare(strict_types=1);

namespace Zimbra\Tests\Account;

use Zimbra\Account\{AccountApi, AccountApiInterface};
use Zimbra\Common\Soap\ClientInterface;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for account api.
 */
class AccountApiTest extends ZimbraTestCase
{
    public function testAccountApi()
    {
        $api = $this->createStub(AccountApi::class);
        $this->assertInstanceOf(AccountApiInterface::class, $api);
    }

    public function testAuth()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $type = $this->faker->word;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->sha256;
        $deviceId = $this->faker->uuid;
        $trustedToken = $this->faker->sha256;
        $time = $this->faker->unixTime;
        $lifetime = $this->faker->randomNumber;
        $trustLifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:AuthResponse zmgProxy="true">
            <urn:authToken>$token</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:trustLifetime>$trustLifetime</urn:trustLifetime>
            <urn:session type="$type" id="$id">$id</urn:session>
            <urn:refer>$refer</urn:refer>
            <urn:skin>$skin</urn:skin>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:deviceId>$deviceId</urn:deviceId>
            <urn:trustedToken>$trustedToken</urn:trustedToken>
            <urn:prefs>
                <urn:pref name="$name" modified="$time">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>
            <urn:trustedDevicesEnabled>true</urn:trustedDevicesEnabled>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->auth();
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($refer, $response->getRefer());
        $this->assertSame($skin, $response->getSkin());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($deviceId, $response->getDeviceId());
        $this->assertSame($trustedToken, $response->getTrustedToken());
        $this->assertSame($trustLifetime, $response->getTrustLifetime());
        $this->assertTrue($response->getZmgProxy());
        $this->assertTrue($response->getTwoFactorAuthRequired());
        $this->assertTrue($response->getTrustedDevicesEnabled());

        $session = new \Zimbra\Account\Struct\Session($id, $type);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, TRUE);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $time);
        $this->assertEquals($session, $response->getSession());
        $this->assertEquals([$pref], $response->getPrefs());
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testAuthByAccountName()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $type = $this->faker->word;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->sha256;
        $deviceId = $this->faker->uuid;
        $trustedToken = $this->faker->sha256;
        $time = $this->faker->unixTime;
        $lifetime = $this->faker->randomNumber;
        $trustLifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:AuthResponse zmgProxy="true">
            <urn:authToken>$token</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:trustLifetime>$trustLifetime</urn:trustLifetime>
            <urn:session type="$type" id="$id">$id</urn:session>
            <urn:refer>$refer</urn:refer>
            <urn:skin>$skin</urn:skin>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:deviceId>$deviceId</urn:deviceId>
            <urn:trustedToken>$trustedToken</urn:trustedToken>
            <urn:prefs>
                <urn:pref name="$name" modified="$time">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>
            <urn:trustedDevicesEnabled>true</urn:trustedDevicesEnabled>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->authByAccountName($this->faker->email, $this->faker->word);
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($refer, $response->getRefer());
        $this->assertSame($skin, $response->getSkin());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($deviceId, $response->getDeviceId());
        $this->assertSame($trustedToken, $response->getTrustedToken());
        $this->assertSame($trustLifetime, $response->getTrustLifetime());
        $this->assertTrue($response->getZmgProxy());
        $this->assertTrue($response->getTwoFactorAuthRequired());
        $this->assertTrue($response->getTrustedDevicesEnabled());

        $session = new \Zimbra\Account\Struct\Session($id, $type);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, TRUE);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $time);
        $this->assertEquals($session, $response->getSession());
        $this->assertEquals([$pref], $response->getPrefs());
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testAuthByAccountId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $type = $this->faker->word;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->sha256;
        $deviceId = $this->faker->uuid;
        $trustedToken = $this->faker->sha256;
        $time = $this->faker->unixTime;
        $lifetime = $this->faker->randomNumber;
        $trustLifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:AuthResponse zmgProxy="true">
            <urn:authToken>$token</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:trustLifetime>$trustLifetime</urn:trustLifetime>
            <urn:session type="$type" id="$id">$id</urn:session>
            <urn:refer>$refer</urn:refer>
            <urn:skin>$skin</urn:skin>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:deviceId>$deviceId</urn:deviceId>
            <urn:trustedToken>$trustedToken</urn:trustedToken>
            <urn:prefs>
                <urn:pref name="$name" modified="$time">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>
            <urn:trustedDevicesEnabled>true</urn:trustedDevicesEnabled>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->authByAccountId($this->faker->uuid, $this->faker->word);
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($refer, $response->getRefer());
        $this->assertSame($skin, $response->getSkin());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($deviceId, $response->getDeviceId());
        $this->assertSame($trustedToken, $response->getTrustedToken());
        $this->assertSame($trustLifetime, $response->getTrustLifetime());
        $this->assertTrue($response->getZmgProxy());
        $this->assertTrue($response->getTwoFactorAuthRequired());
        $this->assertTrue($response->getTrustedDevicesEnabled());

        $session = new \Zimbra\Account\Struct\Session($id, $type);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, TRUE);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $time);
        $this->assertEquals($session, $response->getSession());
        $this->assertEquals([$pref], $response->getPrefs());
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testAuthByToken()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $type = $this->faker->word;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->sha256;
        $deviceId = $this->faker->uuid;
        $trustedToken = $this->faker->sha256;
        $time = $this->faker->unixTime;
        $lifetime = $this->faker->randomNumber;
        $trustLifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:AuthResponse zmgProxy="true">
            <urn:authToken>$token</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:trustLifetime>$trustLifetime</urn:trustLifetime>
            <urn:session type="$type" id="$id">$id</urn:session>
            <urn:refer>$refer</urn:refer>
            <urn:skin>$skin</urn:skin>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:deviceId>$deviceId</urn:deviceId>
            <urn:trustedToken>$trustedToken</urn:trustedToken>
            <urn:prefs>
                <urn:pref name="$name" modified="$time">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>
            <urn:trustedDevicesEnabled>true</urn:trustedDevicesEnabled>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->authByToken($this->faker->sha256);
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($refer, $response->getRefer());
        $this->assertSame($skin, $response->getSkin());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($deviceId, $response->getDeviceId());
        $this->assertSame($trustedToken, $response->getTrustedToken());
        $this->assertSame($trustLifetime, $response->getTrustLifetime());
        $this->assertTrue($response->getZmgProxy());
        $this->assertTrue($response->getTwoFactorAuthRequired());
        $this->assertTrue($response->getTrustedDevicesEnabled());

        $session = new \Zimbra\Account\Struct\Session($id, $type);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, TRUE);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $time);
        $this->assertEquals($session, $response->getSession());
        $this->assertEquals([$pref], $response->getPrefs());
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testAuthByPreauth()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $type = $this->faker->word;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->sha256;
        $deviceId = $this->faker->uuid;
        $trustedToken = $this->faker->sha256;
        $time = $this->faker->unixTime;
        $lifetime = $this->faker->randomNumber;
        $trustLifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:AuthResponse zmgProxy="true">
            <urn:authToken>$token</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:trustLifetime>$trustLifetime</urn:trustLifetime>
            <urn:session type="$type" id="$id">$id</urn:session>
            <urn:refer>$refer</urn:refer>
            <urn:skin>$skin</urn:skin>
            <urn:csrfToken>$csrfToken</urn:csrfToken>
            <urn:deviceId>$deviceId</urn:deviceId>
            <urn:trustedToken>$trustedToken</urn:trustedToken>
            <urn:prefs>
                <urn:pref name="$name" modified="$time">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>
            <urn:trustedDevicesEnabled>true</urn:trustedDevicesEnabled>
        </urn:AuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->authByPreauth($this->faker->email, $this->faker->sha256);
        $this->assertSame($token, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertSame($refer, $response->getRefer());
        $this->assertSame($skin, $response->getSkin());
        $this->assertSame($csrfToken, $response->getCsrfToken());
        $this->assertSame($deviceId, $response->getDeviceId());
        $this->assertSame($trustedToken, $response->getTrustedToken());
        $this->assertSame($trustLifetime, $response->getTrustLifetime());
        $this->assertTrue($response->getZmgProxy());
        $this->assertTrue($response->getTwoFactorAuthRequired());
        $this->assertTrue($response->getTrustedDevicesEnabled());

        $session = new \Zimbra\Account\Struct\Session($id, $type);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, TRUE);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $time);
        $this->assertEquals($session, $response->getSession());
        $this->assertEquals([$pref], $response->getPrefs());
        $this->assertEquals([$attr], $response->getAttrs());
    }

    public function testAutoCompleteGal()
    {
        $name = $this->faker->word;
        $email = $this->faker->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:AutoCompleteGalResponse more="true" tokenizeKey="false" paginationSupported="true">
            <urn:cn email="$email" />
        </urn:AutoCompleteGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->autoCompleteGal($name);
        $this->assertTrue($response->getMore());
        $this->assertFalse($response->getTokenizeKey());
        $this->assertTrue($response->getPagingSupported());

        $contact = new \Zimbra\Account\Struct\ContactInfo();
        $contact->setEmail($email);
        $this->assertEquals([$contact], $response->getContacts());
    }

    public function testChangePassword()
    {
        $oldPassword = $this->faker->word;
        $newPassword = $this->faker->word;
        $authToken = $this->faker->sha256;
        $lifetime = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ChangePasswordResponse>
            <urn:authToken>$authToken</urn:authToken>
            <urn:lifetime>$lifetime</urn:lifetime>
        </urn:ChangePasswordResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->changePassword(
            new \Zimbra\Common\Struct\AccountSelector(), $oldPassword, $newPassword
        );
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
    }

    public function testCheckRights()
    {
        $key = $this->faker->unique->word;
        $right = $this->faker->unique->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CheckRightsResponse>
            <urn:target type="account" by="name" key="$key" allow="true">
                <urn:right allow="true">$right</urn:right>
            </urn:target>
        </urn:CheckRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->checkRights();
        $rightInfo = new \Zimbra\Account\Struct\CheckRightsRightInfo($right, TRUE);
        $targetInfo = new \Zimbra\Account\Struct\CheckRightsTargetInfo(
            \Zimbra\Common\Enum\TargetType::ACCOUNT(), \Zimbra\Common\Enum\TargetBy::NAME(), $key, TRUE, [$rightInfo]
        );
        $this->assertEquals([$targetInfo], $response->getTargets());
    }

    public function testClientInfo()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ClientInfoResponse>
            <urn:a n="$key">$value</urn:a>
        </urn:ClientInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->clientInfo(new \Zimbra\Admin\Struct\DomainSelector());
        $attr = new \Zimbra\Admin\Struct\Attr($key, $value);
        $this->assertEquals([$attr], $response->getAttrList());
    }

    public function testCreateDistributionList()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $displayName = $this->faker->name;
        $ref = $this->faker->word;
        $via = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CreateDistributionListResponse>
            <urn:dl name="$name" id="$id" ref="$ref" d="$displayName" dynamic="true" via="$via" isOwner="true" isMember="true">
                <urn:a n="$key">$value</urn:a>
            </urn:dl>
        </urn:CreateDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->createDistributionList($name);
        $attr = new \Zimbra\Common\Struct\KeyValuePair($key, $value);
        $dl = new \Zimbra\Account\Struct\DLInfo($id, $ref, $name, $displayName, TRUE, $via, TRUE, TRUE, [$attr]);
        $this->assertEquals($dl, $response->getDl());
    }

    public function testCreateIdentity()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CreateIdentityResponse>
            <urn:identity name="$name" id="$id">
                <urn:a name="$name" pd="true">$value</urn:a>
            </urn:identity>
        </urn:CreateIdentityResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->createIdentity(new \Zimbra\Account\Struct\Identity());
        $identity = new \Zimbra\Account\Struct\Identity($name, $id, [
            new \Zimbra\Account\Struct\Attr($name, $value, TRUE)
        ]);
        $this->assertEquals($identity, $response->getIdentity());
    }

    public function testCreateSignature()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CreateSignatureResponse>
            <urn:signature name="$name" id="$id"/>
        </urn:CreateSignatureResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->createSignature(new \Zimbra\Account\Struct\Signature());
        $signature = new \Zimbra\Account\Struct\NameId($name, $id);
        $this->assertEquals($signature, $response->getSignature());
    }

    public function testDeleteIdentity()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DeleteIdentityResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->deleteIdentity(new \Zimbra\Account\Struct\NameId());
        $this->assertInstanceOf(\Zimbra\Account\Message\DeleteIdentityResponse::class, $response);
    }

    public function testDeleteSignature()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DeleteSignatureResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->deleteSignature(new \Zimbra\Account\Struct\NameId());
        $this->assertInstanceOf(\Zimbra\Account\Message\DeleteSignatureResponse::class, $response);
    }

    public function testDiscoverRights()
    {
        $type = \Zimbra\Common\Enum\TargetType::ACCOUNT();
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $displayName = $this->faker->text;
        $addr = $this->faker->email;
        $right = $this->faker->unique->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DiscoverRightsResponse>
            <urn:targets right="$right">
                <urn:target type="$type" id="$id" name="$name" d="$displayName">
                    <urn:email addr="$addr" />
                </urn:target>
            </urn:targets>
        </urn:DiscoverRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->discoverRights();
        $target = new \Zimbra\Account\Struct\DiscoverRightsTarget($type, $id, $name, $displayName, [
            new \Zimbra\Account\Struct\DiscoverRightsEmail($addr)
        ]);
        $targets = new \Zimbra\Account\Struct\DiscoverRightsInfo($right, [$target]);
        $this->assertEquals([$targets], $response->getDiscoveredRights());
    }

    public function testDistributionListAction()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DistributionListActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->distributionListAction(
            new \Zimbra\Common\Struct\DistributionListSelector(), new \Zimbra\Account\Struct\DistributionListAction()
        );
        $this->assertInstanceOf(\Zimbra\Account\Message\DistributionListActionResponse::class, $response);
    }

    public function testEndSession()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:EndSessionResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->endSession();
        $this->assertInstanceOf(\Zimbra\Account\Message\EndSessionResponse::class, $response);
    }

    public function testGetAccountDistributionLists()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $name = $this->faker->email;
        $displayName = $this->faker->name;
        $ref = $this->faker->word;
        $via = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAccountDistributionListsResponse>
            <urn:dl name="$name" id="$id" ref="$ref" d="$displayName" dynamic="true" via="$via" isOwner="true" isMember="true">
                <urn:a n="$key">$value</urn:a>
            </urn:dl>
        </urn:GetAccountDistributionListsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getAccountDistributionLists();
        $dl = new \Zimbra\Account\Struct\DLInfo($id, $ref, $name, $displayName, TRUE, $via, TRUE, TRUE, [
            new \Zimbra\Common\Struct\KeyValuePair($key, $value)
        ]);
        $this->assertEquals([$dl], $response->getDlList());
    }

    public function testGetAccountInfo()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $soapURL = $this->faker->url;
        $publicURL = $this->faker->url;
        $changePasswordURL = $this->faker->url;
        $communityURL = $this->faker->url;
        $adminURL = $this->faker->url;
        $boshURL = $this->faker->url;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAccountInfoResponse>
            <urn:name>$name</urn:name>
            <urn:attr name="$name">$value</urn:attr>
            <urn:soapURL>$soapURL</urn:soapURL>
            <urn:publicURL>$publicURL</urn:publicURL>
            <urn:changePasswordURL>$changePasswordURL</urn:changePasswordURL>
            <urn:communityURL>$communityURL</urn:communityURL>
            <urn:adminURL>$adminURL</urn:adminURL>
            <urn:boshURL>$boshURL</urn:boshURL>
        </urn:GetAccountInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getAccountInfo(new \Zimbra\Common\Struct\AccountSelector());

        $attr = new \Zimbra\Common\Struct\NamedValue($name, $value);
        $this->assertSame($name, $response->getName());
        $this->assertEquals([$attr], $response->getAttrs());
        $this->assertSame($soapURL, $response->getSoapURL());
        $this->assertSame($publicURL, $response->getPublicURL());
        $this->assertSame($changePasswordURL, $response->getChangePasswordURL());
        $this->assertSame($communityURL, $response->getCommunityURL());
        $this->assertSame($adminURL, $response->getAdminURL());
        $this->assertSame($boshURL, $response->getBoshURL());
    }

    public function testGetAllLocales()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->locale;
        $localName = $this->faker->countryCode;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAllLocalesResponse>
            <urn:locale id="$id" name="$name" localName="$localName" />
        </urn:GetAllLocalesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getAllLocales();
        $locale = new \Zimbra\Account\Struct\LocaleInfo($id, $name, $localName);
        $this->assertEquals([$locale], $response->getLocales());
    }

    public function testGetAvailableCsvFormats()
    {
        $name = $this->faker->mimeType;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAvailableCsvFormatsResponse>
            <urn:csv name="$name" />
        </urn:GetAvailableCsvFormatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getAvailableCsvFormats();
        $csv = new \Zimbra\Common\Struct\NamedElement($name);
        $this->assertEquals([$csv], $response->getCsvFormats());
    }

    public function testGetAvailableLocales()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->locale;
        $localName = $this->faker->countryCode;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAvailableLocalesResponse>
            <urn:locale id="$id" name="$name" localName="$localName" />
        </urn:GetAvailableLocalesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getAvailableLocales();
        $locale = new \Zimbra\Account\Struct\LocaleInfo($id, $name, $localName);
        $this->assertEquals([$locale], $response->getLocales());
    }

    public function testGetAvailableSkins()
    {
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAvailableSkinsResponse>
            <urn:skin name="$name" />
        </urn:GetAvailableSkinsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getAvailableSkins();
        $skin = new \Zimbra\Common\Struct\NamedElement($name);
        $this->assertEquals([$skin], $response->getSkins());
    }

    public function testGetDistributionListMembers()
    {
        $dl = $this->faker->email;
        $name = $this->faker->email;
        $seniorityIndex = $this->faker->randomNumber;
        $total = $this->faker->randomNumber;
        $key = $this->faker->word;
        $value = $this->faker->text;
        $member1 = $this->faker->unique->email;
        $member2 = $this->faker->unique->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetDistributionListMembersResponse more="true" total="$total">
            <urn:dlm>$member1</urn:dlm>
            <urn:dlm>$member2</urn:dlm>
            <urn:groupMembers>
                <urn:groupMember seniorityIndex="$seniorityIndex">
                    <urn:name>$name</urn:name>
                    <urn:attr name="$key">$value</urn:attr>
                </urn:groupMember>
            </urn:groupMembers>
        </urn:GetDistributionListMembersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getDistributionListMembers($dl);
        $groupMember = new \Zimbra\Account\Struct\HABGroupMember($name, $seniorityIndex, [
            new \Zimbra\Common\Struct\NamedValue($key, $value)]
        );
        $this->assertSame([$member1, $member2], $response->getDlMembers());
        $this->assertEquals([$groupMember], $response->getHABGroupMembers());
        $this->assertTrue($response->getMore());
        $this->assertSame($total, $response->getTotal());
    }

    public function testGetDistributionList()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $member1 = $this->faker->unique->email;
        $member2 = $this->faker->unique->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetDistributionListResponse>
            <urn:dl name="$name" id="$id" isOwner="true" isMember="true" dynamic="true">
                <urn:a n="$key">$value</urn:a>
                <urn:dlm>$member1</urn:dlm>
                <urn:dlm>$member2</urn:dlm>
                <urn:owners>
                    <urn:owner type="usr" id="$id" name="$name" />
                </urn:owners>
                <urn:rights>
                    <urn:right right="$name">
                        <urn:grantee type="usr" id="$id" name="$name" />
                    </urn:right>
                </urn:rights>
            </urn:dl>
        </urn:GetDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getDistributionList(new \Zimbra\Common\Struct\DistributionListSelector());

        $owner = new \Zimbra\Account\Struct\DistributionListGranteeInfo(
            \Zimbra\Common\Enum\GranteeType::USR(), $id, $name
        );
        $right = new \Zimbra\Account\Struct\DistributionListRightInfo(
            $name, [$owner]
        );
        $dl = new \Zimbra\Account\Struct\DistributionListInfo(
            $name, $id, [new \Zimbra\Common\Struct\KeyValuePair($key, $value)], [$member1, $member2], [$owner], [$right], TRUE, TRUE, TRUE
        );
        $this->assertEquals($dl, $response->getDl());
    }

    public function testGetIdentities()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetIdentitiesResponse>
            <urn:identity name="$name" id="$id">
                <urn:a name="$name" pd="true">$value</urn:a>
            </urn:identity>
        </urn:GetIdentitiesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getIdentities();
        $identity = new \Zimbra\Account\Struct\Identity($name, $id, [
            new \Zimbra\Account\Struct\Attr($name, $value, TRUE)
        ]);
        $this->assertEquals([$identity], $response->getIdentities());
    }

    public function testGetInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->word;
        $modified = $this->faker->randomNumber;
        $zimletName = $this->faker->word;
        $cid = $this->faker->uuid;

        $type = \Zimbra\Common\Enum\TargetType::ACCOUNT();
        $displayName = $this->faker->word;
        $addr = $this->faker->word;
        $right = $this->faker->word;

        $baseUrl = $this->faker->word;
        $priority = $this->faker->randomNumber;
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $hasKeyword = $this->faker->word;
        $extensionClass = $this->faker->word;
        $regex = $this->faker->word;

        $attachmentSizeLimit = $this->faker->randomNumber;
        $documentSizeLimit = $this->faker->randomNumber;
        $version = $this->faker->word;
        $accountId = $this->faker->uuid;
        $profileImageId = $this->faker->randomNumber;
        $accountName = $this->faker->word;
        $crumb = $this->faker->word;
        $lifetime = $this->faker->randomNumber;
        $restUrl = $this->faker->url;
        $quotaUsed = $this->faker->randomNumber;
        $previousSessionTime = $this->faker->unixTime;
        $lastWriteAccessTime = $this->faker->unixTime;
        $recentMessageCount = $this->faker->randomNumber;
        $soapURL = $this->faker->url;
        $publicURL = $this->faker->url;
        $changePasswordURL = $this->faker->url;
        $adminURL = $this->faker->url;
        $boshURL = $this->faker->url;

        $folderId = $this->faker->word;
        $host = $this->faker->ipv4;
        $port = $this->faker->randomNumber;
        $connectionType = \Zimbra\Common\Enum\ConnectionType::CLEAR_TEXT();
        $username = $this->faker->email;
        $password = $this->faker->word;
        $pollingInterval = $this->faker->word;
        $emailAddress = $this->faker->email;
        $defaultSignature = $this->faker->word;
        $forwardReplySignature = $this->faker->word;
        $fromDisplay = $this->faker->name;
        $replyToAddress = $this->faker->email;
        $replyToDisplay = $this->faker->name;
        $importClass = $this->faker->word;
        $failingSince = $this->faker->randomNumber;
        $lastError = $this->faker->word;
        $refreshToken = $this->faker->sha256;
        $refreshTokenUrl = $this->faker->url;
        $attribute1 = $this->faker->unique->word;
        $attribute2 = $this->faker->unique->word;
        $attributes = [
            $attribute1,
            $attribute2,
        ];

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetInfoResponse attSizeLimit="$attachmentSizeLimit" docSizeLimit="$documentSizeLimit">
            <urn:version>$version</urn:version>
            <urn:id>$accountId</urn:id>
            <urn:profileImageId>$profileImageId</urn:profileImageId>
            <urn:name>$accountName</urn:name>
            <urn:crumb>$crumb</urn:crumb>
            <urn:lifetime>$lifetime</urn:lifetime>
            <urn:adminDelegated>true</urn:adminDelegated>
            <urn:rest>$restUrl</urn:rest>
            <urn:used>$quotaUsed</urn:used>
            <urn:prevSession>$previousSessionTime</urn:prevSession>
            <urn:accessed>$lastWriteAccessTime</urn:accessed>
            <urn:recent>$recentMessageCount</urn:recent>
            <urn:cos id="$id" name="$name" />
            <urn:prefs>
                <urn:pref name="$name" modified="$modified">$value</urn:pref>
            </urn:prefs>
            <urn:attrs>
                <urn:attr name="$name" pd="true">$value</urn:attr>
            </urn:attrs>
            <urn:zimlets>
                <urn:zimlet>
                    <urn:zimletContext baseUrl="$baseUrl" priority="$priority" presence="enabled" />
                    <urn:zimlet name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <urn:serverExtension hasKeyword="$hasKeyword" extensionClass="$extensionClass" regex="$regex" />
                        <urn:include>$value</urn:include>
                        <urn:includeCSS>$value</urn:includeCSS>
                    </urn:zimlet>
                    <urn:zimletConfig name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <urn:global>
                            <urn:property name="$name">$value</urn:property>
                        </urn:global>
                        <urn:host name="$name">
                            <urn:property name="$name">$value</urn:property>
                        </urn:host>
                    </urn:zimletConfig>
                </urn:zimlet>
            </urn:zimlets>
            <urn:props>
                <urn:prop zimlet="$zimletName" name="$name">$value</urn:prop>
            </urn:props>
            <urn:identities>
                <urn:identity name="$name" id="$id">
                    <urn:a name="$name" pd="true">$value</urn:a>
                </urn:identity>
            </urn:identities>
            <urn:signatures>
                <urn:signature name="$name" id="$id">
                    <urn:cid>$cid</urn:cid>
                    <urn:content type="text/html">$value</urn:content>
                </urn:signature>
            </urn:signatures>
            <urn:dataSources>
                <urn:imap id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:imap>
                <urn:pop3 id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl" leaveOnServer="true">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:pop3>
                <urn:caldav id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:caldav>
                <urn:yab id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:yab>
                <urn:rss id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:rss>
                <urn:gal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:gal>
                <urn:cal id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:cal>
                <urn:unknown id="$id" name="$name" l="$folderId" isEnabled="true" importOnly="true" host="$host" port="$port" connectionType="$connectionType" username="$username" password="$password" pollingInterval="$pollingInterval" emailAddress="$emailAddress" useAddressForForwardReply="true" defaultSignature="$defaultSignature" forwardReplySignature="$forwardReplySignature" fromDisplay="$fromDisplay" replyToAddress="$replyToAddress" replyToDisplay="$replyToDisplay" importClass="$importClass" failingSince="$failingSince" refreshToken="$refreshToken" refreshTokenUrl="$refreshTokenUrl">
                    <urn:lastError>$lastError</urn:lastError>
                    <urn:a>$attribute1</urn:a>
                    <urn:a>$attribute2</urn:a>
                </urn:unknown>
            </urn:dataSources>
            <urn:childAccounts>
                <urn:childAccount id="$id" name="$name" visible="true" active="true">
                    <urn:attrs>
                        <urn:attr name="$name" pd="true">$value</urn:attr>
                    </urn:attrs>
                </urn:childAccount>
            </urn:childAccounts>
            <urn:rights>
                <urn:targets right="$right">
                    <urn:target type="$type" id="$id" name="$name" d="$displayName">
                        <urn:email addr="$addr" />
                    </urn:target>
                </urn:targets>
            </urn:rights>
            <urn:soapURL>$soapURL</urn:soapURL>
            <urn:publicURL>$publicURL</urn:publicURL>
            <urn:changePasswordURL>$changePasswordURL</urn:changePasswordURL>
            <urn:adminURL>$adminURL</urn:adminURL>
            <urn:boshURL>$boshURL</urn:boshURL>
            <urn:isTrackingIMAP>true</urn:isTrackingIMAP>
        </urn:GetInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getInfo();
        $this->assertSame($attachmentSizeLimit, $response->getAttachmentSizeLimit());
        $this->assertSame($documentSizeLimit, $response->getDocumentSizeLimit());
        $this->assertSame($version, $response->getVersion());
        $this->assertSame($accountId, $response->getAccountId());
        $this->assertSame($profileImageId, $response->getProfileImageId());
        $this->assertSame($accountName, $response->getAccountName());
        $this->assertSame($crumb, $response->getCrumb());
        $this->assertSame($lifetime, $response->getLifetime());
        $this->assertTrue($response->getAdminDelegated());
        $this->assertSame($restUrl, $response->getRestUrl());
        $this->assertSame($quotaUsed, $response->getQuotaUsed());
        $this->assertSame($previousSessionTime, $response->getPreviousSessionTime());
        $this->assertSame($lastWriteAccessTime, $response->getLastWriteAccessTime());
        $this->assertSame($recentMessageCount, $response->getRecentMessageCount());
        $this->assertSame($soapURL, $response->getSoapURL());
        $this->assertSame($publicURL, $response->getPublicURL());
        $this->assertSame($changePasswordURL, $response->getChangePasswordURL());
        $this->assertSame($adminURL, $response->getAdminURL());
        $this->assertSame($boshURL, $response->getBoshURL());
        $this->assertTrue($response->getIsTrackingIMAP());

        $cos = new \Zimbra\Account\Struct\Cos($id, $name);
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);
        $attr = new \Zimbra\Account\Struct\Attr($name, $value, TRUE);
        $prop = new \Zimbra\Account\Struct\Prop($zimletName, $name, $value);
        $childAccount = new \Zimbra\Account\Struct\ChildAccount($id, $name, TRUE, TRUE, [$attr]);
        $identity = new \Zimbra\Account\Struct\Identity($name, $id, [$attr]);
        $signature = new \Zimbra\Account\Struct\Signature($name, $id, $cid, [
            new \Zimbra\Account\Struct\SignatureContent($value, \Zimbra\Common\Enum\ContentType::TEXT_HTML())
        ]);
        $rightsInfo = new \Zimbra\Account\Struct\DiscoverRightsInfo($right, [
            new \Zimbra\Account\Struct\DiscoverRightsTarget($type, $id, $name, $displayName, [
                new \Zimbra\Account\Struct\DiscoverRightsEmail($addr)
            ])
        ]);

        $zimletContext = new \Zimbra\Account\Struct\AccountZimletContext(
            $baseUrl, \Zimbra\Common\Enum\ZimletPresence::ENABLED(), $priority
        );
        $zimletDesc = new \Zimbra\Account\Struct\AccountZimletDesc(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletDesc->setServerExtension(new \Zimbra\Account\Struct\ZimletServerExtension($hasKeyword, $extensionClass, $regex))
            ->setZimletInclude(new \Zimbra\Account\Struct\AccountZimletInclude($value))
            ->setZimletIncludeCSS(new \Zimbra\Account\Struct\AccountZimletIncludeCSS($value));
        $property = new \Zimbra\Account\Struct\AccountZimletProperty($name, $value);
        $zimletConfig = new \Zimbra\Account\Struct\AccountZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletConfig->setGlobal(new \Zimbra\Account\Struct\AccountZimletGlobalConfigInfo([$property]))
            ->setHost(new \Zimbra\Account\Struct\AccountZimletHostConfigInfo($name, [$property]));
        $zimlet = new \Zimbra\Account\Struct\AccountZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );

        $this->assertEquals($cos, $response->getCos());
        $this->assertEquals([$pref], $response->getPrefs());
        $this->assertEquals([$attr], $response->getAttrs());
        $this->assertEquals([$zimlet], $response->getZimlets());
        $this->assertEquals([$prop], $response->getProps());
        $this->assertEquals([$identity], $response->getIdentities());
        $this->assertEquals([$signature], $response->getSignatures());
        $this->assertEquals([$childAccount], $response->getChildAccounts());
        $this->assertEquals([$rightsInfo], $response->getDiscoveredRights());

        $imap = new \Zimbra\Account\Struct\AccountImapDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $pop3 = new \Zimbra\Account\Struct\AccountPop3DataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $pop3->setLeaveOnServer(TRUE);
        $caldav = new \Zimbra\Account\Struct\AccountCaldavDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $yab = new \Zimbra\Account\Struct\AccountYabDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $rss = new \Zimbra\Account\Struct\AccountRssDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $gal = new \Zimbra\Account\Struct\AccountGalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $cal = new \Zimbra\Account\Struct\AccountCalDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $unknown = new \Zimbra\Account\Struct\AccountUnknownDataSource(
            $id, $name, $folderId, TRUE, TRUE, $host, $port, $connectionType, $username, $password, $pollingInterval, $emailAddress, TRUE, $defaultSignature, $forwardReplySignature, $fromDisplay, $replyToAddress, $replyToDisplay, $importClass, $failingSince, $lastError, $attributes, $refreshToken, $refreshTokenUrl
        );
        $dataSources = [
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ];
        $this->assertEquals($dataSources, $response->getDataSources());
    }

    public function testGetOAuthConsumers()
    {
        $accessToken = $this->faker->sha256;
        $approvedOn = $this->faker->word;
        $applicationName = $this->faker->word;
        $device = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetOAuthConsumersResponse>
            <urn:OAuthConsumer accessToken="$accessToken" approvedOn="$approvedOn" appName="$applicationName" device="$device" />
        </urn:GetOAuthConsumersResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getOAuthConsumers();
        $consumer = new \Zimbra\Account\Struct\OAuthConsumer(
            $accessToken, $approvedOn, $applicationName, $device
        );
        $this->assertEquals([$consumer], $response->getConsumers());
    }

    public function testGetPrefs()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = $this->faker->randomNumber;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetPrefsResponse>
            <urn:pref name="$name" modified="$modified">$value</urn:pref>
        </urn:GetPrefsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getPrefs();
        $pref = new \Zimbra\Account\Struct\Pref($name, $value, $modified);
        $this->assertEquals([$pref], $response->getPrefs());
    }

    public function testGetRights()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetRightsResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:GetRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getRights();
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(
            \Zimbra\Common\Enum\GranteeType::USR(), \Zimbra\Common\Enum\AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE, TRUE
        );
        $this->assertEquals([$ace], $response->getAces());
    }

    public function testGetShareInfo()
    {
        $ownerId = $this->faker->uuid;
        $ownerEmail = $this->faker->email;
        $ownerDisplayName = $this->faker->name;
        $folderId = mt_rand(1, 100);
        $folderUuid = $this->faker->uuid;
        $folderPath = $this->faker->word;
        $defaultView = $this->faker->word;
        $rights = $this->faker->word;
        $granteeType = $this->faker->word;
        $granteeId = $this->faker->uuid;
        $granteeName = $this->faker->name;
        $granteeDisplayName = $this->faker->name;
        $mountpointId = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetShareInfoResponse>
            <urn:share ownerId="$ownerId" ownerEmail="$ownerEmail" ownerName="$ownerDisplayName" folderId="$folderId" folderUuid="$folderUuid" folderPath="$folderPath" view="$defaultView" rights="$rights" granteeType="$granteeType" granteeId="$granteeId" granteeName="$granteeName" granteeDisplayName="$granteeDisplayName" mid="$mountpointId" />
        </urn:GetShareInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getShareInfo();
        $share = new \Zimbra\Common\Struct\ShareInfo(
            $ownerId, $ownerEmail, $ownerDisplayName,
            $folderId, $folderUuid, $folderPath,
            $defaultView, $rights,
            $granteeType, $granteeId, $granteeName, $granteeDisplayName,
            $mountpointId
        );
        $this->assertEquals([$share], $response->getShares());
    }

    public function testGetSignatures()
    {
        $value = $this->faker->word;
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $cid = $this->faker->uuid;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetSignaturesResponse>
            <urn:signature name="$name" id="$id">
                <urn:cid>$cid</urn:cid>
                <urn:content type="text/html">$value</urn:content>
            </urn:signature>
        </urn:GetSignaturesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getSignatures();
        $signature = new \Zimbra\Account\Struct\Signature($name, $id, $cid, [
            new \Zimbra\Account\Struct\SignatureContent($value, \Zimbra\Common\Enum\ContentType::TEXT_HTML())
        ]);
        $this->assertEquals([$signature], $response->getSignatures());
    }

    public function testGetVersionInfo()
    {
        $fullVersion = $this->faker->word;
        $release = $this->faker->word;
        $date = $this->faker->date;
        $host = $this->faker->ipv4;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetVersionInfoResponse>
            <urn:info version="$fullVersion" release="$release" buildDate="$date" host="$host" />
        </urn:GetVersionInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getVersionInfo();
        $info = new \Zimbra\Account\Struct\VersionInfo($fullVersion, $release, $date, $host);
        $this->assertEquals($info, $response->getVersionInfo());
    }

    public function testGetWhiteBlackList()
    {
        $white1 = $this->faker->unique->ipv4;
        $white2 = $this->faker->unique->ipv4;
        $black1 = $this->faker->unique->ipv4;
        $black2 = $this->faker->unique->ipv4;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetWhiteBlackListResponse>
            <urn:whiteList>
                <urn:addr>$white1</urn:addr>
                <urn:addr>$white2</urn:addr>
            </urn:whiteList>
            <urn:blackList>
                <urn:addr>$black1</urn:addr>
                <urn:addr>$black2</urn:addr>
            </urn:blackList>
        </urn:GetWhiteBlackListResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->getWhiteBlackList();
        $this->assertSame([$white1, $white2], $response->getWhiteListEntries());
        $this->assertSame([$black1, $black2], $response->getBlackListEntries());
    }

    public function testGrantRights()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GrantRightsResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:GrantRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->grantRights();
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(
            \Zimbra\Common\Enum\GranteeType::USR(), \Zimbra\Common\Enum\AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE, TRUE
        );
        $this->assertEquals([$ace], $response->getAces());
    }

    public function testModifyIdentity()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyIdentityResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->modifyIdentity(new \Zimbra\Account\Struct\Identity());
        $this->assertInstanceOf(\Zimbra\Account\Message\ModifyIdentityResponse::class, $response);
    }

    public function testModifyPrefs()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyPrefsResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->modifyPrefs();
        $this->assertInstanceOf(\Zimbra\Account\Message\ModifyPrefsResponse::class, $response);
    }

    public function testModifyProperties()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyPropertiesResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->modifyProperties();
        $this->assertInstanceOf(\Zimbra\Account\Message\ModifyPropertiesResponse::class, $response);
    }

    public function testModifySignature()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifySignatureResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->modifySignature(new \Zimbra\Account\Struct\Signature());
        $this->assertInstanceOf(\Zimbra\Account\Message\ModifySignatureResponse::class, $response);
    }

    public function testModifyWhiteBlackList()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyWhiteBlackListResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->modifyWhiteBlackList();
        $this->assertInstanceOf(\Zimbra\Account\Message\ModifyWhiteBlackListResponse::class, $response);
    }

    public function testModifyZimletPrefs()
    {
        $name = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyZimletPrefsResponse>
            <urn:zimlet>$name</urn:zimlet>
        </urn:ModifyZimletPrefsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->modifyZimletPrefs();
        $this->assertSame([$name], $response->getZimlets());
    }

    public function testResetPassword()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ResetPasswordResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->resetPassword($this->faker->word);
        $this->assertInstanceOf(\Zimbra\Account\Message\ResetPasswordResponse::class, $response);
    }

    public function testRevokeOAuthConsumer()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:RevokeOAuthConsumerResponse />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->revokeOAuthConsumer($this->faker->word);
        $this->assertInstanceOf(\Zimbra\Account\Message\RevokeOAuthConsumerResponse::class, $response);
    }

    public function testRevokeRights()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $accessKey = $this->faker->word;
        $password = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:RevokeRightsResponse>
            <urn:ace gt="usr" right="invite" zid="$zimbraId" d="$displayName" key="$accessKey" pw="$password" deny="true" chkgt="true" />
        </urn:RevokeRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->revokeRights();
        $ace = new \Zimbra\Account\Struct\AccountACEInfo(
            \Zimbra\Common\Enum\GranteeType::USR(), \Zimbra\Common\Enum\AceRightType::INVITE()->getValue(), $zimbraId, $displayName, $accessKey, $password, TRUE, TRUE
        );
        $this->assertEquals([$ace], $response->getAces());
    }

    public function testSearchCalendarResources()
    {
        $sortBy = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value= $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SearchCalendarResourcesResponse sortBy="$sortBy" offset="$offset" more="true" paginationSupported="true">
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:SearchCalendarResourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->searchCalendarResources();
        $calResource = new \Zimbra\Account\Struct\CalendarResourceInfo($name, $id, [
            new \Zimbra\Common\Struct\KeyValuePair($key, $value)
        ]);
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertTrue($response->getMore());
        $this->assertTrue($response->getPagingSupported());
        $this->assertEquals([$calResource], $response->getCalendarResources());
    }

    public function testSearchGal()
    {
        $sortBy = $this->faker->word;
        $offset = $this->faker->randomNumber;
        $ref = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $sortField = $this->faker->word;
        $folder = $this->faker->word;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $changeDate = $this->faker->unixTime;
        $modifiedSequenceId = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $revisionId = $this->faker->randomNumber;
        $fileAs = $this->faker->word;
        $email = $this->faker->email;
        $email2 = $this->faker->email;
        $email3 = $this->faker->email;
        $type = $this->faker->word;
        $dlist = $this->faker->word;
        $reference = $this->faker->word;

        $section = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentFilename = $this->faker->word;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SearchGalResponse sortBy="$sortBy" offset="$offset" more="true" paginationSupported="true" tokenizeKey="true">
            <urn:cn sf="$sortField" exp="true" id="$id" l="$folder" f="$flags" t="$tags" tn="$tagNames" md="$changeDate" ms="$modifiedSequenceId" d="$date" rev="$revisionId" fileAsStr="$fileAs" email="$email" email2="$email2" email3="$email3" type="$type" dlist="$dlist" ref="$reference" tooManyMembers="false" isOwner="true" isMember="false">
                <urn:meta section="$section" />
                <urn:a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</urn:a>
                <urn:m type="$type" value="$value" />
            </urn:cn>
        </urn:SearchGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->searchGal();

        $metadata = new \Zimbra\Account\Struct\AccountCustomMetadata($section);
        $contactAttr = new \Zimbra\Common\Struct\ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $contactMember = new \Zimbra\Account\Struct\ContactGroupMember($type, $value);
        $contact = new \Zimbra\Account\Struct\ContactInfo(
            $sortField, TRUE, $id, $folder, $flags, $tags, $tagNames, $changeDate, $modifiedSequenceId, $date, $revisionId, $fileAs, $email, $email2, $email3, $type, $dlist, $reference, FALSE, [$metadata], [$contactAttr], [$contactMember], TRUE, FALSE
        );
        $this->assertSame($sortBy, $response->getSortBy());
        $this->assertSame($offset, $response->getOffset());
        $this->assertTrue($response->getMore());
        $this->assertTrue($response->getPagingSupported());
        $this->assertTrue($response->getTokenizeKey());
        $this->assertEquals([$contact], $response->getContacts());
    }

    public function testSubscribeDistributionList()
    {
        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SubscribeDistributionListResponse status="subscribed" />
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->subscribeDistributionList(
            new \Zimbra\Common\Struct\DistributionListSelector(),
            \Zimbra\Common\Enum\DistributionListSubscribeOp::SUBSCRIBE()
        );
        $this->assertEquals(\Zimbra\Common\Enum\DistributionListSubscribeStatus::SUBSCRIBED(), $response->getStatus());
    }

    public function testSyncGal()
    {
        $id = $this->faker->uuid;
        $token = $this->faker->uuid;
        $galDefinitionLastModified = $this->faker->word;
        $remain = $this->faker->randomNumber;
        $email = $this->faker->email;

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:SyncGalResponse more="true" token="$token" galDefinitionLastModified="$galDefinitionLastModified" throttled="true" fullSyncRecommended="true" remain="$remain">
            <urn:cn email="$email" />
            <urn:deleted id="$id" />
        </urn:SyncGalResponse>
    </soap:Body>
</soap:Envelope>
EOT;

        $api = new StubAccountApi($this->mockSoapClient($xml));
        $response = $api->syncGal();

        $contact = new \Zimbra\Account\Struct\ContactInfo;
        $contact->setEmail($email);
        $deleted = new \Zimbra\Common\Struct\Id($id);

        $this->assertTrue($response->getMore());
        $this->assertSame($token, $response->getToken());
        $this->assertSame($galDefinitionLastModified, $response->getGalDefinitionLastModified());
        $this->assertTrue($response->getThrottled());
        $this->assertTrue($response->getFullSyncRecommended());
        $this->assertSame($remain, $response->getRemain());
        $this->assertEquals([$contact], $response->getContacts());
        $this->assertEquals([$deleted], $response->getDeleted());
    }
}

class StubAccountApi extends AccountApi
{
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }
}
