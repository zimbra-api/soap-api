<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDistributionListBody;
use Zimbra\Admin\Message\CreateDistributionListEnvelope;
use Zimbra\Admin\Message\CreateDistributionListRequest;
use Zimbra\Admin\Message\CreateDistributionListResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDistributionList.
 */
class CreateDistributionListTest extends ZimbraStructTestCase
{
    public function testCreateDistributionList()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;

        $attr = new Attr($key, $value);
        $owner1 = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $owner2 = new GranteeInfo(
            $id, $name, GranteeType::USR()
        );

        $request = new CreateDistributionListRequest(
            $name, FALSE, [$attr]
        );
        $this->assertSame($name, $request->getName());
        $this->assertFalse($request->getDynamic());
        $request = new CreateDistributionListRequest('');
        $request->setName($name)
            ->setDynamic(TRUE)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());
        $this->assertTrue($request->getDynamic());

        $dl = new DistributionListInfo($name, $id, [$member1, $member2], [], [$owner1, $owner2], TRUE);
        $response = new CreateDistributionListResponse($dl);
        $this->assertSame($dl, $response->getDl());

        $response = new CreateDistributionListResponse(new DistributionListInfo('', ''));
        $response->setDl($dl);
        $this->assertSame($dl, $response->getDl());

        $body = new CreateDistributionListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateDistributionListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateDistributionListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateDistributionListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateDistributionListRequest>'
                    . '<urn:CreateDistributionListResponse>'
                        . '<dl name="' . $name . '" id="' . $id . '" dynamic="true">'
                            . '<dlm>' . $member1 . '</dlm>'
                            . '<dlm>' . $member2 . '</dlm>'
                            . '<owners>'
                                . '<owner id="' . $id . '" name="' . $name . '" type="' . GranteeType::ALL() . '" />'
                                . '<owner id="' . $id . '" name="' . $name . '" type="' . GranteeType::USR() . '" />'
                            . '</owners>'
                        . '</dl>'
                    . '</urn:CreateDistributionListResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDistributionListEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateDistributionListRequest' => [
                    'name' => $name,
                    'dynamic' => TRUE,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateDistributionListResponse' => [
                    'dl' => [
                        'name' => $name,
                        'id' => $id,
                        'dynamic' => true,
                        'dlm' => [
                            ['_content' => $member1],
                            ['_content' => $member2],
                        ],
                        'owners' => [
                            'owner' => [
                                [
                                    'id' => $id,
                                    'name' => $name,
                                    'type' => (string) GranteeType::ALL(),
                                ],
                                [
                                    'id' => $id,
                                    'name' => $name,
                                    'type' => (string) GranteeType::USR(),
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateDistributionListEnvelope::class, 'json'));
    }
}
