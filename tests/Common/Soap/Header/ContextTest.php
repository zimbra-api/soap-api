<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Header;

use JMS\Serializer\Annotation\XmlNamespace;
use Zimbra\Common\Enum\{AccountBy, RequestFormat};
use Zimbra\Common\Struct\AuthTokenControl;
use Zimbra\Common\Soap\Header\{
    AccountInfo, Context, ChangeInfo, FormatInfo, NotifyInfo, SessionInfo, UserAgentInfo
};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Context.
 */
class ContextTest extends ZimbraTestCase
{
    public function testHeaderContext()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $sequence = mt_rand(1, 100);
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;
        $version = $this->faker->word;

        $hopCount = mt_rand(1, 100);
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
        $account = new AccountInfo(AccountBy::ID(), $value, TRUE);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(TRUE);
        $format = new FormatInfo(RequestFormat::XML());
        $notify = new NotifyInfo($sequence);

        $context = new MockContext(
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

        $context = new MockContext();
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

        $byId = AccountBy::ID()->getValue();
        $requestFormat = RequestFormat::XML()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:zm="urn:zimbra" hops="$hopCount">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($context, 'xml'));
        $this->assertEquals($context, $this->serializer->deserialize($xml, MockContext::class, 'xml'));
    }
}

/**
 * Header context class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbra", prefix="zm")
 */
class MockContext extends Context
{
}
