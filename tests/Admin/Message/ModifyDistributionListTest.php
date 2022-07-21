<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyDistributionListBody;
use Zimbra\Admin\Message\ModifyDistributionListEnvelope;
use Zimbra\Admin\Message\ModifyDistributionListRequest;
use Zimbra\Admin\Message\ModifyDistributionListResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyDistributionList.
 */
class ModifyDistributionListTest extends ZimbraTestCase
{
    public function testModifyDistributionList()
    {
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $member = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new ModifyDistributionListRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new ModifyDistributionListRequest();
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $dl = new DistributionListInfo(
            $name, $id, [$member], [new Attr($key, $value)], [new GranteeInfo($id, $name, GranteeType::USR())], TRUE
        );
        $response = new ModifyDistributionListResponse($dl);
        $this->assertSame($dl, $response->getDl());
        $response = new ModifyDistributionListResponse();
        $response->setDl($dl);
        $this->assertSame($dl, $response->getDl());

        $body = new ModifyDistributionListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyDistributionListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyDistributionListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyDistributionListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDistributionListRequest id="$id">
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyDistributionListRequest>
        <urn:ModifyDistributionListResponse>
            <urn:dl name="$name" id="$id" dynamic="true">
                <urn:a n="$key">$value</urn:a>
                <urn:dlm>$member</urn:dlm>
                <urn:owners>
                    <urn:owner id="$id" name="$name" type="usr" />
                </urn:owners>
            </urn:dl>
        </urn:ModifyDistributionListResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyDistributionListEnvelope::class, 'xml'));
    }
}
