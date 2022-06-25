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
        $value1= $this->faker->text;
        $value2= $this->faker->text;
        $min= $this->faker->word;
        $max= $this->faker->word;
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

        $targetInfo = new EffectiveRightsTargetInfo(TargetType::ACCOUNT(), $id, $name, $setAttrs, $getAttrs, [$right]);

        $request = new GetEffectiveRightsRequest($targetSelector, $granteeSelector, TRUE, TRUE);
        $this->assertSame(
            implode(',', $expandAttrs),
            $request->getExpandAllAttrs()
        );
        $this->assertSame($targetSelector, $request->getTarget());
        $this->assertSame($granteeSelector, $request->getGrantee());
        $request = new GetEffectiveRightsRequest(new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), ''
        ));
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
        $response = new GetEffectiveRightsResponse(new GranteeInfo(
            $id, $name, GranteeType::ALL()
        ), new EffectiveRightsTargetInfo(TargetType::ACCOUNT(), $id, $name, $setAttrs, $getAttrs, [$right]));
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
            <target type="account" by="name">$value</target>
            <grantee type="all" by="name" secret="$secret" all="true">$value</grantee>
        </urn:GetEffectiveRightsRequest>
        <urn:GetEffectiveRightsResponse>
            <grantee id="$id" name="$name" type="all" />
            <target type="account" id="$id" name="$name">
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
            </target>
        </urn:GetEffectiveRightsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetEffectiveRightsEnvelope::class, 'xml'));
    }
}
