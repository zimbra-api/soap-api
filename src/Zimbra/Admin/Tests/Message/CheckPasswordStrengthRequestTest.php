<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckPasswordStrengthRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckPasswordStrengthRequest.
 */
class CheckPasswordStrengthRequestTest extends ZimbraStructTestCase
{
    public function testCheckPasswordStrengthRequest()
    {
        $id = $this->faker->uuid;
        $password = $this->faker->word;

        $req = new CheckPasswordStrengthRequest($id, $password);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $req = new CheckPasswordStrengthRequest('', '');
        $req->setId($id)
            ->setPassword($password);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckPasswordStrengthRequest id="' . $id . '" password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckPasswordStrengthRequest::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'password' => $password,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckPasswordStrengthRequest::class, 'json'));
    }
}
