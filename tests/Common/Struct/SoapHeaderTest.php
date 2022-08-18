<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Enum\{AccountBy, RequestFormat};
use Zimbra\Common\Struct\AuthTokenControl;
use Zimbra\Common\Struct\SoapHeader;
use Zimbra\Common\Struct\Header\{
    AccountInfo, Context, ChangeInfo, FormatInfo, NotifyInfo, SessionInfo, UserAgentInfo
};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SoapHeader.
 */
class SoapHeaderTest extends ZimbraTestCase
{
    public function testHeaderAccountInfo()
    {
        $value = $this->faker->word;
        $info = new AccountInfo(AccountBy::ID, $value, FALSE);
        $this->assertEquals(AccountBy::ID, $info->getBy());
        $this->assertFalse($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());

        $info = new AccountInfo();
        $info->setBy(AccountBy::NAME)
             ->setMountpointTraversed(TRUE)
             ->setValue($value);
        $this->assertEquals(AccountBy::NAME, $info->getBy());
        $this->assertTrue($info->getMountpointTraversed());
        $this->assertSame($value, $info->getValue());
    }

    public function testHeaderChangeInfo()
    {
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;

        $info = new ChangeInfo($changeId, $changeType);
        $this->assertSame($changeId, $info->getChangeId());
        $this->assertSame($changeType, $info->getChangeType());

        $info = new ChangeInfo();
        $info->setChangeId($changeId)
             ->setChangeType($changeType);
        $this->assertSame($changeId, $info->getChangeId());
        $this->assertSame($changeType, $info->getChangeType());
    }

    public function testHeaderFormatInfo()
    {
        $info = new FormatInfo(RequestFormat::JS);
        $this->assertEquals(RequestFormat::JS, $info->getFormat());
        $info->setFormat(RequestFormat::XML);
        $this->assertEquals(RequestFormat::XML, $info->getFormat());
    }

    public function testHeaderNotifyInfo()
    {
        $sequence = $this->faker->randomNumber;

        $info = new NotifyInfo($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());

        $info = new NotifyInfo();
        $info->setSequenceNum($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());
    }

    public function testHeaderSessionInfo()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $sequence = $this->faker->randomNumber;

        $info = new SessionInfo(FALSE, $id, $sequence, $value);
        $this->assertFalse($info->getSessionProxied());
        $this->assertSame($id, $info->getSessionId());
        $this->assertSame($sequence, $info->getSequenceNum());
        $this->assertSame($value, $info->getValue());

        $info = new SessionInfo();
        $info->setSessionProxied(TRUE)
             ->setSessionId($id)
             ->setSequenceNum($sequence)
             ->setValue($value);
        $this->assertTrue($info->getSessionProxied());
        $this->assertSame($id, $info->getSessionId());
        $this->assertSame($sequence, $info->getSequenceNum());
        $this->assertSame($value, $info->getValue());
    }

    public function testHeaderUserAgentInfo()
    {
        $name = $this->faker->word;
        $version = $this->faker->word;

        $info = new UserAgentInfo($name, $version);
        $this->assertSame($name, $info->getName());
        $this->assertSame($version, $info->getVersion());

        $info = new UserAgentInfo();
        $info->setName($name)
             ->setVersion($version);
        $this->assertSame($name, $info->getName());
        $this->assertSame($version, $info->getVersion());
    }

    public function testHeaderContext()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;
        $version = $this->faker->word;

        $hopCount = $this->faker->randomNumber;
        $authToken = $this->faker->uuid;
        $noSession = $this->faker->word;
        $targetServer = $this->faker->word;
        $noNotify = $this->faker->word;
        $noQualify = $this->faker->word;
        $via = $this->faker->word;
        $soapRequestId = $this->faker->word;
        $csrfToken = $this->faker->uuid;

        $session = new SessionInfo(TRUE, $id, $sequence, $value);
        $legacySessionId = new SessionInfo(FALSE, $id, $sequence, $value);
        $account = new AccountInfo(AccountBy::ID, $value, TRUE);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(TRUE);
        $format = new FormatInfo(RequestFormat::XML);
        $notify = new NotifyInfo($sequence);

        $context = new Context(
            $hopCount,
            $authToken,
            $session,
            $legacySessionId,
            $noSession,
            $account,
            $change,
            $targetServer,
            $userAgent,
            $authTokenControl,
            $format,
            $notify,
            $noNotify,
            $noQualify,
            $via,
            $soapRequestId,
            $csrfToken
        );
        $this->assertSame($hopCount, $context->getHopCount());
        $this->assertSame($authToken, $context->getAuthToken());
        $this->assertSame($session, $context->getSession());
        $this->assertSame($legacySessionId, $context->getLegacySessionId());
        $this->assertSame($noSession, $context->getNoSession());
        $this->assertSame($account, $context->getAccount());
        $this->assertSame($change, $context->getChange());
        $this->assertSame($targetServer, $context->getTargetServer());
        $this->assertSame($userAgent, $context->getUserAgent());
        $this->assertSame($authTokenControl, $context->getAuthTokenControl());
        $this->assertSame($format, $context->getFormat());
        $this->assertSame($notify, $context->getNotify());
        $this->assertSame($noNotify, $context->getNoNotify());
        $this->assertSame($noQualify, $context->getNoQualify());
        $this->assertSame($via, $context->getVia());
        $this->assertSame($soapRequestId, $context->getSoapRequestId());
        $this->assertSame($csrfToken, $context->getCsrfToken());

        $context = new Context();
        $context->setHopCount($hopCount)
            ->setAuthToken($authToken)
            ->setSession($session)
            ->setLegacySessionId($legacySessionId)
            ->setNoSession($noSession)
            ->setAccount($account)
            ->setChange($change)
            ->setTargetServer($targetServer)
            ->setUserAgent($userAgent)
            ->setAuthTokenControl($authTokenControl)
            ->setFormat($format)
            ->setNotify($notify)
            ->setNoNotify($noNotify)
            ->setNoQualify($noQualify)
            ->setVia($via)
            ->setSoapRequestId($soapRequestId)
            ->setCsrfToken($csrfToken);
        $this->assertSame($hopCount, $context->getHopCount());
        $this->assertSame($authToken, $context->getAuthToken());
        $this->assertSame($session, $context->getSession());
        $this->assertSame($legacySessionId, $context->getLegacySessionId());
        $this->assertSame($noSession, $context->getNoSession());
        $this->assertSame($account, $context->getAccount());
        $this->assertSame($change, $context->getChange());
        $this->assertSame($targetServer, $context->getTargetServer());
        $this->assertSame($userAgent, $context->getUserAgent());
        $this->assertSame($authTokenControl, $context->getAuthTokenControl());
        $this->assertSame($format, $context->getFormat());
        $this->assertSame($notify, $context->getNotify());
        $this->assertSame($noNotify, $context->getNoNotify());
        $this->assertSame($noQualify, $context->getNoQualify());
        $this->assertSame($via, $context->getVia());
        $this->assertSame($soapRequestId, $context->getSoapRequestId());
        $this->assertSame($csrfToken, $context->getCsrfToken());
    }

    public function testSoapHeader()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;
        $version = $this->faker->word;

        $hopCount = $this->faker->randomNumber;
        $authToken = $this->faker->uuid;
        $noSession = $this->faker->word;
        $targetServer = $this->faker->word;
        $noNotify = $this->faker->word;
        $noQualify = $this->faker->word;
        $via = $this->faker->word;
        $soapRequestId = $this->faker->word;
        $csrfToken = $this->faker->uuid;

        $session = new SessionInfo(TRUE, $id, $sequence, $value);
        $legacySessionId = new SessionInfo(FALSE, $id, $sequence, $value);
        $account = new AccountInfo(AccountBy::ID, $value, TRUE);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(TRUE);
        $format = new FormatInfo(RequestFormat::XML);
        $notify = new NotifyInfo($sequence);
        $context = new Context(
            $hopCount,
            $authToken,
            $session,
            $legacySessionId,
            $noSession,
            $account,
            $change,
            $targetServer,
            $userAgent,
            $authTokenControl,
            $format,
            $notify,
            $noNotify,
            $noQualify,
            $via,
            $soapRequestId,
            $csrfToken
        );

        $header = new SoapHeader($context);
        $this->assertSame($context, $header->getContext());
        $header = new SoapHeader();
        $header->setContext($context);
        $this->assertSame($context, $header->getContext());

        $byId = AccountBy::ID->value;
        $requestFormat = RequestFormat::XML->value;
        $xml = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<result xmlns:zm="urn:zimbra">
    <zm:context hops="$hopCount">
        <zm:authToken>$authToken</zm:authToken>
        <zm:session proxy="true" id="$id" seq="$sequence">$value</zm:session>
        <zm:sessionId proxy="false" id="$id" seq="$sequence">$value</zm:sessionId>
        <zm:nosession>$noSession</zm:nosession>
        <zm:account by="$byId" link="true">$value</zm:account>
        <zm:change token="$changeId" type="$changeType"/>
        <zm:targetServer>$targetServer</zm:targetServer>
        <zm:userAgent name="$name" version="$version"/>
        <zm:authTokenControl voidOnExpired="true"/>
        <zm:format type="$requestFormat"/>
        <zm:notify seq="$sequence"/>
        <zm:nonotify>$noNotify</zm:nonotify>
        <zm:noqualify>$noQualify</zm:noqualify>
        <zm:via>$via</zm:via>
        <zm:soapId>$soapRequestId</zm:soapId>
        <zm:csrfToken>$csrfToken</zm:csrfToken>
   </zm:context>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($header, 'xml'));
        $this->assertEquals($header, $this->serializer->deserialize($xml, SoapHeader::class, 'xml'));
    }
}
