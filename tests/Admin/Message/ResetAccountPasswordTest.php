<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ResetAccountPasswordBody;
use Zimbra\Admin\Message\ResetAccountPasswordEnvelope;
use Zimbra\Admin\Message\ResetAccountPasswordRequest;
use Zimbra\Admin\Message\ResetAccountPasswordResponse;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ResetAccountPassword.
 */
class ResetAccountPasswordTest extends ZimbraTestCase
{
    public function testResetAccountPassword()
    {
        $value = $this->faker->word;
        $account = new AccountSelector(AccountBy::NAME, $value);

        $request = new ResetAccountPasswordRequest($account);
        $this->assertSame($account, $request->getAccount());
        $request = new ResetAccountPasswordRequest(new AccountSelector(AccountBy::NAME, $value));
        $request->setAccount($account);
        $this->assertSame($account, $request->getAccount());

        $response = new ResetAccountPasswordResponse();
        $body = new ResetAccountPasswordBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ResetAccountPasswordBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ResetAccountPasswordEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ResetAccountPasswordEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ResetAccountPasswordRequest>
            <urn:account by="name">$value</urn:account>
        </urn:ResetAccountPasswordRequest>
        <urn:ResetAccountPasswordResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ResetAccountPasswordEnvelope::class, 'xml'));
    }
}
