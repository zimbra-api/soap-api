<?php

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListMemberBody;
use Zimbra\Admin\Message\AddDistributionListMemberEnvelope;
use Zimbra\Admin\Message\AddDistributionListMemberRequest;
use Zimbra\Admin\Message\AddDistributionListMemberResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListMemberEnvelope.
 */
class AddDistributionListMemberEnvelopeTest extends ZimbraStructTestCase
{
    public function testAddDistributionListMemberEnvelope()
    {
        $id = $this->faker->uuid;
        $member = $this->faker->word;
        $request = new AddDistributionListMemberRequest($id, [$member]);
        $response = new AddDistributionListMemberResponse();
        $body = new AddDistributionListMemberBody($request, $response);

        $envelope = new AddDistributionListMemberEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddDistributionListMemberEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body xmlns:urn="urn:zimbraAdmin">'
                    . '<urn:AddDistributionListMemberRequest id="' . $id . '">'
                        . '<dlm>' . $member . '</dlm>'
                    . '</urn:AddDistributionListMemberRequest>'
                    . '<urn:AddDistributionListMemberResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));

        $response = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddDistributionListMemberEnvelope', 'xml');
        $body = $envelope->getBody();
        $request = $body->getRequest();
        $response = $body->getResponse();

        $this->assertSame($id, $request->getId());
        $this->assertSame([$member], $request->getMembers());
        $this->assertTrue($response instanceof AddDistributionListMemberResponse);
    }
}
