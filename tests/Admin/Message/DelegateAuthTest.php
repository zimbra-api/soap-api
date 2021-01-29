<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DelegateAuthBody;
use Zimbra\Admin\Message\DelegateAuthEnvelope;
use Zimbra\Admin\Message\DelegateAuthRequest;
use Zimbra\Admin\Message\DelegateAuthResponse;
use Zimbra\Struct\AccountSelector;
use Zimbra\Enum\AccountBy;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for DelegateAuth.
 */
class DelegateAuthTest extends ZimbraStructTestCase
{
    public function testDelegateAuth()
    {
        $value = $this->faker->word;
        $authToken = $this->faker->uuid;
        $duration = mt_rand(1, 100);
        $lifetime = mt_rand(1, 100);

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new DelegateAuthRequest($account, $duration);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($duration, $request->getDuration());
        $request = new DelegateAuthRequest(new AccountSelector(AccountBy::NAME(), ''));
        $request->setAccount($account)
            ->setDuration($duration);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($duration, $request->getDuration());

        $response = new DelegateAuthResponse($authToken, $lifetime);
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());
        $response = new DelegateAuthResponse('', 0);
        $response->setAuthToken($authToken)
            ->setLifetime($lifetime);
        $this->assertSame($authToken, $response->getAuthToken());
        $this->assertSame($lifetime, $response->getLifetime());

        $body = new DelegateAuthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DelegateAuthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DelegateAuthEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DelegateAuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DelegateAuthRequest duration="$duration">
            <account by="name">$value</account>
        </urn:DelegateAuthRequest>
        <urn:DelegateAuthResponse>
            <authToken>$authToken</authToken>
            <lifetime>$lifetime</lifetime>
        </urn:DelegateAuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DelegateAuthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DelegateAuthRequest' => [
                    'account' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'duration' => $duration,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DelegateAuthResponse' => [
                    'authToken' => [
                        '_content' => $authToken,
                    ],
                    'lifetime' => [
                        '_content' => $lifetime,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DelegateAuthEnvelope::class, 'json'));
    }
}
