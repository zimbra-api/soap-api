<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AuthBody;
use Zimbra\Admin\Message\AuthRequest;
use Zimbra\Admin\Message\AuthResponse;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthBody.
 */
class AuthBodyTest extends ZimbraStructTestCase
{
    public function testAuthBody()
    {
        $name = $this->faker->word;
        $password = $this->faker->uuid;
        $value = $this->faker->word;
        $authToken = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;
        $csrfToken = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new AuthRequest(
            $name,
            $password,
            $authToken,
            $account,
            $virtualHost,
            TRUE,
            TRUE,
            $twoFactorCode
        );
        $response = new AuthResponse(
            $authToken,
            $csrfToken,
            $lifetime
        );

        $body = new AuthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AuthBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true" csrfTokenSecured="true">'
                    . '<authToken>' . $authToken . '</authToken>'
                    . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                    . '<virtualHost>' . $virtualHost . '</virtualHost>'
                    . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
                . '</urn:AuthRequest>'
                . '<urn:AuthResponse>'
                    . '<authToken>' . $authToken . '</authToken>'
                    . '<csrfToken>' . $csrfToken . '</csrfToken>'
                    . '<lifetime>' . $lifetime . '</lifetime>'
                . '</urn:AuthResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AuthBody::class, 'xml'));

        $json = json_encode([
            'AuthRequest' => [
                'name' => $name,
                'password' => $password,
                'authToken' => [
                    '_content' => $authToken,
                ],
                'account' => [
                    'by' => (string) AccountBy::NAME(),
                    '_content' => $value,
                ],
                'virtualHost' => [
                    '_content' => $virtualHost,
                ],
                'persistAuthTokenCookie' => TRUE,
                'csrfTokenSecured' => TRUE,
                'twoFactorCode' => [
                    '_content' => $twoFactorCode,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AuthResponse' => [
                'authToken' => [
                    '_content' => $authToken,
                ],
                'csrfToken' => [
                    '_content' => $csrfToken,
                ],
                'lifetime' => [
                    '_content' => $lifetime,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AuthBody::class, 'json'));
    }
}
