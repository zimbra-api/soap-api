<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyDataSourceBody;
use Zimbra\Admin\Message\ModifyDataSourceEnvelope;
use Zimbra\Admin\Message\ModifyDataSourceRequest;
use Zimbra\Admin\Message\ModifyDataSourceResponse;
use Zimbra\Admin\Struct\{Attr, DataSourceInfo};
use Zimbra\Common\Enum\DataSourceType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyDataSource.
 */
class ModifyDataSourceTest extends ZimbraTestCase
{
    public function testModifyDataSource()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $dataSource = new DataSourceInfo($name, $id, DataSourceType::POP3(), [new Attr($key, $value)]);

        $request = new ModifyDataSourceRequest($id, $dataSource);
        $this->assertSame($id, $request->getId());
        $this->assertEquals($dataSource, $request->getDataSource());
        $request = new ModifyDataSourceRequest('', new DataSourceInfo('', '', DataSourceType::POP3()));
        $request->setId($id)
            ->setDataSource($dataSource)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());
        $this->assertEquals($dataSource, $request->getDataSource());

        $response = new ModifyDataSourceResponse();

        $body = new ModifyDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyDataSourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDataSourceRequest id="$id">
            <dataSource name="$name" id="$id" type="pop3">
                <a n="$key">$value</a>
            </dataSource>
            <a n="$key">$value</a>
        </urn:ModifyDataSourceRequest>
        <urn:ModifyDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyDataSourceEnvelope::class, 'xml'));
    }
}
