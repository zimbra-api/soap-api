<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SyncGalAccountBody;
use Zimbra\Admin\Message\SyncGalAccountEnvelope;
use Zimbra\Admin\Message\SyncGalAccountRequest;
use Zimbra\Admin\Message\SyncGalAccountResponse;
use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Common\Enum\DataSourceBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SyncGalAccount.
 */
class SyncGalAccountTest extends ZimbraTestCase
{
    public function testSyncGalAccount()
    {
        $id = $this->faker->uuid;
        $value = $this->faker->word;

        $account = new SyncGalAccountSpec($id, [new SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value, TRUE, TRUE)]);

        $request = new SyncGalAccountRequest([$account]);
        $this->assertSame([$account], $request->getAccounts());

        $request = new SyncGalAccountRequest();
        $request->setAccounts([$account])
            ->addAccount($account);
        $this->assertSame([$account, $account], $request->getAccounts());
        $request->setAccounts([$account]);

        $response = new SyncGalAccountResponse();

        $body = new SyncGalAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new SyncGalAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SyncGalAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new SyncGalAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SyncGalAccountRequest>
            <account id="$id">
                <datasource by="name" fullSync="true" reset="true">$value</datasource>
            </account>
        </urn:SyncGalAccountRequest>
        <urn:SyncGalAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SyncGalAccountEnvelope::class, 'xml'));
    }
}
