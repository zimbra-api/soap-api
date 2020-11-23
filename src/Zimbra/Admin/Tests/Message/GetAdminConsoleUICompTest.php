<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\{GetAdminConsoleUICompBody, GetAdminConsoleUICompEnvelope, GetAdminConsoleUICompRequest, GetAdminConsoleUICompResponse};
use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Admin\Struct\InheritedFlaggedValue;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAdminConsoleUIComp.
 */
class GetAdminConsoleUICompTest extends ZimbraStructTestCase
{
    public function testGetAdminConsoleUIComp()
    {
        $value = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);
        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $flag = new InheritedFlaggedValue(TRUE, $value);

        $request = new GetAdminConsoleUICompRequest($account, $dl);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($dl, $request->getDl());
        $request = new GetAdminConsoleUICompRequest();
        $request->setAccount($account)
            ->setDl($dl);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($dl, $request->getDl());

        $response = new GetAdminConsoleUICompResponse([$flag]);
        $this->assertSame([$flag], $response->getValues());

        $response = new GetAdminConsoleUICompResponse();
        $response->setValues([$flag])
            ->addValue($flag);
        $this->assertSame([$flag, $flag], $response->getValues());
        $response->setValues([$flag]);

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAdminConsoleUICompRequest>'
                        . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                        . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
                    . '</urn:GetAdminConsoleUICompRequest>'
                    . '<urn:GetAdminConsoleUICompResponse>'
                        . '<a inherited="true">' . $value . '</a>'
                    . '</urn:GetAdminConsoleUICompResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAdminConsoleUICompEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAdminConsoleUICompRequest' => [
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $value,
                    ],
                    'dl' => [
                        'by' => (string) DLBy::NAME(),
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAdminConsoleUICompResponse' => [
                    'a' => [
                        [
                            'inherited' => TRUE,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAdminConsoleUICompEnvelope::class, 'json'));
    }
}
