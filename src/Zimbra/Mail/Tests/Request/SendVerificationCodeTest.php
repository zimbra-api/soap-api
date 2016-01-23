<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\SendVerificationCode;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for SendVerificationCode.
 */
class SendVerificationCodeTest extends ZimbraMailApiTestCase
{
    public function testSendVerificationCodeRequest()
    {
        $email = $this->faker->email;
        $req = new SendVerificationCode(
            $email
        );
        $this->assertSame($email, $req->getAddress());

        $req = new SendVerificationCode('');
        $req->setAddress($email);
        $this->assertSame($email, $req->getAddress());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendVerificationCodeRequest a="' . $email . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendVerificationCodeRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'a' => $email,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendVerificationCodeApi()
    {
        $email = $this->faker->email;
        $this->api->sendVerificationCode($email);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendVerificationCodeRequest a="' . $email . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
