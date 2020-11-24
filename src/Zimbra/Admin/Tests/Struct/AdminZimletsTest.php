<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AdminZimlets;
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
 * Testcase class for AdminZimlets.
 */
class AdminZimletsTest extends ZimbraStructTestCase
{
    public function testAdminZimlets()
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

        $zimlets = new AdminZimlets([$zimlet]);
        $this->assertSame([$zimlet], $zimlets->getZimlets());
        $zimlets = new AdminZimlets();
        $zimlets->setZimlets([$zimlet])
            ->addZimlet($zimlet);
        $this->assertSame([$zimlet, $zimlet], $zimlets->getZimlets());
        $zimlets->setZimlets([$zimlet]);

        $xml = '<?xml version="1.0"?>' . "\n"
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
            . '</zimlets>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlets, 'xml'));
        $this->assertEquals($zimlets, $this->serializer->deserialize($xml, AdminZimlets::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlets, 'json'));
        $this->assertEquals($zimlets, $this->serializer->deserialize($json, AdminZimlets::class, 'json'));
    }
}
