<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\AdminWaitSetRequest;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\Id;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminWaitSetRequest.
 */
class AdminWaitSetRequestTest extends ZimbraStructTestCase
{
    public function testAdminWaitSetRequest()
    {
        $waitSetId = $this->faker->uuid;
        $lastKnownSeqNo = $this->faker->word;
        $defaultInterests = $this->faker->word;
        $timeout = mt_rand();
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $add = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $update = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $remove = new Id($id);

        $req = new AdminWaitSetRequest(
            $waitSetId, $lastKnownSeqNo, FALSE, FALSE, $defaultInterests, $timeout, [$add], [$update], [$remove]
        );
        $this->assertSame($waitSetId, $req->getWaitSetId());
        $this->assertSame($lastKnownSeqNo, $req->getLastKnownSeqNo());
        $this->assertFalse($req->getBlock());
        $this->assertFalse($req->getExpand());
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());
        $this->assertSame([$add], $req->getAddAccounts());
        $this->assertSame([$update], $req->getUpdateAccounts());
        $this->assertSame([$remove], $req->getRemoveAccounts());

        $req = new AdminWaitSetRequest('', '');
        $req->setWaitSetId($waitSetId)
            ->setLastKnownSeqNo($lastKnownSeqNo)
            ->setBlock(TRUE)
            ->setExpand(TRUE)
            ->setDefaultInterests($defaultInterests)
            ->setTimeout($timeout)
            ->setAddAccounts([$add])
            ->addAddAccount($add)
            ->setUpdateAccounts([$update])
            ->addUpdateAccount($update)
            ->setRemoveAccounts([$remove])
            ->addRemoveAccount($remove);
        $this->assertSame($waitSetId, $req->getWaitSetId());
        $this->assertSame($lastKnownSeqNo, $req->getLastKnownSeqNo());
        $this->assertTrue($req->getBlock());
        $this->assertTrue($req->getExpand());
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());
        $this->assertSame([$add, $add], $req->getAddAccounts());
        $this->assertSame([$update, $update], $req->getUpdateAccounts());
        $this->assertSame([$remove, $remove], $req->getRemoveAccounts());

        $req = new AdminWaitSetRequest(
            $waitSetId, $lastKnownSeqNo, TRUE, TRUE, $defaultInterests, $timeout, [$add], [$update], [$remove]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminWaitSetRequest waitSet="' . $waitSetId . '" seq="' . $lastKnownSeqNo . '" block="true" expand="true" defTypes="' . $defaultInterests . '" timeout="' . $timeout . '">'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                . '</add>'
                . '<update>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                . '</update>'
                . '<remove>'
                    .'<a id="' . $id . '" />'
                . '</remove>'
            . '</AdminWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AdminWaitSetRequest::class, 'xml'));

        $json = json_encode([
            'waitSet' => $waitSetId,
            'seq' => $lastKnownSeqNo,
            'block' => TRUE,
            'expand' => TRUE,
            'defTypes' => $defaultInterests,
            'timeout' => $timeout,
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
            'update' => [
                'a' => [
                    [
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ],
                ]
            ],
            'remove' => [
                'a' => [
                    [
                        'id' => $id,
                    ],
                ]
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AdminWaitSetRequest::class, 'json'));
    }
}
