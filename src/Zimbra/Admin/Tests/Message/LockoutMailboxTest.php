<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\LockoutMailboxBody;
use Zimbra\Admin\Message\LockoutMailboxEnvelope;
use Zimbra\Admin\Message\LockoutMailboxRequest;
use Zimbra\Admin\Message\LockoutMailboxResponse;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LockoutOperation;
use Zimbra\Struct\AccountNameSelector;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for LockoutMailbox.
 */
class LockoutMailboxTest extends ZimbraStructTestCase
{
    public function testLockoutMailbox()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $account = new AccountNameSelector(AccountBy::NAME(), $name, $value);
        $request = new LockoutMailboxRequest($account, LockoutOperation::START());
        $this->assertSame($account, $request->getAccount());
        $this->assertEquals(LockoutOperation::START(), $request->getOperation());
        $request = new LockoutMailboxRequest(
            new AccountNameSelector(AccountBy::NAME(), '', '')
        );
        $request->setAccount($account)
            ->setOperation(LockoutOperation::START());
        $this->assertSame($account, $request->getAccount());
        $this->assertEquals(LockoutOperation::START(), $request->getOperation());

        $response = new LockoutMailboxResponse();

        $body = new LockoutMailboxBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new LockoutMailboxBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new LockoutMailboxEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new LockoutMailboxEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:LockoutMailboxRequest op="start">
            <account by="name" name="$name">$value</account>
        </urn:LockoutMailboxRequest>
        <urn:LockoutMailboxResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, LockoutMailboxEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'LockoutMailboxRequest' => [
                    'op' => 'start',
                    'account' => [
                        'by' => 'name',
                        'name' => $name,
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'LockoutMailboxResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, LockoutMailboxEnvelope::class, 'json'));
    }
}
