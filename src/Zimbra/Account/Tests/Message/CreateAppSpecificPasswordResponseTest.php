<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CreateAppSpecificPasswordResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAppSpecificPasswordResponse.
 */
class CreateAppSpecificPasswordResponseTest extends ZimbraStructTestCase
{
    public function testCreateAppSpecificPasswordResponse()
    {
        $password = $this->faker->word;

        $req = new CreateAppSpecificPasswordResponse($password);
        $this->assertSame($password, $req->getPassword());

        $req = new CreateAppSpecificPasswordResponse();
        $req->setPassword($password);
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAppSpecificPasswordResponse xmlns="urn:zimbraAccount" password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateAppSpecificPasswordResponse::class, 'xml'));

        $json = json_encode([
            'password' => $password,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateAppSpecificPasswordResponse::class, 'json'));
    }
}
