<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckAuthConfigRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckAuthConfigRequest.
 */
class CheckAuthConfigRequestTest extends ZimbraStructTestCase
{
    public function testCheckAuthConfigRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CheckAuthConfigRequest(
            $name, $password, [$attr]
        );

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req = new CheckAuthConfigRequest(
            '', ''
        );
        $req->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckAuthConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckAuthConfigRequest::class, 'xml'));

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
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckAuthConfigRequest::class, 'json'));
    }
}
