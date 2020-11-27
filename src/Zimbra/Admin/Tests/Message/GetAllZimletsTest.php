<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllZimletsBody;
use Zimbra\Admin\Message\GetAllZimletsEnvelope;
use Zimbra\Admin\Message\GetAllZimletsRequest;
use Zimbra\Admin\Message\GetAllZimletsResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ZimletInfo;
use Zimbra\Enum\ZimletExcludeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllZimletsTest.
 */
class GetAllZimletsTest extends ZimbraStructTestCase
{
    public function testGetAllZimlets()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $hasKeyword = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $zimlet = new ZimletInfo($name, $id, [new Attr($key, $value)], $hasKeyword);

        $request = new GetAllZimletsRequest(ZimletExcludeType::EXTENSION());
        $this->assertEquals(ZimletExcludeType::EXTENSION(), $request->getExclude());
        $request->setExclude(ZimletExcludeType::NONE());
        $this->assertEquals(ZimletExcludeType::NONE(), $request->getExclude());

        $response = new GetAllZimletsResponse([$zimlet]);
        $this->assertSame([$zimlet], $response->getZimlets());
        $response = new GetAllZimletsResponse();
        $response->setZimlets([$zimlet])
            ->addZimlet($zimlet);
        $this->assertSame([$zimlet, $zimlet], $response->getZimlets());
        $response->setZimlets([$zimlet]);

        $body = new GetAllZimletsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllZimletsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllZimletsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllZimletsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAllZimletsRequest exclude="' . ZimletExcludeType::NONE() . '" />'
                    . '<urn:GetAllZimletsResponse>'
                        . '<zimlet name="' . $name . '" id="' . $id . '" hasKeyword="' . $hasKeyword . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</zimlet>'
                    . '</urn:GetAllZimletsResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllZimletsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllZimletsRequest' => [
                    'exclude' => ZimletExcludeType::NONE()->getValue(),
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllZimletsResponse' => [
                    'zimlet' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'hasKeyword' => $hasKeyword,
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllZimletsEnvelope::class, 'json'));
    }
}
