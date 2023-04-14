<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{
    DistributionListActionEnvelope,
    DistributionListActionBody,
    DistributionListActionRequest,
    DistributionListActionResponse
};

use Zimbra\Common\Enum\DistributionListBy as DLBy;
use Zimbra\Common\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Common\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Common\Enum\Operation;

use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListAction;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Common\Struct\DistributionListSelector;

use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for DistributionListAction.
 */
class DistributionListActionTest extends ZimbraTestCase
{
    public function testDistributionListAction()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE, $value, TRUE);
        $owner = new DistributionListGranteeSelector(GranteeType::USR, DLGranteeBy::NAME, $value);
        $grantee = new DistributionListGranteeSelector(GranteeType::USR, DLGranteeBy::NAME, $value);
        $right = new DistributionListRightSpec($name, [$grantee]);
        $attr = new KeyValuePair($name, $value);

        $dl = new DistributionListSelector(DLBy::NAME, $value);
        $action = new DistributionListAction(
            Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right], [$attr]
        );

        $request = new DistributionListActionRequest($dl, $action);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($action, $request->getAction());

        $request = new DistributionListActionRequest(
            new DistributionListSelector(),
            new DistributionListAction()
        );
        $request->setDl($dl)
            ->setAction($action);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($action, $request->getAction());

        $response = new DistributionListActionResponse();

        $body = new DistributionListActionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DistributionListActionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DistributionListActionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new DistributionListActionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DistributionListActionRequest>
            <urn:dl by="name">$value</urn:dl>
            <urn:action op="modify">
                <urn:a n="$name">$value</urn:a>
                <urn:newName>$name</urn:newName>
                <urn:subsReq op="subscribe" bccOwners="true">$value</urn:subsReq>
                <urn:dlm>$member</urn:dlm>
                <urn:owner type="usr" by="name">$value</urn:owner>
                <urn:right right="$name">
                    <urn:grantee type="usr" by="name">$value</urn:grantee>
                </urn:right>
            </urn:action>
        </urn:DistributionListActionRequest>
        <urn:DistributionListActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DistributionListActionEnvelope::class, 'xml'));
    }
}
