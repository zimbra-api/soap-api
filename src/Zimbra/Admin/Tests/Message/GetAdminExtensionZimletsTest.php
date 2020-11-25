<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

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
use Zimbra\Enum\ZimletPresence;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAdminExtensionZimlets.
 */
class GetAdminExtensionZimletsTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAdminExtensionZimletsRequest />'
                    . '<urn:GetAdminExtensionZimletsResponse>'
                        . '<zimlets>'
                            . '<zimlet>'
                                . '<zimletContext baseUrl="' . $baseUrl . '" priority="' . $priority . '" presence="' . ZimletPresence::ENABLED() . '" />'
                                . '<zimlet name="' . $name . '" version="' . $version . '" description="' . $description . '" extension="' . $extension . '" target="' . $target . '" label="' . $label . '">'
                                    . '<serverExtension hasKeyword="' . $hasKeyword . '" extensionClass="' . $extensionClass . '" regex="' . $regex . '" />'
                                    . '<include>' . $value . '</include>'
                                    . '<includeCSS>' . $value . '</includeCSS>'
                                . '</zimlet>'
                                . '<zimletConfig name="' . $name . '" version="' . $version . '" description="' . $description . '" extension="' . $extension . '" target="' . $target . '" label="' . $label . '">'
                                    . '<global>'
                                        . '<property name="' . $name . '">' . $value. '</property>'
                                    . '</global>'
                                    . '<host name="' . $name . '">'
                                        . '<property name="' . $name . '">' . $value. '</property>'
                                    . '</host>'
                                . '</zimletConfig>'
                            . '</zimlet>'
                        . '</zimlets>'
                    . '</urn:GetAdminExtensionZimletsResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAdminExtensionZimletsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAdminExtensionZimletsRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAdminExtensionZimletsResponse' => [
                    'zimlets' => [
                        'zimlet' => [
                            [
                                'zimletContext' => [
                                    'baseUrl' => $baseUrl,
                                    'priority' => $priority,
                                    'presence' => (string) ZimletPresence::ENABLED(),
                                ],
                                'zimlet' => [
                                    'name' => $name,
                                    'version' => $version,
                                    'description' => $description,
                                    'extension' => $extension,
                                    'target' => $target,
                                    'label' => $label,
                                    'serverExtension' => [
                                        'hasKeyword' => $hasKeyword,
                                        'extensionClass' => $extensionClass,
                                        'regex' => $regex,
                                    ],
                                    'include' => [
                                        '_content' => $value,
                                    ],
                                    'includeCSS' => [
                                        '_content' => $value,
                                    ],
                                ],
                                'zimletConfig' => [
                                    'name' => $name,
                                    'version' => $version,
                                    'description' => $description,
                                    'extension' => $extension,
                                    'target' => $target,
                                    'label' => $label,
                                    'global' => [
                                        'property' => [
                                            [
                                                'name' => $name,
                                                '_content' => $value,
                                            ],
                                        ],
                                    ],
                                    'host' => [
                                        'name' => $name,
                                        'property' => [
                                            [
                                                'name' => $name,
                                                '_content' => $value,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAdminExtensionZimletsEnvelope::class, 'json'));
    }
}
