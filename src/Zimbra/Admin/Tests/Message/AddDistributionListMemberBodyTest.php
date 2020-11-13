<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListMemberBody;
use Zimbra\Admin\Message\AddDistributionListMemberRequest;
use Zimbra\Admin\Message\AddDistributionListMemberResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListMemberBody.
 */
class AddDistributionListMemberBodyTest extends ZimbraStructTestCase
{
    public function testAddDistributionListMemberBody()
    {
        $id = $this->faker->uuid;
        $member = $this->faker->word;
        $request = new AddDistributionListMemberRequest($id, [$member]);
        $response = new AddDistributionListMemberResponse();

        $body = new AddDistributionListMemberBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddDistributionListMemberBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AddDistributionListMemberRequest id="' . $id . '">'
                    . '<dlm>' . $member . '</dlm>'
                . '</urn:AddDistributionListMemberRequest>'
                . '<urn:AddDistributionListMemberResponse />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AddDistributionListMemberBody::class, 'xml'));

        $json = json_encode([
            'AddDistributionListMemberRequest' => [
                'id' => $id,
                'dlm' => [
                    [
                        '_content' => $member,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AddDistributionListMemberResponse' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AddDistributionListMemberBody::class, 'json'));
    }
}
