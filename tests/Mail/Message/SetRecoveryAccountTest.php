<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{Channel, RecoveryAccountOperation};

use Zimbra\Mail\Message\SetRecoveryAccountEnvelope;
use Zimbra\Mail\Message\SetRecoveryAccountBody;
use Zimbra\Mail\Message\SetRecoveryAccountRequest;
use Zimbra\Mail\Message\SetRecoveryAccountResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetRecoveryAccount.
 */
class SetRecoveryAccountTest extends ZimbraTestCase
{
    public function testSetRecoveryAccount()
    {
        $channel = Channel::EMAIL;
        $op = RecoveryAccountOperation::SEND_CODE;
        $recoveryAccount = $this->faker->email;
        $verificationCode = $this->faker->word;

        $request = new SetRecoveryAccountRequest($op, $recoveryAccount, $verificationCode, $channel);
        $this->assertSame($op, $request->getOp());
        $this->assertSame($recoveryAccount, $request->getRecoveryAccount());
        $this->assertSame($verificationCode, $request->getVerificationCode());
        $this->assertSame($channel, $request->getChannel());
        $request = new SetRecoveryAccountRequest();
        $request->setOp($op)
            ->setRecoveryAccount($recoveryAccount)
            ->setVerificationCode($verificationCode)
            ->setChannel($channel);
        $this->assertSame($op, $request->getOp());
        $this->assertSame($recoveryAccount, $request->getRecoveryAccount());
        $this->assertSame($verificationCode, $request->getVerificationCode());
        $this->assertSame($channel, $request->getChannel());

        $response = new SetRecoveryAccountResponse();

        $body = new SetRecoveryAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetRecoveryAccountBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetRecoveryAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetRecoveryAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SetRecoveryAccountRequest op="sendCode" recoveryAccount="$recoveryAccount" recoveryAccountVerificationCode="$verificationCode" channel="email" />
        <urn:SetRecoveryAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetRecoveryAccountEnvelope::class, 'xml'));
    }
}
