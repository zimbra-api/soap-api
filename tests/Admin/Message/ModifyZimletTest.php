<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyZimletBody;
use Zimbra\Admin\Message\ModifyZimletEnvelope;
use Zimbra\Admin\Message\ModifyZimletRequest;
use Zimbra\Admin\Message\ModifyZimletResponse;
use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Admin\Struct\ZimletAclStatusPri;
use Zimbra\Common\Enum\AclType;
use Zimbra\Common\Enum\ZimletStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyZimlet.
 */
class ModifyZimletTest extends ZimbraTestCase
{
    public function testModifyZimlet()
    {
        $name = $this->faker->word;
        $cos = $this->faker->word;
        $value = mt_rand(0, 10);

        $zimlet = new ZimletAclStatusPri(
            $name,
            new ZimletAcl($cos, AclType::GRANT()),
            new ValueAttrib(ZimletStatus::ENABLED()->getValue()),
            new IntegerValueAttrib($value)
        );

        $request = new ModifyZimletRequest($zimlet);
        $this->assertEquals($zimlet, $request->getZimlet());
        $request = new ModifyZimletRequest(new ZimletAclStatusPri(''));
        $request->setZimlet($zimlet);
        $this->assertEquals($zimlet, $request->getZimlet());

        $response = new ModifyZimletResponse();

        $body = new ModifyZimletBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyZimletBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyZimletEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyZimletEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyZimletRequest>
            <zimlet name="$name">
                <acl cos="$cos" acl="grant" />
                <status value="enabled" />
                <priority value="$value" />
            </zimlet>
        </urn:ModifyZimletRequest>
        <urn:ModifyZimletResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyZimletEnvelope::class, 'xml'));
    }
}
