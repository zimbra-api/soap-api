<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetRightsDocBody;
use Zimbra\Admin\Message\GetRightsDocEnvelope;
use Zimbra\Admin\Message\GetRightsDocRequest;
use Zimbra\Admin\Message\GetRightsDocResponse;

use Zimbra\Admin\Struct\CmdRightsInfo;
use Zimbra\Admin\Struct\DomainAdminRight;
use Zimbra\Admin\Struct\PackageRightsInfo;
use Zimbra\Admin\Struct\PackageSelector;
use Zimbra\Admin\Struct\RightWithName;

use Zimbra\Common\Enum\RightType;

use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetRightsDocTest.
 */
class GetRightsDocTest extends ZimbraTestCase
{
    public function testGetRightsDoc()
    {
        $name = $this->faker->word;
        $desc = $this->faker->word;
        $note = $this->faker->word;
        $notUsed = $this->faker->word;

        $pkg = new PackageSelector($name);
        $request = new GetRightsDocRequest([$pkg]);
        $this->assertSame([$pkg], $request->getPkgs());
        $request = new GetRightsDocRequest();
        $request->setPkgs([$pkg])
            ->addPkg($pkg);
        $this->assertSame([$pkg, $pkg], $request->getPkgs());
        $request->setPkgs([$pkg]);

        $package = new PackageRightsInfo($name, [new CmdRightsInfo($name, [new NamedElement($name)], [$note])]);
        $right = new DomainAdminRight($name, RightType::PRESET(), $desc, [new RightWithName($name)]);
        $response = new GetRightsDocResponse([$package], [$notUsed], [$right]);
        $this->assertSame([$package], $response->getPackages());
        $this->assertSame([$notUsed], $response->getNotUsed());
        $this->assertSame([$right], $response->getRights());
        $response = new GetRightsDocResponse();
        $response->setPackages([$package])
            ->addPackage($package)
            ->setNotUsed([$notUsed])
            ->setRights([$right])
            ->addRight($right);
        $this->assertSame([$package, $package], $response->getPackages());
        $this->assertSame([$notUsed], $response->getNotUsed());
        $this->assertSame([$right, $right], $response->getRights());
        $response->setPackages([$package])
            ->setRights([$right]);

        $body = new GetRightsDocBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetRightsDocBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetRightsDocEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetRightsDocEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetRightsDocRequest>
            <package name="$name" />
        </urn:GetRightsDocRequest>
        <urn:GetRightsDocResponse>
            <package name="$name">
                <cmd name="$name">
                    <rights>
                        <right name="$name" />
                    </rights>
                    <desc>
                        <note>$note</note>
                    </desc>
                </cmd>
            </package>
            <notUsed>$notUsed</notUsed>
            <domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template>
                <right name="$name" type="preset">
                    <desc>$desc</desc>
                    <rights>
                        <r n="$name" />
                    </rights>
                </right>
            </domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template>
        </urn:GetRightsDocResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetRightsDocEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetRightsDocRequest' => [
                    'package' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetRightsDocResponse' => [
                    'package' => [
                        [
                            'name' => $name,
                            'cmd' => [
                                [
                                    'name' => $name,
                                    'rights' => [
                                        'right' => [
                                            [
                                                'name' => $name,
                                            ],
                                        ],
                                    ],
                                    'desc' => [
                                        'note' => [
                                            [
                                                '_content' => $note,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'notUsed' => [
                        [
                            '_content' => $notUsed,
                        ],
                    ],
                    'domainAdmin-copypaste-to-zimbra-rights-domainadmin-xml-template' => [
                        'right' => [
                            [
                                'name' => $name,
                                'type' => 'preset',
                                'desc' => [
                                    '_content' => $desc,
                                ],
                                'rights' => [
                                    'r' => [
                                        [
                                            'n' => $name,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetRightsDocEnvelope::class, 'json'));
    }
}
