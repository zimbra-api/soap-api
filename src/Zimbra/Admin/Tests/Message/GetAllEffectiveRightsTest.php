<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllEffectiveRightsBody;
use Zimbra\Admin\Message\GetAllEffectiveRightsEnvelope;
use Zimbra\Admin\Message\GetAllEffectiveRightsRequest;
use Zimbra\Admin\Message\GetAllEffectiveRightsResponse;

use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Admin\Struct\GranteeSelector;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\EffectiveRightsTarget;
use Zimbra\Admin\Struct\InDomainInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Admin\Struct\RightsEntriesInfo;

use Zimbra\Enum\TargetType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\NamedElement;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllEffectiveRightsTest.
 */
class GetAllEffectiveRightsTest extends ZimbraStructTestCase
{
    public function testGetAllEffectiveRights()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->text;
        $secret = $this->faker->password;
        $value1= $this->faker->text;
        $value2= $this->faker->text;
        $min= $this->faker->word;
        $max= $this->faker->word;

        $granteeSelector = new GranteeSelector(
            $value, GranteeType::ALL(), GranteeBy::NAME(), $secret, TRUE
        );
        $granteeInfo = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);
        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);

        $domain = new NamedElement($name);
        $entry = new NamedElement($name);
        $inDomains = new InDomainInfo($rights, [$domain]);
        $entries = new RightsEntriesInfo($rights, [$entry]);

        $target = new EffectiveRightsTarget(TargetType::ACCOUNT(), $rights, [$inDomains], [$entries]);

        $expandAttrs = [GetAllEffectiveRightsRequest::EXPAND_SET_ATTRS, GetAllEffectiveRightsRequest::EXPAND_GET_ATTRS];
        $request = new GetAllEffectiveRightsRequest($granteeSelector, TRUE, TRUE);
        $this->assertSame(
            implode(',', $expandAttrs),
            $request->getExpandAllAttrs()
        );
        $this->assertSame($granteeSelector, $request->getGrantee());
        $request = new GetAllEffectiveRightsRequest();
        $request->setGrantee($granteeSelector)
             ->setExpandAllAttrs(GetAllEffectiveRightsRequest::EXPAND_SET_ATTRS);
        $this->assertSame(
            GetAllEffectiveRightsRequest::EXPAND_SET_ATTRS,
            $request->getExpandAllAttrs()
        );
        $this->assertSame($granteeSelector, $request->getGrantee());

        $response = new GetAllEffectiveRightsResponse($granteeInfo, [$target]);
        $this->assertSame($granteeInfo, $response->getGrantee());
        $this->assertSame([$target], $response->getTargets());
        $response = new GetAllEffectiveRightsResponse();
        $response->setGrantee($granteeInfo)
            ->setTargets([$target])
            ->addTarget($target);
        $this->assertSame($granteeInfo, $response->getGrantee());
        $this->assertSame([$target, $target], $response->getTargets());
        $response->setTargets([$target]);

        $body = new GetAllEffectiveRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllEffectiveRightsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllEffectiveRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllEffectiveRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllEffectiveRightsRequest expandAllAttrs="setAttrs">
            <grantee type="all" by="name" secret="$secret" all="true">$value</grantee>
        </urn:GetAllEffectiveRightsRequest>
        <urn:GetAllEffectiveRightsResponse>
            <grantee id="$id" name="$name" type="all" />
            <target type="account">
                <all>
                    <right n="$name" />
                    <setAttrs all="true">
                        <a n="$name">
                            <constraint>
                                <min>$min</min>
                                <max>$max</max>
                                <values>
                                    <v>$value1</v>
                                    <v>$value2</v>
                                </values>
                            </constraint>
                            <default>
                                <v>$value1</v>
                                <v>$value2</v>
                            </default>
                        </a>
                    </setAttrs>
                    <getAttrs all="false">
                        <a n="$name">
                            <constraint>
                                <min>$min</min>
                                <max>$max</max>
                                <values>
                                    <v>$value1</v>
                                    <v>$value2</v>
                                </values>
                            </constraint>
                            <default>
                                <v>$value1</v>
                                <v>$value2</v>
                            </default>
                        </a>
                    </getAttrs>
                </all>
                <inDomains>
                    <domain name="$name" />
                    <rights>
                        <right n="$name" />
                        <setAttrs all="true">
                            <a n="$name">
                                <constraint>
                                    <min>$min</min>
                                    <max>$max</max>
                                    <values>
                                        <v>$value1</v>
                                        <v>$value2</v>
                                    </values>
                                </constraint>
                                <default>
                                    <v>$value1</v>
                                    <v>$value2</v>
                                </default>
                            </a>
                        </setAttrs>
                        <getAttrs all="false">
                            <a n="$name">
                                <constraint>
                                    <min>$min</min>
                                    <max>$max</max>
                                    <values>
                                        <v>$value1</v>
                                        <v>$value2</v>
                                    </values>
                                </constraint>
                                <default>
                                    <v>$value1</v>
                                    <v>$value2</v>
                                </default>
                            </a>
                        </getAttrs>
                    </rights>
                </inDomains>
                <entries>
                    <entry name="$name" />
                    <rights>
                        <right n="$name" />
                        <setAttrs all="true">
                            <a n="$name">
                                <constraint>
                                    <min>$min</min>
                                    <max>$max</max>
                                    <values>
                                        <v>$value1</v>
                                        <v>$value2</v>
                                    </values>
                                </constraint>
                                <default>
                                    <v>$value1</v>
                                    <v>$value2</v>
                                </default>
                            </a>
                        </setAttrs>
                        <getAttrs all="false">
                            <a n="$name">
                                <constraint>
                                    <min>$min</min>
                                    <max>$max</max>
                                    <values>
                                        <v>$value1</v>
                                        <v>$value2</v>
                                    </values>
                                </constraint>
                                <default>
                                    <v>$value1</v>
                                    <v>$value2</v>
                                </default>
                            </a>
                        </getAttrs>
                    </rights>
                </entries>
            </target>
        </urn:GetAllEffectiveRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllEffectiveRightsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllEffectiveRightsRequest' => [
                    'expandAllAttrs' => 'setAttrs',
                    'grantee' => [
                        'type' => 'all',
                        'by' => 'name',
                        '_content' => $value,
                        'secret' => $secret,
                        'all' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllEffectiveRightsResponse' => [
                    'grantee' => [
                        'id' => $id,
                        'name' => $name,
                        'type' => 'all',
                    ],
                    'target' => [
                        [
                            'type' => 'account',
                            'all' => [
                                'right' => [
                                    [
                                        'n' => $name,
                                    ],
                                ],
                                'setAttrs' => [
                                    'all' => TRUE,
                                    'a' => [
                                        [
                                            'n' => $name,
                                            'constraint' => [
                                                'min' => [
                                                    '_content' => $min,
                                                ],
                                                'max' => [
                                                    '_content' => $max,
                                                ],
                                                'values' => [
                                                    'v' => [
                                                        [
                                                            '_content' => $value1,
                                                        ],
                                                        [
                                                            '_content' => $value2,
                                                        ],
                                                    ],
                                                ],
                                            ],
                                            'default' => [
                                                'v' => [
                                                    [
                                                        '_content' => $value1,
                                                    ],
                                                    [
                                                        '_content' => $value2,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'getAttrs' => [
                                    'all' => FALSE,
                                    'a' => [
                                        [
                                            'n' => $name,
                                            'constraint' => [
                                                'min' => [
                                                    '_content' => $min,
                                                ],
                                                'max' => [
                                                    '_content' => $max,
                                                ],
                                                'values' => [
                                                    'v' => [
                                                        [
                                                            '_content' => $value1,
                                                        ],
                                                        [
                                                            '_content' => $value2,
                                                        ],
                                                    ],
                                                ],
                                            ],
                                            'default' => [
                                                'v' => [
                                                    [
                                                        '_content' => $value1,
                                                    ],
                                                    [
                                                        '_content' => $value2,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'inDomains' => [
                                [
                                    'domain' => [
                                        [
                                            'name' => $name,
                                        ],
                                    ],
                                    'rights' => [
                                        'right' => [
                                            [
                                                'n' => $name,
                                            ],
                                        ],
                                        'setAttrs' => [
                                            'all' => TRUE,
                                            'a' => [
                                                [
                                                    'n' => $name,
                                                    'constraint' => [
                                                        'min' => [
                                                            '_content' => $min,
                                                        ],
                                                        'max' => [
                                                            '_content' => $max,
                                                        ],
                                                        'values' => [
                                                            'v' => [
                                                                [
                                                                    '_content' => $value1,
                                                                ],
                                                                [
                                                                    '_content' => $value2,
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                    'default' => [
                                                        'v' => [
                                                            [
                                                                '_content' => $value1,
                                                            ],
                                                            [
                                                                '_content' => $value2,
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                        'getAttrs' => [
                                            'all' => FALSE,
                                            'a' => [
                                                [
                                                    'n' => $name,
                                                    'constraint' => [
                                                        'min' => [
                                                            '_content' => $min,
                                                        ],
                                                        'max' => [
                                                            '_content' => $max,
                                                        ],
                                                        'values' => [
                                                            'v' => [
                                                                [
                                                                    '_content' => $value1,
                                                                ],
                                                                [
                                                                    '_content' => $value2,
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                    'default' => [
                                                        'v' => [
                                                            [
                                                                '_content' => $value1,
                                                            ],
                                                            [
                                                                '_content' => $value2,
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'entries' => [
                                [
                                    'entry' => [
                                        [
                                            'name' => $name,
                                        ],
                                    ],
                                    'rights' => [
                                        'right' => [
                                            [
                                                'n' => $name,
                                            ],
                                        ],
                                        'setAttrs' => [
                                            'all' => TRUE,
                                            'a' => [
                                                [
                                                    'n' => $name,
                                                    'constraint' => [
                                                        'min' => [
                                                            '_content' => $min,
                                                        ],
                                                        'max' => [
                                                            '_content' => $max,
                                                        ],
                                                        'values' => [
                                                            'v' => [
                                                                [
                                                                    '_content' => $value1,
                                                                ],
                                                                [
                                                                    '_content' => $value2,
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                    'default' => [
                                                        'v' => [
                                                            [
                                                                '_content' => $value1,
                                                            ],
                                                            [
                                                                '_content' => $value2,
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                        'getAttrs' => [
                                            'all' => FALSE,
                                            'a' => [
                                                [
                                                    'n' => $name,
                                                    'constraint' => [
                                                        'min' => [
                                                            '_content' => $min,
                                                        ],
                                                        'max' => [
                                                            '_content' => $max,
                                                        ],
                                                        'values' => [
                                                            'v' => [
                                                                [
                                                                    '_content' => $value1,
                                                                ],
                                                                [
                                                                    '_content' => $value2,
                                                                ],
                                                            ],
                                                        ],
                                                    ],
                                                    'default' => [
                                                        'v' => [
                                                            [
                                                                '_content' => $value1,
                                                            ],
                                                            [
                                                                '_content' => $value2,
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllEffectiveRightsEnvelope::class, 'json'));
    }
}
