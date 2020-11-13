<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CreateCosRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCosRequest.
 */
class CreateCosRequestTest extends ZimbraStructTestCase
{
    public function testCreateCosRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateCosRequest(
            $name, [$attr]
        );

        $this->assertSame($name, $req->getName());

        $req = new CreateCosRequest('');
        $req->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCosRequest>'
                . '<name>' . $name . '</name>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateCosRequest::class, 'xml'));

        $json = json_encode([
            'name' => [
                '_content' => $name,
            ],
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateCosRequest::class, 'json'));
    }
}
