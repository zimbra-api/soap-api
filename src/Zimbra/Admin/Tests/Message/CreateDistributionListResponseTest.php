<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDistributionListResponse;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDistributionListResponse.
 */
class CreateDistributionListResponseTest extends ZimbraStructTestCase
{
    public function testCreateDistributionListResponse()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $member1 = $this->faker->word;
        $member2 = $this->faker->word;

        $owner1 = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $owner2 = new GranteeInfo(
            $id, $name, GranteeType::USR()
        );

        $dl = new DistributionListInfo($name, $id, [$member1, $member2], [], [$owner1, $owner2], TRUE);

        $res = new CreateDistributionListResponse($dl);
        $this->assertSame($dl, $res->getDl());

        $res = new CreateDistributionListResponse(new DistributionListInfo('', ''));
        $res->setDl($dl);
        $this->assertSame($dl, $res->getDl());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDistributionListResponse>'
                . '<dl name="' . $name . '" id="' . $id . '" dynamic="true">'
                    . '<dlm>' . $member1 . '</dlm>'
                    . '<dlm>' . $member2 . '</dlm>'
                    . '<owners>'
                        . '<owner id="' . $id . '" name="' . $name . '" type="' . GranteeType::ALL() . '" />'
                        . '<owner id="' . $id . '" name="' . $name . '" type="' . GranteeType::USR() . '" />'
                    . '</owners>'
                . '</dl>'
            . '</CreateDistributionListResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateDistributionListResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateDistributionListResponse::class, 'json'));
    }
}
