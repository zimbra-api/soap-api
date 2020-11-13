<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\ChangePrimaryEmailRequest;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePrimaryEmailRequest.
 */
class ChangePrimaryEmailRequestTest extends ZimbraStructTestCase
{
    public function testChangePrimaryEmailRequest()
    {
        $name = $this->faker->word;
        $newName = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $name);
        $req = new ChangePrimaryEmailRequest(
            $account, $newName
        );

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($newName, $req->getNewName());

        $req = new ChangePrimaryEmailRequest(
            new AccountSelector(AccountBy::NAME(), $name), ''
        );
        $req->setAccount($account)
            ->setNewName($newName);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ChangePrimaryEmailRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $name . '</account>'
                . '<newName>' . $newName . '</newName>'
            . '</ChangePrimaryEmailRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, ChangePrimaryEmailRequest::class, 'xml'));

        $json = json_encode([
            'account' => [
                'by' => (string) AccountBy::NAME(),
                '_content' => $name,
            ],
            'newName' => [
                '_content' => $newName,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, ChangePrimaryEmailRequest::class, 'json'));
    }
}
