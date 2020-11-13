<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AdminCreateWaitSetResponse;
use Zimbra\Struct\IdAndType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminCreateWaitSetResponse.
 */
class AdminCreateWaitSetResponseTest extends ZimbraStructTestCase
{
    public function testAdminCreateWaitSetResponse()
    {
        $waitSetId = $this->faker->uuid;
        $defaultInterests = $this->faker->word;
        $sequence = mt_rand(1, 99);

        $id = $this->faker->uuid;
        $type = $this->faker->word;
        $error = new IdAndType($id, $type);

        $res = new AdminCreateWaitSetResponse(
            $waitSetId, $defaultInterests, $sequence, [$error]
        );
        $this->assertSame($waitSetId, $res->getWaitSetId());
        $this->assertSame($defaultInterests, $res->getDefaultInterests());
        $this->assertSame($sequence, $res->getSequence());
        $this->assertSame([$error], $res->getErrors());

        $res = new AdminCreateWaitSetResponse('', '', 0);
        $res->setWaitSetId($waitSetId)
            ->setDefaultInterests($defaultInterests)
            ->setSequence($sequence)
            ->setErrors([$error])
            ->addError($error);
        $this->assertSame($waitSetId, $res->getWaitSetId());
        $this->assertSame($defaultInterests, $res->getDefaultInterests());
        $this->assertSame($sequence, $res->getSequence());
        $this->assertSame([$error, $error], $res->getErrors());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminCreateWaitSetResponse waitSet="' . $waitSetId . '" defTypes="' . $defaultInterests . '" seq="' . $sequence . '">'
                . '<error id="' . $id . '" type="' . $type . '" />'
                . '<error id="' . $id . '" type="' . $type . '" />'
            . '</AdminCreateWaitSetResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AdminCreateWaitSetResponse::class, 'xml'));

        $json = json_encode([
            'waitSet' => $waitSetId,
            'defTypes' => $defaultInterests,
            'seq' => $sequence,
            'error' => [
                [
                    'id' => $id,
                    'type' => $type,
                ],
                [
                    'id' => $id,
                    'type' => $type,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AdminCreateWaitSetResponse::class, 'json'));
    }
}
