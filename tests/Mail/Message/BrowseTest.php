<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Enum\BrowseBy;

use Zimbra\Mail\Message\BrowseEnvelope;
use Zimbra\Mail\Message\BrowseBody;
use Zimbra\Mail\Message\BrowseRequest;
use Zimbra\Mail\Message\BrowseResponse;
use Zimbra\Mail\Struct\BrowseData;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Browse.
 */
class BrowseTest extends ZimbraTestCase
{
    public function testBrowse()
    {
        $browseBy = BrowseBy::DOMAINS();
        $regex = $this->faker->word;
        $max = $this->faker->randomNumber;
        $browseDomainHeader = $this->faker->word;
        $frequency = $this->faker->randomNumber;
        $data = $this->faker->text;

        $request = new BrowseRequest($browseBy, $regex, $max);
        $this->assertSame($browseBy, $request->getBrowseBy());
        $this->assertSame($regex, $request->getRegex());
        $this->assertSame($max, $request->getMax());
        $request = new BrowseRequest(BrowseBy::OBJECTS());
        $request->setBrowseBy($browseBy)
            ->setRegex($regex)
            ->setMax($max);
        $this->assertSame($browseBy, $request->getBrowseBy());
        $this->assertSame($regex, $request->getRegex());
        $this->assertSame($max, $request->getMax());

        $browseData = new BrowseData($browseDomainHeader, $frequency, $data);
        $response = new BrowseResponse([$browseData]);
        $this->assertSame([$browseData], $response->getBrowseDatas());
        $response = new BrowseResponse();
        $response->setBrowseDatas([$browseData])
            ->addBrowseData($browseData);
        $this->assertSame([$browseData, $browseData], $response->getBrowseDatas());
        $response->setBrowseDatas([$browseData]);

        $body = new BrowseBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new BrowseBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new BrowseEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new BrowseEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:BrowseRequest browseBy="domains" regex="$regex" maxToReturn="$max" />
        <urn:BrowseResponse>
            <bd h="$browseDomainHeader" freq="$frequency">$data</bd>
        </urn:BrowseResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, BrowseEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'BrowseRequest' => [
                    'browseBy' => 'domains',
                    'regex' => $regex,
                    'maxToReturn' => $max,
                    '_jsns' => 'urn:zimbraMail',
                ],
                'BrowseResponse' => [
                    'bd' => [
                        [
                            'h' => $browseDomainHeader,
                            'freq' => $frequency,
                            '_content' => $data,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, BrowseEnvelope::class, 'json'));
    }
}
