<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Request;

use Zimbra\Admin\Message\CheckDirectoryBody;
use Zimbra\Admin\Message\CheckDirectoryEnvelope;
use Zimbra\Admin\Message\CheckDirectoryRequest;
use Zimbra\Admin\Message\CheckDirectoryResponse;
use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckDirectory.
 */
class CheckDirectoryTest extends ZimbraTestCase
{
    public function testCheckDirectory()
    {
        $path = $this->faker->word;

        $dir = new CheckDirSelector($path, TRUE);
        $request = new CheckDirectoryRequest([$dir]);
        $this->assertSame([$dir], $request->getPaths());
        $request = new CheckDirectoryRequest();
        $request->setPaths([$dir])
            ->addPath($dir);
        $this->assertSame([$dir, $dir], $request->getPaths());
        $request->setPaths([$dir]);

        $dirInfo = new DirPathInfo($path, TRUE, TRUE, TRUE, TRUE);
        $response = new CheckDirectoryResponse(
            [$dirInfo]
        );
        $this->assertSame([$dirInfo], $response->getPaths());
        $response = new CheckDirectoryResponse();
        $response->setPaths([$dirInfo])
            ->addPath($dirInfo);
        $this->assertSame([$dirInfo, $dirInfo], $response->getPaths());
        $response->setPaths([$dirInfo]);

        $body = new CheckDirectoryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckDirectoryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckDirectoryEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckDirectoryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckDirectoryRequest>
            <urn:directory path="$path" create="true" />
        </urn:CheckDirectoryRequest>
        <urn:CheckDirectoryResponse>
            <urn:directory path="$path" exists="true" isDirectory="true" readable="true" writable="true" />
        </urn:CheckDirectoryResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckDirectoryEnvelope::class, 'xml'));
    }
}
