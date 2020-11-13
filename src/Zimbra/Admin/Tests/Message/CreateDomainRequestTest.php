<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CreateDomainRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDomainRequest.
 */
class CreateDomainRequestTest extends ZimbraStructTestCase
{
    public function testCreateDomainRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateDomainRequest(
            $name, [$attr]
        );
        $this->assertSame($name, $req->getName());

        $req = new CreateDomainRequest('');
        $req->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDomainRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateDomainRequest::class, 'xml'));

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
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateDomainRequest::class, 'json'));
    }
}
