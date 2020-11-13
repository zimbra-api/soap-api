<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckGalConfigBody;
use Zimbra\Admin\Message\CheckGalConfigRequest;
use Zimbra\Admin\Message\CheckGalConfigResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Admin\Struct\LimitedQuery;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckGalConfigBody.
 */
class CheckGalConfigBodyTest extends ZimbraStructTestCase
{
    public function testCheckGalConfigBody()
    {
        $limit = mt_rand(0, 10);
        $id = $this->faker->uuid;
        $action = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $request = new CheckGalConfigRequest(new LimitedQuery($limit, $value), $action, [new Attr($key, $value)]);
        $response = new CheckGalConfigResponse(
            $code,
            $message,
            [new GalContactInfo($id, [new Attr($key, $value)])]
        );

        $body = new CheckGalConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckGalConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckGalConfigRequest>'
                    . '<query limit="' . $limit . '">' . $value . '</query>'
                    . '<action>' . $action . '</action>'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CheckGalConfigRequest>'
                . '<urn:CheckGalConfigResponse>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                    . '<cn id="' . $id . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</cn>'
                . '</urn:CheckGalConfigResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckGalConfigBody::class, 'xml'));

        $json = json_encode([
            'CheckGalConfigRequest' => [
                'query' => [
                    'limit' => $limit,
                    '_content' => $value,
                ],
                'action' => [
                    '_content' => $action,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckGalConfigResponse' => [
                'code' => [
                    '_content' => $code,
                ],
                'message' => [
                    '_content' => $message,
                ],
                'cn' => [
                    [
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'id' => $id,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckGalConfigBody::class, 'json'));
    }
}
