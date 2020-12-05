<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeleteGalSyncAccountBody;
use Zimbra\Admin\Message\DeleteGalSyncAccountEnvelope;
use Zimbra\Admin\Message\DeleteGalSyncAccountRequest;
use Zimbra\Admin\Message\DeleteGalSyncAccountResponse;
use Zimbra\Struct\AccountSelector;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeleteGalSyncAccount.
 */
class DeleteGalSyncAccountTest extends ZimbraStructTestCase
{
    public function testDeleteGalSyncAccount()
    {
        $value = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $value);

        $request = new DeleteGalSyncAccountRequest($account);
        $this->assertSame($account, $request->getAccount());
        $request = new DeleteGalSyncAccountRequest(
            new AccountSelector(AccountBy::NAME(), '')
        );
        $request->setAccount($account);
        $this->assertSame($account, $request->getAccount());

        $response = new DeleteGalSyncAccountResponse();

        $body = new DeleteGalSyncAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteGalSyncAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteGalSyncAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteGalSyncAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteGalSyncAccountRequest>
            <account by="name">$value</account>
        </urn:DeleteGalSyncAccountRequest>
        <urn:DeleteGalSyncAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteGalSyncAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteGalSyncAccountRequest' => [
                    'account' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteGalSyncAccountResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteGalSyncAccountEnvelope::class, 'json'));
    }
}
