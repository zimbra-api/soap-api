<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetMemcachedClientConfigBody;
use Zimbra\Admin\Message\GetMemcachedClientConfigEnvelope;
use Zimbra\Admin\Message\GetMemcachedClientConfigRequest;
use Zimbra\Admin\Message\GetMemcachedClientConfigResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetMemcachedClientConfig.
 */
class GetMemcachedClientConfigTest extends ZimbraStructTestCase
{
    public function testGetMemcachedClientConfig()
    {
        $serverList = $this->faker->word;
        $hashAlgorithm = $this->faker->word;
        $defaultExpirySeconds = mt_rand(1, 100);
        $defaultTimeoutMillis = mt_rand(1, 100);

        $request = new GetMemcachedClientConfigRequest();
        $response = new GetMemcachedClientConfigResponse(
            $serverList, $hashAlgorithm, FALSE, $defaultExpirySeconds, $defaultTimeoutMillis
        );
        $this->assertSame($serverList, $response->getServerList());
        $this->assertSame($hashAlgorithm, $response->getHashAlgorithm());
        $this->assertFalse($response->getBinaryProtocolEnabled());
        $this->assertSame($defaultExpirySeconds, $response->getDefaultExpirySeconds());
        $this->assertSame($defaultTimeoutMillis, $response->getDefaultTimeoutMillis());

        $response = new GetMemcachedClientConfigResponse();
        $response->setServerList($serverList)
            ->setHashAlgorithm($hashAlgorithm)
            ->setBinaryProtocolEnabled(TRUE)
            ->setDefaultExpirySeconds($defaultExpirySeconds)
            ->setDefaultTimeoutMillis($defaultTimeoutMillis);
        $this->assertSame($serverList, $response->getServerList());
        $this->assertSame($hashAlgorithm, $response->getHashAlgorithm());
        $this->assertTrue($response->getBinaryProtocolEnabled());
        $this->assertSame($defaultExpirySeconds, $response->getDefaultExpirySeconds());
        $this->assertSame($defaultTimeoutMillis, $response->getDefaultTimeoutMillis());

        $body = new GetMemcachedClientConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetMemcachedClientConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMemcachedClientConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetMemcachedClientConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetMemcachedClientConfigRequest />
        <urn:GetMemcachedClientConfigResponse serverList="$serverList" hashAlgorithm="$hashAlgorithm" binaryProtocol="true" defaultExpirySeconds="$defaultExpirySeconds" defaultTimeoutMillis="$defaultTimeoutMillis" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMemcachedClientConfigEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetMemcachedClientConfigRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetMemcachedClientConfigResponse' => [
                    'serverList' => $serverList,
                    'hashAlgorithm' => $hashAlgorithm,
                    'binaryProtocol' => TRUE,
                    'defaultExpirySeconds' => $defaultExpirySeconds,
                    'defaultTimeoutMillis' => $defaultTimeoutMillis,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetMemcachedClientConfigEnvelope::class, 'json'));
    }
}
