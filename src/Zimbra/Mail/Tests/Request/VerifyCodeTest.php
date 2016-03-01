<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\VerifyCode;

/**
 * Testcase class for VerifyCode.
 */
class VerifyCodeTest extends ZimbraMailApiTestCase
{
    public function testVerifyCodeRequest()
    {
        $email = $this->faker->email;
        $code = $this->faker->word;
        $req = new VerifyCode(
            $email, $code
        );
        $this->assertSame($email, $req->getAddress());
        $this->assertSame($code, $req->getVerificationCode());

        $req = new VerifyCode();
        $req->setAddress($email)
            ->setVerificationCode($code);
        $this->assertSame($email, $req->getAddress());
        $this->assertSame($code, $req->getVerificationCode());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VerifyCodeRequest a="' . $email . '" code="' . $code . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'VerifyCodeRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'a' => $email,
                'code' => $code,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyCodeApi()
    {
        $email = $this->faker->email;
        $code = $this->faker->word;
        $this->api->verifyCode($email, $code);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:VerifyCodeRequest a="' . $email . '" code="' . $code . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
