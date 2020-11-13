<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CreateAccountRequest;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAccountRequest.
 */
class CreateAccountRequestTest extends ZimbraStructTestCase
{
    public function testCreateAccountRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateAccountRequest(
            $name, $password, [$attr]
        );

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req = new CreateAccountRequest('', '');
        $req->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAccountRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateAccountRequest::class, 'xml'));

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
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateAccountRequest::class, 'json'));
    }
}
