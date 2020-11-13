<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AuthRequest;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthRequest.
 */
class AuthRequestTest extends ZimbraStructTestCase
{
    public function testAuthRequest()
    {
        $name = $this->faker->word;
        $password = $this->faker->uuid;
        $value = $this->faker->word;
        $authToken = $this->faker->uuid;
        $virtualHost = $this->faker->word;
        $twoFactorCode = $this->faker->uuid;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new AuthRequest(
            $name,
            $password,
            $authToken,
            $account,
            $virtualHost,
            FALSE,
            FALSE,
            $twoFactorCode
        );
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertFalse($req->getPersistAuthTokenCookie());
        $this->assertFalse($req->getCsrfSupported());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());

        $req = new AuthRequest();
        $req->setName($name)
            ->setPassword($password)
            ->setAuthToken($authToken)
            ->setAccount($account)
            ->setVirtualHost($virtualHost)
            ->setPersistAuthTokenCookie(TRUE)
            ->setCsrfSupported(TRUE)
            ->setTwoFactorCode($twoFactorCode);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertTrue($req->getPersistAuthTokenCookie());
        $this->assertTrue($req->getCsrfSupported());
        $this->assertSame($twoFactorCode, $req->getTwoFactorCode());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true" csrfTokenSecured="true">'
                . '<authToken>' . $authToken . '</authToken>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
                . '<twoFactorCode>' . $twoFactorCode . '</twoFactorCode>'
            . '</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AuthRequest::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AuthRequest::class, 'json'));
    }
}
