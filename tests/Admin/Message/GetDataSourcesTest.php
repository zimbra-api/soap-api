<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetDataSourcesBody;
use Zimbra\Admin\Message\GetDataSourcesEnvelope;
use Zimbra\Admin\Message\GetDataSourcesRequest;
use Zimbra\Admin\Message\GetDataSourcesResponse;
use Zimbra\Admin\Struct\{Attr, DataSourceInfo};
use Zimbra\Common\Enum\DataSourceType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDataSourcesTest.
 */
class GetDataSourcesTest extends ZimbraTestCase
{
    public function testGetDataSources()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $dataSource = new DataSourceInfo($name, $id, DataSourceType::POP3(), [$attr]);

        $request = new GetDataSourcesRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new GetDataSourcesRequest('', [$attr]);
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new GetDataSourcesResponse([$dataSource]);
        $this->assertSame([$dataSource], $response->getDataSources());
        $response = new GetDataSourcesResponse();
        $response->setDataSources([$dataSource])
            ->addDataSource($dataSource);
        $this->assertSame([$dataSource, $dataSource], $response->getDataSources());
        $response->setDataSources([$dataSource]);

        $body = new GetDataSourcesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDataSourcesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDataSourcesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDataSourcesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDataSourcesRequest id="$id">
            <a n="$key">$value</a>
        </urn:GetDataSourcesRequest>
        <urn:GetDataSourcesResponse>
            <dataSource name="$name" id="$id" type="pop3">
                <a n="$key">$value</a>
            </dataSource>
        </urn:GetDataSourcesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDataSourcesEnvelope::class, 'xml'));
    }
}
