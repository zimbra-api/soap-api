<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ChangePrimaryEmailBody;
use Zimbra\Admin\Message\ChangePrimaryEmailEnvelope;
use Zimbra\Admin\Message\ChangePrimaryEmailRequest;
use Zimbra\Admin\Message\ChangePrimaryEmailResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePrimaryEmail.
 */
class ChangePrimaryEmailTest extends ZimbraStructTestCase
{
    public function testChangePrimaryEmail()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $newName = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $name);
        $attr = new Attr($key, $value);
        $accInfo = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new ChangePrimaryEmailRequest(
            $account, $newName
        );
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($newName, $request->getNewName());

        $request = new ChangePrimaryEmailRequest(
            new AccountSelector(AccountBy::NAME(), ''), ''
        );
        $request->setAccount($account)
            ->setNewName($newName);
        $this->assertSame($account, $request->getAccount());
        $this->assertSame($newName, $request->getNewName());

        $response = new ChangePrimaryEmailResponse($accInfo);
        $this->assertEquals($accInfo, $response->getAccount());

        $response = new ChangePrimaryEmailResponse(new AccountInfo('', ''));
        $response->setAccount($accInfo);
        $this->assertEquals($accInfo, $response->getAccount());

        $body = new ChangePrimaryEmailBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ChangePrimaryEmailBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ChangePrimaryEmailEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ChangePrimaryEmailEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:ChangePrimaryEmailRequest>'
                        . '<account by="' . AccountBy::NAME() . '">' . $name . '</account>'
                        . '<newName>' . $newName . '</newName>'
                    . '</urn:ChangePrimaryEmailRequest>'
                    . '<urn:ChangePrimaryEmailResponse>'
                        . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</account>'
                    . '</urn:ChangePrimaryEmailResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ChangePrimaryEmailEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ChangePrimaryEmailRequest' => [
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $name,
                    ],
                    'newName' => [
                        '_content' => $newName,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ChangePrimaryEmailResponse' => [
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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ChangePrimaryEmailEnvelope::class, 'json'));
    }
}
