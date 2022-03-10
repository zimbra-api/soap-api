<?php declare(strict_types=1);

namespace Zimbra\Tests\Soap;

use Zimbra\Enum\{AccountBy, RequestFormat};
use Zimbra\Soap\Header;
use Zimbra\Soap\Header\{AccountInfo, Context, ChangeInfo, FormatInfo, NotifyInfo, SessionInfo, UserAgentInfo};
use Zimbra\Struct\AuthTokenControl;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Header.
 */
class HeaderTest extends ZimbraTestCase
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

        $header = new Header($context);
        $this->assertSame($context, $header->getContext());
        $header = new Header();
        $header->setContext($context);
        $this->assertSame($context, $header->getContext());

        $byId = AccountBy::ID()->getValue();
        $requestFormat = RequestFormat::XML()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
    <result xmlns:zm="urn:zimbra">
        <zm:context hops="$hopCount">
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
       </zm:context>
   </result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($header, 'xml'));
        $this->assertEquals($header, $this->serializer->deserialize($xml, Header::class, 'xml'));

        $json = json_encode([
            'context' => [
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
                '_jsns' => 'urn:zimbra',
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($header, 'json'));
        $this->assertEquals($header, $this->serializer->deserialize($json, Header::class, 'json'));
    }
}
