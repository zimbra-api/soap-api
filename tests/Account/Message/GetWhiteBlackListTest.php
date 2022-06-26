<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetWhiteBlackListBody;
use Zimbra\Account\Message\GetWhiteBlackListEnvelope;
use Zimbra\Account\Message\GetWhiteBlackListRequest;
use Zimbra\Account\Message\GetWhiteBlackListResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetWhiteBlackListTest.
 */
class GetWhiteBlackListTest extends ZimbraTestCase
{
    public function testGetWhiteBlackList()
    {
        $white1 = $this->faker->ipv4;
        $white2 = $this->faker->ipv4;
        $black1 = $this->faker->ipv4;
        $black2 = $this->faker->ipv4;

        $request = new GetWhiteBlackListRequest();

        $response = new GetWhiteBlackListResponse([$white1, $white2], [$black1, $black2]);
        $this->assertSame([$white1, $white2], $response->getWhiteListEntries());
        $this->assertSame([$black1, $black2], $response->getBlackListEntries());
        $response = new GetWhiteBlackListResponse();
        $response->setWhiteListEntries([$white1])
            ->addWhiteListEntry($white2)
            ->setBlackListEntries([$black1])
            ->addBlackListEntry($black2);
        $this->assertSame([$white1, $white2], $response->getWhiteListEntries());
        $this->assertSame([$black1, $black2], $response->getBlackListEntries());

        $body = new GetWhiteBlackListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetWhiteBlackListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetWhiteBlackListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetWhiteBlackListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetWhiteBlackListRequest />
        <urn:GetWhiteBlackListResponse>
            <urn:whiteList>
                <urn:addr>$white1</urn:addr>
                <urn:addr>$white2</urn:addr>
            </urn:whiteList>
            <urn:blackList>
                <urn:addr>$black1</urn:addr>
                <urn:addr>$black2</urn:addr>
            </urn:blackList>
        </urn:GetWhiteBlackListResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetWhiteBlackListEnvelope::class, 'xml'));
    }
}
