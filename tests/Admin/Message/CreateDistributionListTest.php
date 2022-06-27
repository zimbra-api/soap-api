<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateDistributionListBody;
use Zimbra\Admin\Message\CreateDistributionListEnvelope;
use Zimbra\Admin\Message\CreateDistributionListRequest;
use Zimbra\Admin\Message\CreateDistributionListResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Common\Enum\GranteeType;
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
        $member = $this->faker->word;

        $attr = new Attr($key, $value);

        $request = new CreateDistributionListRequest(
            $name, FALSE, [$attr]
        );
        $this->assertSame($name, $request->getName());
        $this->assertFalse($request->getDynamic());
        $request = new CreateDistributionListRequest('');
        $request->setName($name)
            ->setDynamic(TRUE)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());
        $this->assertTrue($request->getDynamic());

        $owner = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $dl = new DistributionListInfo($name, $id, [$member], [], [$owner], TRUE);
        $response = new CreateDistributionListResponse($dl);
        $this->assertSame($dl, $response->getDl());

        $response = new CreateDistributionListResponse(new DistributionListInfo('', ''));
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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateDistributionListRequest name="$name" dynamic="true">
            <urn:a n="$key">$value</urn:a>
        </urn:CreateDistributionListRequest>
        <urn:CreateDistributionListResponse>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="all" />
                </urn:owners>
            </urn:dl>
        </urn:CreateDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDistributionListEnvelope::class, 'xml'));
    }
}
