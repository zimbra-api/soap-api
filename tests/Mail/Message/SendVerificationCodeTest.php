<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\SendVerificationCodeEnvelope;
use Zimbra\Mail\Message\SendVerificationCodeBody;
use Zimbra\Mail\Message\SendVerificationCodeRequest;
use Zimbra\Mail\Message\SendVerificationCodeResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SendVerificationCode.
 */
class SendVerificationCodeTest extends ZimbraTestCase
{
    public function testSendVerificationCode()
    {
        $address = $this->faker->email;
        $request = new SendVerificationCodeRequest($address);
        $this->assertSame($address, $request->getAddress());
        $request = new SendVerificationCodeRequest();
        $request->setAddress($address);
        $this->assertSame($address, $request->getAddress());

        $response = new SendVerificationCodeResponse();

        $body = new SendVerificationCodeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SendVerificationCodeBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SendVerificationCodeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SendVerificationCodeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SendVerificationCodeRequest a="$address" />
        <urn:SendVerificationCodeResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SendVerificationCodeEnvelope::class, 'xml'));
    }
}
