<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListMemberBody;
use Zimbra\Admin\Message\AddDistributionListMemberEnvelope;
use Zimbra\Admin\Message\AddDistributionListMemberRequest;
use Zimbra\Admin\Message\AddDistributionListMemberResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListMember.
 */
class AddDistributionListMemberTest extends ZimbraStructTestCase
{
    public function testAddDistributionListMemberRequest()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;

        $req = new AddDistributionListMemberRequest($id, [$member1]);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1], $req->getMembers());

        $req = new AddDistributionListMemberRequest('', []);
        $req->setId($id)
            ->setMembers([$member1])
            ->addMember($member2);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1, $member2], $req->getMembers());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListMemberRequest id="' . $id . '">'
                . '<dlm>' . $member1 . '</dlm>'
                . '<dlm>' . $member2 . '</dlm>'
            . '</AddDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddDistributionListMemberRequest::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'dlm' => [
                [
                    '_content' => $member1,
                ],
                [
                    '_content' => $member2,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddDistributionListMemberRequest::class, 'json'));
    }

    public function testAddDistributionListMemberResponse()
    {
        $res = new AddDistributionListMemberResponse();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListMemberResponse />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AddDistributionListMemberResponse::class, 'xml'));

        $json = json_encode(new \stdClass);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AddDistributionListMemberResponse::class, 'json'));
    }

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
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddDistributionListMemberEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
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
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddDistributionListMemberEnvelope::class, 'json'));
    }
}
