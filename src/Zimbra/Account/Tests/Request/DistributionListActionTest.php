<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\DistributionListAction;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\DistributionListAction as DLAction;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Account\Struct\DistributionListSelector;
use Zimbra\Account\Struct\DistributionListSubscribeReq;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Operation;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for DistributionListAction.
 */
class DistributionListActionTest extends ZimbraAccountApiTestCase
{
    public function testDistributionListActionRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, true);
        $owner = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value);
        $grantee = new \Zimbra\Account\Struct\DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value);
        $right = new DistributionListRightSpec($name, [$grantee]);
        $a = new KeyValuePair($name, $value);
        $action = new DLAction(Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right], [$a]);

        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $attr = new Attr($name, $value, true);

        $req = new DistributionListAction($dl, $action, [$attr]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($action, $req->getAction());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setDl($dl)
            ->setAction($action)
            ->addAttr($attr);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($action, $req->getAction());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DistributionListActionRequest>'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
                . '<action op="' . Operation::MODIFY() . '">'
                    . '<newName>' . $name . '</newName>'
                    . '<subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</subsReq>'
                    . '<a n="' . $name . '">' . $value . '</a>'
                    . '<dlm>' . $member . '</dlm>'
                    . '<owner type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value . '</owner>'
                    . '<right right="' . $name . '">'
                        . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>'
                    . '</right>'
                . '</action>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</DistributionListActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DistributionListActionRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
                'action' => [
                    'op' => Operation::MODIFY()->value(),
                    'newName' => $name,
                    'subsReq' => [
                        'op' => DLSubscribeOp::SUBSCRIBE()->value(),
                        '_content' => $value,
                        'bccOwners' => true,
                    ],
                    'dlm' => [$member],
                    'owner' => [
                        [
                            'type' => GranteeType::USR()->value(),
                            '_content' => $value,
                            'by' => DLGranteeBy::ID()->value(),
                        ],
                    ],
                    'right' => [
                        [
                            'right' => $name,
                            'grantee' => [
                                [
                                    'type' => GranteeType::ALL()->value(),
                                    '_content' => $value,
                                    'by' => DLGranteeBy::NAME()->value(),
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
                'a' => [
                    [
                        'name' => $name,
                        'pd' => true,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDistributionListActionApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;

        $subsReq = new DistributionListSubscribeReq(DLSubscribeOp::SUBSCRIBE(), $value, true);
        $owner = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value);
        $grantee = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value);
        $right = new DistributionListRightSpec($name, [$grantee]);
        $a = new KeyValuePair($name, $value);
        $action = new DLAction(Operation::MODIFY(), $name, $subsReq, [$member], [$owner], [$right], [$a]);

        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $attr = new Attr($name, $value, true);

        $this->api->distributionListAction(
            $dl, $action, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DistributionListActionRequest>'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                        . '<urn1:action op="' . Operation::MODIFY() . '">'
                            . '<urn1:newName>' . $name . '</urn1:newName>'
                            . '<urn1:subsReq op="' . DLSubscribeOp::SUBSCRIBE() . '" bccOwners="true">' . $value . '</urn1:subsReq>'
                            . '<urn1:a n="' . $name . '">' . $value . '</urn1:a>'
                            . '<urn1:dlm>' . $member . '</urn1:dlm>'
                            . '<urn1:owner type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value . '</urn1:owner>'
                            . '<urn1:right right="' . $name . '">'
                                . '<urn1:grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</urn1:grantee>'
                            . '</urn1:right>'
                        . '</urn1:action>'
                        . '<urn1:a name="' . $name . '" pd="true">' . $value . '</urn1:a>'
                    . '</urn1:DistributionListActionRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
