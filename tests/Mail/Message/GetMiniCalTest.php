<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\Id;

use Zimbra\Mail\Message\GetMiniCalEnvelope;
use Zimbra\Mail\Message\GetMiniCalBody;
use Zimbra\Mail\Message\GetMiniCalRequest;
use Zimbra\Mail\Message\GetMiniCalResponse;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\MiniCalError;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetMiniCal.
 */
class GetMiniCalTest extends ZimbraTestCase
{
    public function testGetMiniCal()
    {
        $id = $this->faker->uuid;
        $startTime = $this->faker->unixTime;
        $endTime = $this->faker->unixTime;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $code = $this->faker->word;
        $errorMessage = $this->faker->word;
        $date1 = $this->faker->date('Y/m/d');
        $date2 = $this->faker->date('Y/m/d');

        $folder = new Id($id);
        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $request = new GetMiniCalRequest($startTime, $endTime, [$folder], $timezone);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame([$folder], $request->getFolders());
        $this->assertSame($timezone, $request->getTimezone());
        $request = new GetMiniCalRequest();
        $request->setStartTime($startTime)
            ->setEndTime($endTime)
            ->setFolders([$folder])
            ->addFolder($folder)
            ->setTimezone($timezone);
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $this->assertSame([$folder, $folder], $request->getFolders());
        $this->assertSame($timezone, $request->getTimezone());
        $request->setFolders([$folder]);

        $error = new MiniCalError(
            $id, $code, $errorMessage
        );
        $response = new GetMiniCalResponse([$date1, $date2], [$error]);
        $this->assertSame([$date1, $date2], $response->getBusyDates());
        $this->assertSame([$error], $response->getErrors());
        $response = new GetMiniCalResponse();
        $response->setBusyDates([$date1, $date2])
            ->setErrors([$error]);
        $this->assertSame([$date1, $date2], $response->getBusyDates());
        $this->assertSame([$error], $response->getErrors());

        $body = new GetMiniCalBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetMiniCalBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetMiniCalEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetMiniCalEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetMiniCalRequest s="$startTime" e="$endTime">
            <urn:folder id="$id" />
            <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
        </urn:GetMiniCalRequest>
        <urn:GetMiniCalResponse>
            <urn:date>$date1</urn:date>
            <urn:date>$date2</urn:date>
            <urn:error id="$id" code="$code">$errorMessage</urn:error>
        </urn:GetMiniCalResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetMiniCalEnvelope::class, 'xml'));
    }
}
