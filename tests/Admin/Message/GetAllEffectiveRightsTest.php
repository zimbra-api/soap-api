<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

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

use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Enum\GranteeBy;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Common\Struct\NamedElement;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllEffectiveRightsTest.
 */
class GetAllEffectiveRightsTest extends ZimbraTestCase
{
    public function testGetAllEffectiveRights()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $value = $this->faker->text;
        $secret = $this->faker->text;
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
            <urn:grantee type="all" by="name" secret="$secret" all="true">$value</urn:grantee>
        </urn:GetAllEffectiveRightsRequest>
        <urn:GetAllEffectiveRightsResponse>
            <urn:grantee id="$id" name="$name" type="all" />
            <urn:target type="account">
                <urn:all>
                    <urn:right n="$name" />
                    <urn:setAttrs all="true">
                        <urn:a n="$name">
                            <urn:constraint>
                                <urn:min>$min</urn:min>
                                <urn:max>$max</urn:max>
                                <urn:values>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:values>
                            </urn:constraint>
                            <urn:default>
                                <urn:v>$value1</urn:v>
                                <urn:v>$value2</urn:v>
                            </urn:default>
                        </urn:a>
                    </urn:setAttrs>
                    <urn:getAttrs all="false">
                        <urn:a n="$name">
                            <urn:constraint>
                                <urn:min>$min</urn:min>
                                <urn:max>$max</urn:max>
                                <urn:values>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:values>
                            </urn:constraint>
                            <urn:default>
                                <urn:v>$value1</urn:v>
                                <urn:v>$value2</urn:v>
                            </urn:default>
                        </urn:a>
                    </urn:getAttrs>
                </urn:all>
                <urn:inDomains>
                    <urn:domain name="$name" />
                    <urn:rights>
                        <urn:right n="$name" />
                        <urn:setAttrs all="true">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2<urn:v>
                                </urn:default>
                            </urn:a>
                        </urn:setAttrs>
                        <urn:getAttrs all="false">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:default>
                            </urn:a>
                        </urn:getAttrs>
                    </urn:rights>
                </urn:inDomains>
                <urn:entries>
                    <urn:entry name="$name" />
                    <urn:rights>
                        <urn:right n="$name" />
                        <urn:setAttrs all="true">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </urn:default>
                            </urn:a>
                        </urn:setAttrs>
                        <urn:getAttrs all="false">
                            <urn:a n="$name">
                                <urn:constraint>
                                    <urn:min>$min</urn:min>
                                    <urn:max>$max</urn:max>
                                    <urn:values>
                                        <urn:v>$value1</urn:v>
                                        <urn:v>$value2</urn:v>
                                    </urn:values>
                                </urn:constraint>
                                <urn:default>
                                    <urn:v>$value1</urn:v>
                                    <urn:v>$value2</urn:v>
                                </durn:efault>
                            </urn:a>
                        </urn:getAttrs>
                    </urn:rights>
                </urn:entries>
            </urn:target>
        </urn:GetAllEffectiveRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllEffectiveRightsEnvelope::class, 'xml'));
    }
}
