<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\InterestType;
use Zimbra\Common\Struct\IdAndType;
use Zimbra\Common\Struct\WaitSetAddSpec;

use Zimbra\Mail\Message\CreateWaitSetEnvelope;
use Zimbra\Mail\Message\CreateWaitSetBody;
use Zimbra\Mail\Message\CreateWaitSetRequest;
use Zimbra\Mail\Message\CreateWaitSetResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateWaitSet.
 */
class CreateWaitSetTest extends ZimbraTestCase
{
    public function testCreateWaitSet()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $type = $this->faker->word;
        $token = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $interests = implode(',', [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
            InterestType::CONTACTS()->getValue(),
        ]);

        $waitSet = new WaitSetAddSpec($name, $id, $token, $interests);
        $error = new IdAndType($id, $type);

        $request = new CreateWaitSetRequest($interests, FALSE, [$waitSet]);
        $this->assertSame($interests, $request->getDefaultInterests());
        $this->assertFalse($request->getAllAccounts());
        $this->assertSame([$waitSet], $request->getAccounts());
        $request = new CreateWaitSetRequest('');
        $request->setAccounts([$waitSet])
            ->addAccount($waitSet)
            ->setDefaultInterests($interests)
            ->setAllAccounts(TRUE);
        $this->assertSame([$waitSet, $waitSet], $request->getAccounts());
        $this->assertSame($interests, $request->getDefaultInterests());
        $this->assertTrue($request->getAllAccounts());
        $request->setAccounts([$waitSet]);

        $response = new CreateWaitSetResponse($id, $interests, $sequence, [$error]);
        $this->assertSame($id, $response->getWaitSetId());
        $this->assertSame($interests, $response->getDefaultInterests());
        $this->assertSame($sequence, $response->getSequence());
        $this->assertSame([$error], $response->getErrors());
        $response = new CreateWaitSetResponse();
        $response->setWaitSetId($id)
            ->setDefaultInterests($interests)
            ->setSequence($sequence)
            ->setErrors([$error])
            ->addError($error);
        $this->assertSame($id, $response->getWaitSetId());
        $this->assertSame($interests, $response->getDefaultInterests());
        $this->assertSame($sequence, $response->getSequence());
        $this->assertSame([$error, $error], $response->getErrors());
        $response->setErrors([$error]);

        $body = new CreateWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateWaitSetBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateWaitSetEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateWaitSetRequest defTypes="$interests" allAccounts="true">
            <urn:add>
                <urn:a name="$name" id="$id" token="$token" types="$interests" />
            </urn:add>
        </urn:CreateWaitSetRequest>
        <urn:CreateWaitSetResponse waitSet="$id" defTypes="$interests" seq="$sequence">
            <urn:error id="$id" type="$type" />
        </urn:CreateWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateWaitSetEnvelope::class, 'xml'));
    }
}
