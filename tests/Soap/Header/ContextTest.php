<?php declare(strict_types=1);

namespace Zimbra\Tests\Soap\Header;

use Zimbra\Enum\{AccountBy, RequestFormat};
use Zimbra\Soap\Header\{AccountInfo, Context, ChangeInfo, FormatInfo, NotifyInfo, SessionInfo, UserAgentInfo};
use Zimbra\Struct\AuthTokenControl;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for Context.
 */
class ContextTest extends ZimbraStructTestCase
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
        $account = new AccountInfo(AccountBy::ID(), TRUE, $value);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(TRUE);
        $format = new FormatInfo(RequestFormat::XML());
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

        $byId = AccountBy::ID()->getValue();
        $requestFormat = RequestFormat::XML()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<context hops="$hopCount">
    <authToken>$authToken</authToken>
    <session proxy="true" id="$id" seq="$sequence">$value</session>
    <sessionId proxy="false" id="$id" seq="$sequence">$value</sessionId>
    <nosession>$noSession</nosession>
    <account by="$byId" link="true">$value</account>
    <change token="$changeId" type="$changeType"/>
    <targetServer>$targetServer</targetServer>
    <userAgent name="$name" version="$version"/>
    <authTokenControl voidOnExpired="true"/>
    <format type="$requestFormat"/>
    <notify seq="$sequence"/>
    <nonotify>$noNotify</nonotify>
    <noqualify>$noQualify</noqualify>
    <via>$via</via>
    <soapId>$soapRequestId</soapId>
    <csrfToken>$csrfToken</csrfToken>
</context>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($context, 'xml'));
        $this->assertEquals($context, $this->serializer->deserialize($xml, Context::class, 'xml'));

        $json = json_encode([
            'hops' => $hopCount,
            'authToken' => [
                '_content' => $authToken,
            ],
            'session' => [
                'proxy' => TRUE,
                'id' => $id,
                'seq' => $sequence,
                '_content' => $value,
            ],
            'sessionId' => [
                'proxy' => FALSE,
                'id' => $id,
                'seq' => $sequence,
                '_content' => $value,
            ],
            'nosession' => [
                '_content' => $noSession,
            ],
            'account' => [
                'by' => $byId,
                'link' => TRUE,
                '_content' => $value,
            ],
            'change' => [
                'token' => $changeId,
                'type' => $changeType,
            ],
            'targetServer' => [
                '_content' => $targetServer,
            ],
            'userAgent' => [
                'name' => $name,
                'version' => $version,
            ],
            'authTokenControl' => [
                'voidOnExpired' => TRUE,
            ],
            'format' => [
                'type' => $requestFormat,
            ],
            'notify' => [
                'seq' => $sequence,
            ],
            'nonotify' => [
                '_content' => $noNotify,
            ],
            'noqualify' => [
                '_content' => $noQualify,
            ],
            'via' => [
                '_content' => $via,
            ],
            'soapId' => [
                '_content' => $soapRequestId,
            ],
            'csrfToken' => [
                '_content' => $csrfToken,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($context, 'json'));
        $this->assertEquals($context, $this->serializer->deserialize($json, Context::class, 'json'));
    }
}
