<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Enum\TargetType;

use Zimbra\Mail\Message\CheckPermissionEnvelope;
use Zimbra\Mail\Message\CheckPermissionBody;
use Zimbra\Mail\Message\CheckPermissionRequest;
use Zimbra\Mail\Message\CheckPermissionResponse;

use Zimbra\Mail\Struct\RightPermission;
use Zimbra\Mail\Struct\TargetSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckPermission.
 */
class CheckPermissionTest extends ZimbraTestCase
{
    public function testCheckPermission()
    {
        $targetType = TargetType::ACCOUNT();
        $accountBy = AccountBy::NAME();
        $value = $this->faker->email;
        $right1 = $this->faker->unique()->word;
        $right2 = $this->faker->unique()->word;
        $rightName = $this->faker->word;

        $target = new TargetSpec($targetType, $accountBy, $value);

        $request = new CheckPermissionRequest($target, [$right1, $right2]);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame([$right1, $right2], $request->getRights());
        $request = new CheckPermissionRequest();
        $request->setTarget($target)
            ->setRights([$right1])
            ->addRight($right2);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame([$right1, $right2], $request->getRights());

        $right = new RightPermission(TRUE, $rightName);
        $response = new CheckPermissionResponse(FALSE, [$right]);
        $this->assertFalse($response->getAllow());
        $this->assertSame([$right], $response->getRights());
        $response = new CheckPermissionResponse(FALSE);
        $response->setAllow(TRUE)
            ->setRights([$right])
            ->addRight($right);
        $this->assertTrue($response->getAllow());
        $this->assertSame([$right, $right], $response->getRights());
        $response->setRights([$right]);

        $body = new CheckPermissionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CheckPermissionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckPermissionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CheckPermissionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CheckPermissionRequest>
            <urn:target type="account" by="name">$value</urn:target>
            <urn:right>$right1</urn:right>
            <urn:right>$right2</urn:right>
        </urn:CheckPermissionRequest>
        <urn:CheckPermissionResponse allow="true">
            <urn:right allow="true">$rightName</urn:right>
        </urn:CheckPermissionResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckPermissionEnvelope::class, 'xml'));
    }
}
