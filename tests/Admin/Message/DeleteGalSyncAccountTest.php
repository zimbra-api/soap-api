<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteGalSyncAccountBody;
use Zimbra\Admin\Message\DeleteGalSyncAccountEnvelope;
use Zimbra\Admin\Message\DeleteGalSyncAccountRequest;
use Zimbra\Admin\Message\DeleteGalSyncAccountResponse;
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Common\Enum\AccountBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteGalSyncAccount.
 */
class DeleteGalSyncAccountTest extends ZimbraTestCase
{
    public function testDeleteGalSyncAccount()
    {
        $value = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME, $value);

        $request = new DeleteGalSyncAccountRequest($account);
        $this->assertSame($account, $request->getAccount());
        $request = new DeleteGalSyncAccountRequest(
            new AccountSelector(AccountBy::NAME, '')
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
            <urn:account by="name">$value</urn:account>
        </urn:DeleteGalSyncAccountRequest>
        <urn:DeleteGalSyncAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteGalSyncAccountEnvelope::class, 'xml'));
    }
}
