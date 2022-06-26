<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAdminExtensionZimletsBody;
use Zimbra\Admin\Message\GetAdminExtensionZimletsEnvelope;
use Zimbra\Admin\Message\GetAdminExtensionZimletsRequest;
use Zimbra\Admin\Message\GetAdminExtensionZimletsResponse;
use Zimbra\Admin\Struct\AdminZimletInfo;
use Zimbra\Admin\Struct\AdminZimletContext;
use Zimbra\Admin\Struct\AdminZimletDesc;
use Zimbra\Admin\Struct\AdminZimletInclude;
use Zimbra\Admin\Struct\AdminZimletIncludeCSS;
use Zimbra\Admin\Struct\ZimletServerExtension;
use Zimbra\Admin\Struct\AdminZimletConfigInfo;
use Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo;
use Zimbra\Admin\Struct\AdminZimletHostConfigInfo;
use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Common\Enum\ZimletPresence;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAdminExtensionZimlets.
 */
class GetAdminExtensionZimletsTest extends ZimbraTestCase
{
    public function testGetAdminExtensionZimlets()
    {
        $baseUrl = $this->faker->word;
        $priority = mt_rand(1, 10);
        $name = $this->faker->word;
        $version = $this->faker->word;
        $description = $this->faker->word;
        $extension = $this->faker->word;
        $target = $this->faker->word;
        $label = $this->faker->word;
        $value = $this->faker->word;
        $hasKeyword = $this->faker->word;
        $extensionClass = $this->faker->word;
        $regex = $this->faker->word;

        $zimletContext = new AdminZimletContext(
            $baseUrl, ZimletPresence::ENABLED(), $priority
        );

        $serverExtension = new ZimletServerExtension(
            $hasKeyword, $extensionClass, $regex
        );
        $include = new AdminZimletInclude($value);
        $includeCSS = new AdminZimletIncludeCSS($value);
        $zimletDesc = new AdminZimletDesc(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletDesc->setServerExtension($serverExtension)
            ->setZimletInclude($include)
            ->setZimletIncludeCSS($includeCSS);

        $property = new AdminZimletProperty($name, $value);
        $global = new AdminZimletGlobalConfigInfo([$property]);
        $host = new AdminZimletHostConfigInfo($name, [$property]);
        $zimletConfig = new AdminZimletConfigInfo(
            $name, $version, $description, $extension, $target, $label
        );
        $zimletConfig->setGlobal($global)
            ->setHost($host);

        $zimlet = new AdminZimletInfo(
            $zimletContext, $zimletDesc, $zimletConfig
        );

        $request = new GetAdminExtensionZimletsRequest();

        $response = new GetAdminExtensionZimletsResponse([$zimlet]);
        $this->assertSame([$zimlet], $response->getZimlets());
        $response = new GetAdminExtensionZimletsResponse();
        $response->setZimlets([$zimlet])
            ->addZimlet($zimlet);
        $this->assertSame([$zimlet, $zimlet], $response->getZimlets());
        $response->setZimlets([$zimlet]);

        $body = new GetAdminExtensionZimletsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAdminExtensionZimletsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAdminExtensionZimletsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAdminExtensionZimletsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAdminExtensionZimletsRequest />
        <urn:GetAdminExtensionZimletsResponse>
            <urn:zimlets>
                <urn:zimlet>
                    <urn:zimletContext baseUrl="$baseUrl" priority="$priority" presence="enabled" />
                    <urn:zimlet name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <urn:serverExtension hasKeyword="$hasKeyword" extensionClass="$extensionClass" regex="$regex" />
                        <urn:include>$value</urn:include>
                        <urn:includeCSS>$value</urn:includeCSS>
                    </urn:zimlet>
                    <urn:zimletConfig name="$name" version="$version" description="$description" extension="$extension" target="$target" label="$label">
                        <urn:global>
                            <urn:property name="$name">$value</urn:property>
                        </urn:global>
                        <urn:host name="$name">
                            <urn:property name="$name">$value</urn:property>
                        </urn:host>
                    </urn:zimletConfig>
                </urn:zimlet>
            </urn:zimlets>
        </urn:GetAdminExtensionZimletsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAdminExtensionZimletsEnvelope::class, 'xml'));
    }
}
