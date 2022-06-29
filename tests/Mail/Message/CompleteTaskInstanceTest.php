<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\CompleteTaskInstanceEnvelope;
use Zimbra\Mail\Message\CompleteTaskInstanceBody;
use Zimbra\Mail\Message\CompleteTaskInstanceRequest;
use Zimbra\Mail\Message\CompleteTaskInstanceResponse;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CompleteTaskInstance.
 */
class CompleteTaskInstanceTest extends ZimbraTestCase
{
    public function testCompleteTaskInstance()
    {
        $id = $this->faker->word;
        $dateTime = $this->faker->date;
        $tz = $this->faker->timezone;
        $utcTime = $this->faker->unixTime;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;

        $exceptionId = new DtTimeInfo($dateTime, $tz, $utcTime);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);

        $request = new CompleteTaskInstanceRequest(
            $id, $exceptionId, $timezone
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($exceptionId, $request->getExceptionId());
        $this->assertSame($timezone, $request->getTimezone());

        $request = new CompleteTaskInstanceRequest('', new DtTimeInfo());
        $request->setId($id)
            ->setExceptionId($exceptionId)
            ->setTimezone($timezone);
        $this->assertSame($id, $request->getId());
        $this->assertSame($exceptionId, $request->getExceptionId());
        $this->assertSame($timezone, $request->getTimezone());

        $response = new CompleteTaskInstanceResponse();

        $body = new CompleteTaskInstanceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CompleteTaskInstanceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CompleteTaskInstanceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CompleteTaskInstanceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CompleteTaskInstanceRequest id="$id">
            <urn:exceptId d="$dateTime" tz="$tz" u="$utcTime" />
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
        </urn:CompleteTaskInstanceRequest>
        <urn:CompleteTaskInstanceResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CompleteTaskInstanceEnvelope::class, 'xml'));
    }
}
