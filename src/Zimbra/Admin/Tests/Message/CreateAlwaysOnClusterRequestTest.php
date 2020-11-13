<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CreateAlwaysOnClusterRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAlwaysOnClusterRequest.
 */
class CreateAlwaysOnClusterRequestTest extends ZimbraStructTestCase
{
    public function testCreateAlwaysOnClusterRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateAlwaysOnClusterRequest(
            $name, [$attr]
        );

        $this->assertSame($name, $req->getName());

        $req = new CreateAlwaysOnClusterRequest('');
        $req->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAlwaysOnClusterRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateAlwaysOnClusterRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateAlwaysOnClusterRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateAlwaysOnClusterRequest::class, 'json'));
    }
}
