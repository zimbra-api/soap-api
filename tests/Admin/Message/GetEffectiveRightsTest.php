<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetEffectiveRightsBody;
use Zimbra\Admin\Message\GetEffectiveRightsEnvelope;
use Zimbra\Admin\Message\GetEffectiveRightsRequest;
use Zimbra\Admin\Message\GetEffectiveRightsResponse;

use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Admin\Struct\GranteeSelector;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\EffectiveRightsTargetInfo;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\InDomainInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Admin\Struct\RightsEntriesInfo;

use Zimbra\Common\Enum\GranteeBy;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Common\Enum\TargetBy;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Struct\NamedElement;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetEffectiveRightsTest.
 */
class GetEffectiveRightsTest extends ZimbraTestCase
{
    public function testGetEffectiveRights()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $value1 = $this->faker->unique->word;
        $value2 = $this->faker->unique->word;
        $min = $this->faker->word;
        $max = $this->faker->word;
        $expandAttrs = [GetEffectiveRightsRequest::EXPAND_SET_ATTRS, GetEffectiveRightsRequest::EXPAND_GET_ATTRS];

        $granteeSelector = new GranteeSelector(
            $value, GranteeType::ALL(), GranteeBy::NAME(), $secret, TRUE
        );
        $targetSelector = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
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

        $targetInfo = new EffectiveRightsTargetInfo($setAttrs, $getAttrs, TargetType::ACCOUNT(), $id, $name, [$right]);

        $request = new GetEffectiveRightsRequest($targetSelector, $granteeSelector, TRUE, TRUE);
        $this->assertSame(
            implode(',', $expandAttrs),
            $request->getExpandAllAttrs()
        );
        $this->assertSame($targetSelector, $request->getTarget());
        $this->assertSame($granteeSelector, $request->getGrantee());
        $request = new GetEffectiveRightsRequest(new EffectiveRightsTargetSelector());
        $request->setTarget($targetSelector)
            ->setGrantee($granteeSelector)
             ->setExpandAllAttrs(GetEffectiveRightsRequest::EXPAND_SET_ATTRS);
        $this->assertSame(
            GetEffectiveRightsRequest::EXPAND_SET_ATTRS,
            $request->getExpandAllAttrs()
        );
        $this->assertSame($targetSelector, $request->getTarget());
        $this->assertSame($granteeSelector, $request->getGrantee());

        $response = new GetEffectiveRightsResponse($granteeInfo, $targetInfo);
        $this->assertSame($granteeInfo, $response->getGrantee());
        $this->assertSame($targetInfo, $response->getTarget());
        $response = new GetEffectiveRightsResponse();
        $response->setGrantee($granteeInfo)
            ->setTarget($targetInfo);
        $this->assertSame($granteeInfo, $response->getGrantee());
        $this->assertSame($targetInfo, $response->getTarget());

        $body = new GetEffectiveRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetEffectiveRightsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetEffectiveRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetEffectiveRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetEffectiveRightsRequest expandAllAttrs="setAttrs">
            <urn:target type="account" by="name">$value</urn:target>
            <urn:grantee type="all" by="name" secret="$secret" all="true">$value</urn:grantee>
        </urn:GetEffectiveRightsRequest>
        <urn:GetEffectiveRightsResponse>
            <urn:grantee id="$id" name="$name" type="all" />
            <urn:target type="account" id="$id" name="$name">
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
            </urn:target>
        </urn:GetEffectiveRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetEffectiveRightsEnvelope::class, 'xml'));
    }
}
