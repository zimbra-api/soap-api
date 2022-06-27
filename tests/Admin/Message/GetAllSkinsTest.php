<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllSkinsBody;
use Zimbra\Admin\Message\GetAllSkinsEnvelope;
use Zimbra\Admin\Message\GetAllSkinsRequest;
use Zimbra\Admin\Message\GetAllSkinsResponse;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllSkinsTest.
 */
class GetAllSkinsTest extends ZimbraTestCase
{
    public function testGetAllSkins()
    {
        $name = $this->faker->word;

        $skin = new NamedElement($name);

        $request = new GetAllSkinsRequest();

        $response = new GetAllSkinsResponse([$skin]);
        $this->assertSame([$skin], $response->getSkins());
        $response = new GetAllSkinsResponse();
        $response->setSkins([$skin])
            ->addSkin($skin);
        $this->assertSame([$skin, $skin], $response->getSkins());
        $response->setSkins([$skin]);

        $body = new GetAllSkinsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllSkinsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllSkinsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllSkinsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllSkinsRequest />
        <urn:GetAllSkinsResponse>
            <urn:skin name="$name" />
        </urn:GetAllSkinsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllSkinsEnvelope::class, 'xml'));
    }
}
