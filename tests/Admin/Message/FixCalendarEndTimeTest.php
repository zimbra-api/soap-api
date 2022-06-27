<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\FixCalendarEndTimeBody;
use Zimbra\Admin\Message\FixCalendarEndTimeEnvelope;
use Zimbra\Admin\Message\FixCalendarEndTimeRequest;
use Zimbra\Admin\Message\FixCalendarEndTimeResponse;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FixCalendarEndTime.
 */
class FixCalendarEndTimeTest extends ZimbraTestCase
{
    public function testFixCalendarEndTime()
    {
        $name = $this->faker->word;
        $account = new NamedElement($name);

        $request = new FixCalendarEndTimeRequest(FALSE, [$account]);
        $this->assertFalse($request->getSync());
        $this->assertSame([$account], $request->getAccounts());
        $request = new FixCalendarEndTimeRequest();
        $request->setSync(TRUE)
            ->setAccounts([$account])
            ->addAccount($account);
        $this->assertTrue($request->getSync());
        $this->assertSame([$account, $account], $request->getAccounts());
        $request = new FixCalendarEndTimeRequest(TRUE, [$account]);

        $response = new FixCalendarEndTimeResponse();

        $body = new FixCalendarEndTimeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new FixCalendarEndTimeBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new FixCalendarEndTimeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FixCalendarEndTimeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:FixCalendarEndTimeRequest sync="true">
            <urn:account name="$name" />
        </urn:FixCalendarEndTimeRequest>
        <urn:FixCalendarEndTimeResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FixCalendarEndTimeEnvelope::class, 'xml'));
    }
}
