<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CopyCosBody;
use Zimbra\Admin\Message\CopyCosRequest;
use Zimbra\Admin\Message\CopyCosResponse;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CopyCosBody.
 */
class CopyCosBodyTest extends ZimbraStructTestCase
{
    public function testCopyCosBody()
    {
        $newName = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new CopyCosRequest(new CosSelector(CosBy::NAME(), $value), $newName);
        $response = new CopyCosResponse(new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]));

        $body = new CopyCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CopyCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CopyCosRequest>'
                    . '<name>' . $newName . '</name>'
                    . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
                . '</urn:CopyCosRequest>'
                . '<urn:CopyCosResponse>'
                    . '<cos name="' . $name . '" id="' . $id . '" isDefaultCos="true">'
                        . '<a n="' . $key . '" c="true" pd="false">' . $value . '</a>'
                    . '</cos>'
                . '</urn:CopyCosResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CopyCosBody::class, 'xml'));

        $json = json_encode([
            'CopyCosRequest' => [
                'name' => [
                    '_content' => $newName,
                ],
                'cos' => [
                    'by' => (string) CosBy::NAME(),
                    '_content' => $value,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CopyCosResponse' => [
                'cos' => [
                    'name' => $name,
                    'id' => $id,
                    'isDefaultCos' => TRUE,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                            'c' => TRUE,
                            'pd' => FALSE,
                        ],
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CopyCosBody::class, 'json'));
    }
}
