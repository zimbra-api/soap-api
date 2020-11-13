<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CreateDistributionListRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDistributionListRequest.
 */
class CreateDistributionListRequestTest extends ZimbraStructTestCase
{
    public function testCreateDistributionListRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateDistributionListRequest(
            $name, FALSE, [$attr]
        );

        $this->assertSame($name, $req->getName());
        $this->assertFalse($req->getDynamic());

        $req = new CreateDistributionListRequest('');
        $req->setName($name)
            ->setDynamic(TRUE)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getDynamic());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateDistributionListRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'dynamic' => TRUE,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateDistributionListRequest::class, 'json'));
    }
}
