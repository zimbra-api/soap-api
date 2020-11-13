<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ChangePrimaryEmailBody;
use Zimbra\Admin\Message\ChangePrimaryEmailRequest;
use Zimbra\Admin\Message\ChangePrimaryEmailResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePrimaryEmailBody.
 */
class ChangePrimaryEmailBodyTest extends ZimbraStructTestCase
{
    public function testChangePrimaryEmailBody()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $newName = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $name);
        $attr = new Attr($key, $value);
        $AccountInfo = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new ChangePrimaryEmailRequest(
            $account, $newName
        );
        $response = new ChangePrimaryEmailResponse($AccountInfo);

        $body = new ChangePrimaryEmailBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ChangePrimaryEmailBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:ChangePrimaryEmailRequest>'
                    . '<account by="' . AccountBy::NAME() . '">' . $name . '</account>'
                    . '<newName>' . $newName . '</newName>'
                . '</urn:ChangePrimaryEmailRequest>'
                . '<urn:ChangePrimaryEmailResponse>'
                    . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</account>'
                . '</urn:ChangePrimaryEmailResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, ChangePrimaryEmailBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, ChangePrimaryEmailBody::class, 'json'));
    }
}
