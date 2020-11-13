<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\AdminCreateWaitSetRequest;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminCreateWaitSetRequest.
 */
class AdminCreateWaitSetRequestTest extends ZimbraStructTestCase
{
    public function testAdminCreateWaitSetRequest()
    {
        $defaultInterests = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $a = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));

        $req = new AdminCreateWaitSetRequest(
            $defaultInterests, FALSE, [$a]
        );
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertFalse($req->getAllAccounts());
        $this->assertSame([$a], $req->getAccounts());

        $req = new AdminCreateWaitSetRequest('');
        $req->setDefaultInterests($defaultInterests)
            ->setAllAccounts(TRUE)
            ->setAccounts([$a])
            ->addAccount($a);
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertTrue($req->getAllAccounts());
        $this->assertSame([$a, $a], $req->getAccounts());

        $req = new AdminCreateWaitSetRequest(
            $defaultInterests, TRUE, [$a]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminCreateWaitSetRequest defTypes="' . $defaultInterests . '" allAccounts="true">'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                . '</add>'
            . '</AdminCreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AdminCreateWaitSetRequest::class, 'xml'));

        $json = json_encode([
            'defTypes' => $defaultInterests,
            'allAccounts' => TRUE,
            'add' => [
                'a' => [
                    [
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ],
                ]
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AdminCreateWaitSetRequest::class, 'json'));
    }
}
