<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteDataSourceBody;
use Zimbra\Admin\Message\DeleteDataSourceEnvelope;
use Zimbra\Admin\Message\DeleteDataSourceRequest;
use Zimbra\Admin\Message\DeleteDataSourceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteDataSource.
 */
class DeleteDataSourceTest extends ZimbraTestCase
{
    public function testDeleteDataSource()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $dataSource = new Id($id);
        $attr = new Attr($key, $value);

        $request = new DeleteDataSourceRequest(
            $dataSource, $id, [$attr]
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($dataSource, $request->getDataSource());
        $request = new DeleteDataSourceRequest(
            new Id(), $id, [$attr]
        );
        $request->setId($id)
            ->setDataSource($dataSource);
        $this->assertSame($id, $request->getId());
        $this->assertSame($dataSource, $request->getDataSource());

        $response = new DeleteDataSourceResponse();

        $body = new DeleteDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteDataSourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteDataSourceRequest id="$id">
            <urn:dataSource id="$id" />
            <urn:a n="$key">$value</urn:a>
        </urn:DeleteDataSourceRequest>
        <urn:DeleteDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteDataSourceEnvelope::class, 'xml'));
    }
}
