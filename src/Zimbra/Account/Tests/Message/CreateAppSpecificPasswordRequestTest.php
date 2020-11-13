<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CreateAppSpecificPasswordRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAppSpecificPasswordRequest.
 */
class CreateAppSpecificPasswordRequestTest extends ZimbraStructTestCase
{
    public function testCreateAppSpecificPasswordRequest()
    {
        $appName = $this->faker->word;

        $req = new CreateAppSpecificPasswordRequest($appName);
        $this->assertSame($appName, $req->getAppName());

        $req = new CreateAppSpecificPasswordRequest('');
        $req->setAppName($appName);
        $this->assertSame($appName, $req->getAppName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAppSpecificPasswordRequest xmlns="urn:zimbraAccount" appName="' . $appName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateAppSpecificPasswordRequest::class, 'xml'));

        $json = json_encode([
            'appName' => $appName,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateAppSpecificPasswordRequest::class, 'json'));
    }
}
