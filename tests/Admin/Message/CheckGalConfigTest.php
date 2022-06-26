<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckGalConfigBody;
use Zimbra\Admin\Message\CheckGalConfigEnvelope;
use Zimbra\Admin\Message\CheckGalConfigRequest;
use Zimbra\Admin\Message\CheckGalConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Admin\Struct\LimitedQuery;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckGalConfig.
 */
class CheckGalConfigTest extends ZimbraTestCase
{
    public function testCheckGalConfig()
    {
        $limit = mt_rand(0, 10);
        $id = $this->faker->uuid;
        $action = $this->faker->word;
        $key = $this->faker->word;
        $value= $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $query = new LimitedQuery($limit, $value);
        $request = new CheckGalConfigRequest($query, $action, [new Attr($key, $value)]);
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($action, $request->getAction());

        $request = new CheckGalConfigRequest(new LimitedQuery(0, ''), '', [new Attr($key, $value)]);
        $request->setQuery($query)
            ->setAction($action);
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($action, $request->getAction());

        $cn = new GalContactInfo($id, [new Attr($key, $value)]);
        $response = new CheckGalConfigResponse(
            $code,
            $message,
            [$cn]
        );
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
        $this->assertSame([$cn], $response->getGalContacts());

        $response = new CheckGalConfigResponse('', '');
        $response->setCode($code)
            ->setMessage($message)
            ->setGalContacts([$cn])
            ->addGalContact($cn);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
        $this->assertSame([$cn, $cn], $response->getGalContacts());
        $response->setGalContacts([$cn]);

        $body = new CheckGalConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckGalConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckGalConfigEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckGalConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckGalConfigRequest>
            <urn:query limit="$limit">$value</urn:query>
            <urn:action>$action</urn:action>
            <urn:a n="$key">$value</urn:a>
        </urn:CheckGalConfigRequest>
        <urn:CheckGalConfigResponse>
            <urn:code>$code</urn:code>
            <urn:message>$message</urn:message>
            <urn:cn id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:cn>
        </urn:CheckGalConfigResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckGalConfigEnvelope::class, 'xml'));
    }
}
