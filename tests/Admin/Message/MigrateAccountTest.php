<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\MigrateAccountBody;
use Zimbra\Admin\Message\MigrateAccountEnvelope;
use Zimbra\Admin\Message\MigrateAccountRequest;
use Zimbra\Admin\Message\MigrateAccountResponse;

use Zimbra\Admin\Struct\IdAndAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MigrateAccount.
 */
class MigrateAccountTest extends ZimbraTestCase
{
    public function testMigrateAccount()
    {
        $id = $this->faker->uuid;
        $action = $this->faker->randomElement(['bug72174', 'wiki', 'contactGroup']);
        $migrate = new IdAndAction($id, $action);

        $request = new MigrateAccountRequest($migrate);
        $this->assertSame($migrate, $request->getMigrate());
        $request = new MigrateAccountRequest(
            new IdAndAction()
        );
        $request->setMigrate($migrate);
        $this->assertSame($migrate, $request->getMigrate());

        $response = new MigrateAccountResponse();

        $body = new MigrateAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new MigrateAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new MigrateAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new MigrateAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:MigrateAccountRequest>
            <urn:migrate id="$id" action="$action" />
        </urn:MigrateAccountRequest>
        <urn:MigrateAccountResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, MigrateAccountEnvelope::class, 'xml'));
    }
}
