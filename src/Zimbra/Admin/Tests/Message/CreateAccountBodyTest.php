<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateAccountBody;
use Zimbra\Admin\Message\CreateAccountRequest;
use Zimbra\Admin\Message\CreateAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAccountBody.
 */
class CreateAccountBodyTest extends ZimbraStructTestCase
{
    public function testCreateAccountBody()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new Attr($key, $value);
        $account = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new CreateAccountRequest(
            $name, $password, [$attr]
        );
        $response = new CreateAccountResponse($account);

        $body = new CreateAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateAccountRequest name="' . $name . '" password="' . $password . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CreateAccountRequest>'
                . '<urn:CreateAccountResponse>'
                    . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</account>'
                . '</urn:CreateAccountResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateAccountBody::class, 'xml'));

        $json = json_encode([
            'CreateAccountRequest' => [
                'name' => $name,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CreateAccountResponse' => [
                'account' => [
                    'name' => $name,
                    'id' => $id,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    'isExternal' => TRUE,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateAccountBody::class, 'json'));
    }
}
