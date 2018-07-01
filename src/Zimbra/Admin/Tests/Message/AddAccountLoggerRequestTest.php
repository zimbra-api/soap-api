<?php

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
        $category = $this->faker->word;
        $value = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::INFO()->value());
        $account = new AccountSelector(AccountBy::NAME()->value(), $value);

        $req = new AddAccountLoggerRequest($logger, $account);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());

        $req = new AddAccountLoggerRequest(new LoggerInfo($category, LoggingLevel::ERROR()->value()));
        $req->setLogger($logger)
            ->setAccount($account);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerRequest>'
                . '<logger category="' . $category . '" level="' . LoggingLevel::INFO() . '" />'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</AddAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));

        $req = $this->serializer->deserialize($xml, 'Zimbra\Admin\Message\AddAccountLoggerRequest', 'xml');
        $logger = $req->getLogger();
        $account = $req->getAccount();

        $this->assertSame($category, $logger->getCategory());
        $this->assertSame(LoggingLevel::INFO()->value(), $logger->getLevel());
        $this->assertSame(AccountBy::NAME()->value(), $account->getBy());
        $this->assertSame($value, $account->getValue());
    }
}
