<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\ModifyWhiteBlackListBody;
use Zimbra\Account\Message\ModifyWhiteBlackListEnvelope;
use Zimbra\Account\Message\ModifyWhiteBlackListRequest;
use Zimbra\Account\Message\ModifyWhiteBlackListResponse;
use Zimbra\Common\Struct\OpValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyWhiteBlackListTest.
 */
class ModifyWhiteBlackListTest extends ZimbraTestCase
{
    public function testModifyWhiteBlackList()
    {
        $white = $this->faker->ipv4;
        $black = $this->faker->ipv4;

        $white1 = new OpValue('+', $white);
        $white2 = new OpValue('-', $white);
        $black1 = new OpValue('+', $black);
        $black2 = new OpValue('-', $black);

        $request = new ModifyWhiteBlackListRequest([$white1, $white2], [$black1, $black2]);
        $this->assertSame([$white1, $white2], $request->getWhiteListEntries());
        $this->assertSame([$black1, $black2], $request->getBlackListEntries());
        $request = new ModifyWhiteBlackListRequest();
        $request->setWhiteListEntries([$white1])
            ->addWhiteListEntry($white2)
            ->setBlackListEntries([$black1])
            ->addBlackListEntry($black2);
        $this->assertSame([$white1, $white2], $request->getWhiteListEntries());
        $this->assertSame([$black1, $black2], $request->getBlackListEntries());

        $response = new ModifyWhiteBlackListResponse();

        $body = new ModifyWhiteBlackListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyWhiteBlackListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyWhiteBlackListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyWhiteBlackListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyWhiteBlackListRequest>
            <urn:whiteList>
                <urn:addr op="+">$white</urn:addr>
                <urn:addr op="-">$white</urn:addr>
            </urn:whiteList>
            <urn:blackList>
                <urn:addr op="+">$black</urn:addr>
                <urn:addr op="-">$black</urn:addr>
            </urn:blackList>
        </urn:ModifyWhiteBlackListRequest>
        <urn:ModifyWhiteBlackListResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyWhiteBlackListEnvelope::class, 'xml'));
    }
}
