<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountLoggerRequest;
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\AccountBy;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountLoggerRequest.
 */
class AddAccountLoggerRequestTest extends ZimbraStructTestCase
{
    public function testAddAccountLoggerRequest()
    {
        $id = $this->faker->uuid;
        $category = $this->faker->word;
        $value = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::INFO());
        $account = new AccountSelector(AccountBy::NAME(), $value);

        $req = new AddAccountLoggerRequest($logger, $account, $id);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($id, $req->getId());

        $req = new AddAccountLoggerRequest(new LoggerInfo($category, LoggingLevel::ERROR()));
        $req->setLogger($logger)
            ->setAccount($account)
            ->setId($id);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerRequest>'
                . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<id>' . $id . '</id>'
            . '</AddAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddAccountLoggerRequest::class, 'xml'));

        $json = json_encode([
            'logger' => [
                'category' => $category,
                'level' => (string) LoggingLevel::INFO(),
            ],
            'account' => [
                'by' => (string) AccountBy::NAME(),
                '_content' => $value,
            ],
            'id' => [
                '_content' => $id,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddAccountLoggerRequest::class, 'json'));
    }
}
