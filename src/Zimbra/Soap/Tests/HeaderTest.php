<?php

namespace Zimbra\Soap\Tests;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\RequestFormat;

use Zimbra\Soap\Header;
use Zimbra\Soap\Header\Context;
use Zimbra\Soap\Header\AccountInfo;
use Zimbra\Soap\Header\ChangeInfo;
use Zimbra\Soap\Header\FormatInfo;
use Zimbra\Soap\Header\NotifyInfo;
use Zimbra\Soap\Header\SessionInfo;
use Zimbra\Soap\Header\UserAgentInfo;
use Zimbra\Struct\AuthTokenControl;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Header.
 */
class HeaderTest extends ZimbraStructTestCase
{
    public function testSoapHeader()
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

        $session = new SessionInfo(true, $id, $sequence, $value);
        $legacySessionId = new SessionInfo(false, $id, $sequence, $value);
        $account = new AccountInfo(AccountBy::ID()->value(), true, $value);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(true);
        $format = new FormatInfo(RequestFormat::XML()->value());
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

        $header = new Header($context);
        $this->assertSame($context, $header->getContext());
        $header = new Header();
        $header->setContext($context);
        $this->assertSame($context, $header->getContext());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Header xmlns:urn="urn:zimbra">'
                . '<urn:context hops="' . $hopCount . '" >'
                    . '<authToken>' . $authToken . '</authToken>'
                    . '<session proxy="true" id="' . $id . '" seq="' . $sequence . '">' . $value . '</session>'
                    . '<sessionId proxy="false" id="' . $id . '" seq="' . $sequence . '">' . $value . '</sessionId>'
                    . '<nosession>' . $noSession . '</nosession>'
                    . '<account by="' . AccountBy::ID() . '" link="true">' . $value . '</account>'
                    . '<change token="' . $changeId . '" type="' . $changeType . '"/>'
                    . '<targetServer>' . $targetServer . '</targetServer>'
                    . '<userAgent name="' . $name . '" version="' . $version . '"/>'
                    . '<authTokenControl voidOnExpired="true"/>'
                    . '<format type="' . RequestFormat::XML() . '"/>'
                    . '<notify seq="' . $sequence . '"/>'
                    . '<nonotify>' . $noNotify . '</nonotify>'
                    . '<noqualify>' . $noQualify . '</noqualify>'
                    . '<via>' . $via . '</via>'
                    . '<soapId>' . $soapRequestId . '</soapId>'
                    . '<csrfToken>' . $csrfToken . '</csrfToken>'
                . '</urn:context>'
            . '</soap:Header>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($header, 'xml'));

        $header = $this->serializer->deserialize($xml, 'Zimbra\Soap\Header', 'xml');
        $context = $header->getContext();
        $this->assertSame($hopCount, $context->getHopCount());
        $this->assertSame($authToken, $context->getAuthToken());
        $this->assertSame($noSession, $context->getNoSession());
        $this->assertSame($targetServer, $context->getTargetServer());
        $this->assertSame($noNotify, $context->getNoNotify());
        $this->assertSame($noQualify, $context->getNoQualify());
        $this->assertSame($via, $context->getVia());
        $this->assertSame($soapRequestId, $context->getSoapRequestId());
        $this->assertSame($csrfToken, $context->getCsrfToken());

        $sessionInfo = $context->getSession();
        $this->assertTrue($sessionInfo->getSessionProxied());
        $this->assertSame($id, $sessionInfo->getSessionId());
        $this->assertSame($sequence, $sessionInfo->getSequenceNum());
        $this->assertSame($value, $sessionInfo->getValue());

        $legacySessionId = $context->getLegacySessionId();
        $this->assertFalse($legacySessionId->getSessionProxied());
        $this->assertSame($id, $legacySessionId->getSessionId());
        $this->assertSame($sequence, $legacySessionId->getSequenceNum());
        $this->assertSame($value, $legacySessionId->getValue());

        $accountInfo = $context->getAccount();
        $this->assertSame(AccountBy::ID()->value(), $accountInfo->getBy());
        $this->assertTrue($accountInfo->getMountpointTraversed());
        $this->assertSame($value, $accountInfo->getValue());

        $changeInfo = $context->getChange();
        $this->assertSame($changeId, $changeInfo->getChangeId());
        $this->assertSame($changeType, $changeInfo->getChangeType());

        $userAgentInfo = $context->getUserAgent();
        $this->assertSame($name, $userAgentInfo->getName());
        $this->assertSame($version, $userAgentInfo->getVersion());

        $control = $context->getAuthTokenControl();
        $this->assertTrue($control->getVoidOnExpired());

        $controlInfo = $context->getFormat();
        $this->assertSame(RequestFormat::XML()->value(), $controlInfo->getFormat());

        $notifyInfo = $context->getNotify();
        $this->assertSame($sequence, $notifyInfo->getSequenceNum());
    }
}
