<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CreateCalendarResourceRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateCalendarResourceRequest.
 */
class CreateCalendarResourceRequestTest extends ZimbraStructTestCase
{
    public function testCreateCalendarResourceRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateCalendarResourceRequest(
            $name, $password, [$attr]
        );

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req = new CreateCalendarResourceRequest('', '');
        $req->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateCalendarResourceRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'password' => $password,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateCalendarResourceRequest::class, 'json'));
    }
}
