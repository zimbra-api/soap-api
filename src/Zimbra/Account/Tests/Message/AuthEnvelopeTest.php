<?php

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AuthEnvelope;
use Zimbra\Account\Message\AuthBody;
use Zimbra\Account\Message\AuthRequest;
use Zimbra\Account\Message\AuthResponse;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\Pref;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\Session;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for AuthEnvelope.
 */
class AuthEnvelopeTest extends ZimbraStructTestCase
{
    public function testAuthEnvelope()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $password = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $requestedSkin = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $trustedToken = $this->faker->uuid;
        $deviceId = $this->faker->uuid;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->uuid;
        $id = $this->faker->uuid;
        $type = $this->faker->word;

        $time = time();
        $lifetime = mt_rand(1, 100);
        $trustLifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME()->value(), $value);
        $preauth = new PreAuth($time, $value, $time);
        $authToken = new AuthToken($value, true, $lifetime);
        $session = new Session($id, $type);

        $attr = new Attr($name, $value, true);
        $attrs = new AuthAttrs([$attr]);

        $pref = new Pref($name, $value, $time);
        $prefs = new AuthPrefs([$pref]);

        $request = new AuthRequest(
            $account,
            $password,
            $preauth,
            $authToken,
            $virtualHost,
            $prefs,
            $attrs,
            $requestedSkin,
            true,
            true,
            $twoFactorCode,
            true,
            $trustedToken,
            $deviceId,
            true
        );

        $response = new AuthResponse(
            $token,
            $lifetime,
            $session,
            $refer,
            $skin,
            $csrfToken,
            $deviceId,
            $trustedToken,
            $trustLifetime,
            true,
            $prefs,
            $attrs,
            true,
            true
        );

        $body = new AuthBody($request, $response);
        $envelope = new AuthEnvelope(NULL, $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:AuthRequest persistAuthTokenCookie="true" csrfTokenSecured="true" deviceTrusted="true" generateDeviceId="true">'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<password>' . $password . '</password>'
                        . '<preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</preauth>'
                        . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>'
                        . '<virtualHost>' . $virtualHost . '</virtualHost>'
                        . '<prefs>'
                            . '<pref name="' . $name . '" modified="' . $time . '">' . $value . '</pref>'
                        . '</prefs>'
                        . '<attrs>'
                            . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                        . '</attrs>'
                        . '<requestedSkin>' . $requestedSkin . '</requestedSkin>'
                        . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
                        . '<trustedDeviceToken>' . $trustedToken . '</trustedDeviceToken>'
                        . '<deviceId>' . $deviceId . '</deviceId>'
                    . '</urn:AuthRequest>'
                    . '<urn:AuthResponse zmgProxy="true">'
                        . '<urn:authToken>' . $token . '</urn:authToken>'
                        . '<urn:lifetime>' . $lifetime . '</urn:lifetime>'
                        . '<urn:trustLifetime>' . $trustLifetime . '</urn:trustLifetime>'
                        . '<urn:session type="' . $type . '" id="' . $id . '">'  .$id . '</urn:session>'
                        . '<urn:refer>' . $refer . '</urn:refer>'
                        . '<urn:skin>' . $skin . '</urn:skin>'
                        . '<urn:csrfToken>' . $csrfToken . '</urn:csrfToken>'
                        . '<urn:deviceId>' . $deviceId . '</urn:deviceId>'
                        . '<urn:trustedToken>' . $trustedToken . '</urn:trustedToken>'
                        . '<urn:prefs>'
                            . '<pref name="' . $name . '" modified="' . $time . '">' . $value . '</pref>'
                        . '</urn:prefs>'
                        . '<urn:attrs>'
                            . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                        . '</urn:attrs>'
                        . '<urn:twoFactorAuthRequired>true</urn:twoFactorAuthRequired>'
                        . '<urn:trustedDevicesEnabled>true</urn:trustedDevicesEnabled>'
                    . '</urn:AuthResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));

        $envelope = $this->serializer->deserialize($xml, 'Zimbra\Account\Message\AuthEnvelope', 'xml');
        $body = $envelope->getBody();
        $this->assertTrue($body instanceof AuthBody);

        $request = $body->getRequest();
        $account = $request->getAccount();
        $preauth = $request->getPreAuth();
        $authToken = $request->getAuthToken();
        $prefs = $request->getPrefs();
        $attrs = $request->getAttrs();
        $pref = $prefs->getPrefs()[0];
        $attr = $attrs->getAttrs()[0];
        $this->assertSame($password, $request->getPassword());
        $this->assertSame($virtualHost, $request->getVirtualHost());
        $this->assertSame($requestedSkin, $request->getRequestedSkin());
        $this->assertTrue($request->getPersistAuthTokenCookie());
        $this->assertTrue($request->getCsrfSupported());
        $this->assertSame($twoFactorCode, $request->getTwoFactorCode());
        $this->assertTrue($request->getDeviceTrusted());
        $this->assertSame($trustedToken, $request->getTrustedDeviceToken());
        $this->assertSame($deviceId, $request->getDeviceId());
        $this->assertTrue($request->getGenerateDeviceId());
        $this->assertSame($value, $account->getValue());
        $this->assertSame(AccountBy::NAME()->value(), $account->getBy());
        $this->assertSame($time, $preauth->getTimestamp());
        $this->assertSame($time, $preauth->getExpiresTimestamp());
        $this->assertSame($value, $preauth->getValue());
        $this->assertSame($value, $authToken->getValue());
        $this->assertTrue($authToken->getVerifyAccount());
        $this->assertSame($lifetime, $authToken->getLifetime());
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($time, $pref->getModified());
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertTrue($attr->getPermDenied());

        $response = $body->getResponse();
        $session = $response->getSession();
        $prefs = $response->getPrefs();
        $attrs = $response->getAttrs();
        $pref = $prefs->getPrefs()[0];
        $attr = $attrs->getAttrs()[0];
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
        $this->assertSame($type, $session->getType());
        $this->assertSame($id, $session->getId());
        $this->assertSame($id, $session->getValue());
        $this->assertSame($name, $pref->getName());
        $this->assertSame($value, $pref->getValue());
        $this->assertSame($time, $pref->getModified());
        $this->assertSame($name, $attr->getName());
        $this->assertSame($value, $attr->getValue());
        $this->assertTrue($attr->getPermDenied());
    }
}
