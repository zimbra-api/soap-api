<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetAdminConsoleUICompBody, GetAdminConsoleUICompEnvelope, GetAdminConsoleUICompRequest, GetAdminConsoleUICompResponse};
use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Admin\Struct\InheritedFlaggedValue;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Common\Enum\DistributionListBy as DLBy;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAdminConsoleUIComp.
 */
class GetAdminConsoleUICompTest extends ZimbraTestCase
{
    public function testGetAdminConsoleUIComp()
    {
        $value = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $val = new InheritedFlaggedValue(TRUE, $value);

        $request = new GetAdminConsoleUICompRequest($account, $dl);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($dl, $request->getDl());
        $request = new GetAdminConsoleUICompRequest();
        $request->setAccount($account)
            ->setDl($dl);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($dl, $request->getDl());

        $response = new GetAdminConsoleUICompResponse([$val]);
        $this->assertSame([$val], $response->getValues());
        $response = new GetAdminConsoleUICompResponse();
        $response->setValues([$val]);
        $this->assertSame([$val], $response->getValues());

        $body = new GetAdminConsoleUICompBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAdminConsoleUICompBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAdminConsoleUICompEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAdminConsoleUICompEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAdminConsoleUICompRequest>
            <urn:account by="name">$value</urn:account>
            <urn:dl by="name">$value</urn:dl>
        </urn:GetAdminConsoleUICompRequest>
        <urn:GetAdminConsoleUICompResponse>
            <urn:a inherited="true">$value</urn:a>
        </urn:GetAdminConsoleUICompResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAdminConsoleUICompEnvelope::class, 'xml'));
    }
}
