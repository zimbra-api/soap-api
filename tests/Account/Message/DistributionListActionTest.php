<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{DistributionListActionEnvelope, DistributionListActionBody, DistributionListActionRequest, DistributionListActionResponse};

use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Operation;

use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListAction;

use Zimbra\Struct\KeyValuePair;
use Zimbra\Struct\DistributionListSelector;

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

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, TRUE);
        $owner = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::NAME(), $value);
        $grantee = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::NAME(), $value);
        $right = new DistributionListRightSpec($name, [$grantee]);
        $attr = new KeyValuePair($name, $value);

        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $action = new DistributionListAction(
            Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right], [$attr]
        );

        $request = new DistributionListActionRequest($dl, $action);
        $this->assertSame($dl, $request->getDl());
        $this->assertSame($action, $request->getAction());

        $request = new DistributionListActionRequest(
            new DistributionListSelector(DLBy::ID(), ''),
            new DistributionListAction(Operation::DELETE())
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
            <dl by="name">$value</dl>
            <action op="modify">
                <a n="$name">$value</a>
                <newName>$name</newName>
                <subsReq op="subscribe" bccOwners="true">$value</subsReq>
                <dlm>$member</dlm>
                <owner type="usr" by="name">$value</owner>
                <right right="$name">
                    <grantee type="usr" by="name">$value</grantee>
                </right>
            </action>
        </urn:DistributionListActionRequest>
        <urn:DistributionListActionResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DistributionListActionEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DistributionListActionRequest' => [
                    'dl' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'action' => [
                        'op' => 'modify',
                        'newName' => [
                            '_content' => $name,
                        ],
                        'subsReq' => [
                            'op' => 'subscribe',
                            '_content' => $value,
                            'bccOwners' => TRUE,
                        ],
                        'dlm' => [
                            [
                                '_content' => $member,
                            ],
                        ],
                        'owner' => [
                            [
                                'type' => 'usr',
                                'by' => 'name',
                                '_content' => $value,
                            ],
                        ],
                        'right' => [
                            [
                                'right' => $name,
                                'grantee' => [
                                    [
                                        'type' => 'usr',
                                        'by' => 'name',
                                        '_content' => $value,
                                    ],
                                ],
                            ],
                        ],
                        'a' => [
                            [
                                'n' => $name,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'DistributionListActionResponse' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DistributionListActionEnvelope::class, 'json'));
    }
}
