<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\VerifyCodeEnvelope;
use Zimbra\Mail\Message\VerifyCodeBody;
use Zimbra\Mail\Message\VerifyCodeRequest;
use Zimbra\Mail\Message\VerifyCodeResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VerifyCode.
 */
class VerifyCodeTest extends ZimbraTestCase
{
    public function testVerifyCode()
    {
        $address = $this->faker->email;
        $verificationCode = $this->faker->word;

        $request = new VerifyCodeRequest($address, $verificationCode);
        $this->assertSame($address, $request->getAddress());
        $this->assertSame($verificationCode, $request->getVerificationCode());
        $request = new VerifyCodeRequest();
        $request->setAddress($address)
            ->setVerificationCode($verificationCode);
        $this->assertSame($address, $request->getAddress());
        $this->assertSame($verificationCode, $request->getVerificationCode());

        $response = new VerifyCodeResponse();
        $this->assertFalse($response->getSuccess());
        $response->setSuccess(TRUE);
        $this->assertTrue($response->getSuccess());

        $body = new VerifyCodeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new VerifyCodeBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new VerifyCodeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new VerifyCodeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:VerifyCodeRequest a="$address" code="$verificationCode" />
        <urn:VerifyCodeResponse success="true" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, VerifyCodeEnvelope::class, 'xml'));
    }
}
