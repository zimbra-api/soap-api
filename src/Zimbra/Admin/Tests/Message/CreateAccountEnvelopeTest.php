<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateAccountBody;
use Zimbra\Admin\Message\CreateAccountEnvelope;
use Zimbra\Admin\Message\CreateAccountRequest;
use Zimbra\Admin\Message\CreateAccountResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAccountEnvelope.
 */
class CreateAccountEnvelopeTest extends ZimbraStructTestCase
{
    public function testCreateAccountEnvelope()
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

        $envelope = new CreateAccountEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateAccountRequest name="' . $name . '" password="' . $password . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateAccountRequest>'
                    . '<urn:CreateAccountResponse>'
                        . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</account>'
                    . '</urn:CreateAccountResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
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
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateAccountEnvelope::class, 'json'));
    }
}
