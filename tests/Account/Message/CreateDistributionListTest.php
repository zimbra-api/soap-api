<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\CreateDistributionListBody;
use Zimbra\Account\Message\CreateDistributionListEnvelope;
use Zimbra\Account\Message\CreateDistributionListRequest;
use Zimbra\Account\Message\CreateDistributionListResponse;
use Zimbra\Account\Struct\DLInfo;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateDistributionList.
 */
class CreateDistributionListTest extends ZimbraTestCase
{
    public function testCreateDistributionList()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $displayName = $this->faker->word;
        $ref = $this->faker->word;
        $via = $this->faker->word;
        $member = $this->faker->word;

        $attr = new KeyValuePair($key, $value);

        $request = new CreateDistributionListRequest(
            $name, FALSE
        );
        $this->assertSame($name, $request->getName());
        $this->assertFalse($request->getDynamic());
        $request = new CreateDistributionListRequest('');
        $request->setName($name)
            ->setDynamic(TRUE)
            ->setKeyValuePairs([$attr]);
        $this->assertSame($name, $request->getName());
        $this->assertTrue($request->getDynamic());

        $dl = new DLInfo($id, $ref, $name, $displayName, TRUE, $via, TRUE, TRUE, [$attr]);
        $response = new CreateDistributionListResponse($dl);
        $this->assertSame($dl, $response->getDl());

        $response = new CreateDistributionListResponse(new DLInfo('', '', ''));
        $response->setDl($dl);
        $this->assertSame($dl, $response->getDl());

        $body = new CreateDistributionListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateDistributionListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateDistributionListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateDistributionListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CreateDistributionListRequest name="$name" dynamic="true">
            <a n="$key">$value</a>
        </urn:CreateDistributionListRequest>
        <urn:CreateDistributionListResponse>
            <dl name="$name" id="$id" ref="$ref" d="$displayName" dynamic="true" via="$via" isOwner="true" isMember="true">
                <a n="$key">$value</a>
            </dl>
        </urn:CreateDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDistributionListEnvelope::class, 'xml'));
    }
}
