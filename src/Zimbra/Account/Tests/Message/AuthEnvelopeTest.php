<?php declare(strict_types=1);

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
        $recoveryCode = $this->faker->word;
        $jwtToken = $this->faker->word;
        $virtualHost = $this->faker->word;
        $requestedSkin = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $trustedToken = $this->faker->uuid;
        $deviceId = $this->faker->uuid;
        $tokenType = $this->faker->word;
        $token = $this->faker->uuid;
        $refer = $this->faker->word;
        $skin = $this->faker->word;
        $csrfToken = $this->faker->uuid;
        $id = $this->faker->uuid;
        $type = $this->faker->word;

        $time = time();
        $lifetime = mt_rand(1, 100);
        $trustLifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);
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
            $recoveryCode,
            $preauth,
            $authToken,
            $jwtToken,
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
            true,
            $tokenType
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
        $envelope = new AuthEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
                    . '<urn:AuthRequest persistAuthTokenCookie="true" csrfTokenSecured="true" deviceTrusted="true" generateDeviceId="true" tokenType="' . $tokenType . '">'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<password>' . $password . '</password>'
                        . '<recoveryCode>' . $recoveryCode . '</recoveryCode>'
                        . '<preauth timestamp="' . $time . '" expiresTimestamp="' . $time . '">' . $value . '</preauth>'
                        . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>'
                        . '<jwtToken>' . $jwtToken . '</jwtToken>'
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
                        . '<authToken>' . $token . '</authToken>'
                        . '<lifetime>' . $lifetime . '</lifetime>'
                        . '<trustLifetime>' . $trustLifetime . '</trustLifetime>'
                        . '<session type="' . $type . '" id="' . $id . '">'  .$id . '</session>'
                        . '<refer>' . $refer . '</refer>'
                        . '<skin>' . $skin . '</skin>'
                        . '<csrfToken>' . $csrfToken . '</csrfToken>'
                        . '<deviceId>' . $deviceId . '</deviceId>'
                        . '<trustedToken>' . $trustedToken . '</trustedToken>'
                        . '<prefs>'
                            . '<pref name="' . $name . '" modified="' . $time . '">' . $value . '</pref>'
                        . '</prefs>'
                        . '<attrs>'
                            . '<attr name="' . $name . '" pd="true">' . $value . '</attr>'
                        . '</attrs>'
                        . '<twoFactorAuthRequired>true</twoFactorAuthRequired>'
                        . '<trustedDevicesEnabled>true</trustedDevicesEnabled>'
                    . '</urn:AuthResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AuthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AuthRequest' => [
                    'persistAuthTokenCookie' => TRUE,
                    'csrfTokenSecured' => TRUE,
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $value,
                    ],
                    'password' => [
                        '_content' => $password,
                    ],
                    'recoveryCode' => [
                        '_content' => $recoveryCode,
                    ],
                    'preauth' => [
                        '_content' => $value,
                        'timestamp' => $time,
                        'expiresTimestamp' => $time,
                    ],
                    'authToken' => [
                        '_content' => $value,
                        'verifyAccount' => TRUE,
                        'lifetime' => $lifetime,
                    ],
                    'jwtToken' => [
                        '_content' => $jwtToken,
                    ],
                    'virtualHost' => [
                        '_content' => $virtualHost,
                    ],
                    'prefs' => [
                        'pref' => [
                            [
                                'name' => $name,
                                '_content' => $value,
                                'modified' => $time,
                            ],
                        ],
                    ],
                    'attrs' => [
                        'attr' => [
                            [
                                'name' => $name,
                                '_content' => $value,
                                'pd' => TRUE,
                            ],
                        ],
                    ],
                    'requestedSkin' => [
                        '_content' => $requestedSkin,
                    ],
                    'twoFactorCode' => [
                        '_content' => $twoFactorCode,
                    ],
                    'deviceTrusted' => TRUE,
                    'trustedDeviceToken' => [
                        '_content' => $trustedToken,
                    ],
                    'deviceId' => [
                        '_content' => $deviceId,
                    ],
                    'generateDeviceId' => TRUE,
                    'tokenType' => $tokenType,
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'AuthResponse' => [
                    'authToken' => [
                        '_content' => $token,
                    ],
                    'lifetime' => [
                        '_content' => $lifetime,
                    ],
                    'trustLifetime' => [
                        '_content' => $trustLifetime,
                    ],
                    'session' => [
                        'type' => $type,
                        'id' => $id,
                        '_content' => $id,
                    ],
                    'refer' => [
                        '_content' => $refer,
                    ],
                    'skin' => [
                        '_content' => $skin,
                    ],
                    'csrfToken' => [
                        '_content' => $csrfToken,
                    ],
                    'deviceId' => [
                        '_content' => $deviceId,
                    ],
                    'trustedToken' => [
                        '_content' => $trustedToken,
                    ],
                    'zmgProxy' => TRUE,
                    'prefs' => [
                        'pref' => [
                            [
                                'name' => $name,
                                '_content' => $value,
                                'modified' => $time,
                            ],
                        ],
                    ],
                    'attrs' => [
                        'attr' => [
                            [
                                'name' => $name,
                                '_content' => $value,
                                'pd' => TRUE,
                            ],
                        ],
                    ],
                    'twoFactorAuthRequired' => [
                        '_content' => TRUE,
                    ],
                    'trustedDevicesEnabled' => [
                        '_content' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AuthEnvelope::class, 'json'));
    }
}
