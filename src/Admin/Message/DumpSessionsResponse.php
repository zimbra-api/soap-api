<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\InfoForSessionType;
use Zimbra\Common\Struct\SoapResponse;

/**
 * DumpSessionsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DumpSessionsResponse extends SoapResponse
{
    /**
     * Count of active sessions
     *
     * @var int
     */
    #[
        Accessor(
            getter: "getTotalActiveSessions",
            setter: "setTotalActiveSessions"
        )
    ]
    #[SerializedName("activeSessions")]
    #[Type("int")]
    #[XmlAttribute]
    private $totalActiveSessions;

    /**
     * Information about SOAP sessions
     *
     * @var InfoForSessionType
     */
    #[Accessor(getter: "getSoapSessions", setter: "setSoapSessions")]
    #[SerializedName("soap")]
    #[Type(InfoForSessionType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?InfoForSessionType $soapSessions;

    /**
     * Information about IMAP sessions
     *
     * @var InfoForSessionType
     */
    #[Accessor(getter: "getImapSessions", setter: "setImapSessions")]
    #[SerializedName("imap")]
    #[Type(InfoForSessionType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?InfoForSessionType $imapSessions;

    /**
     * Information about ADMIN sessions
     *
     * @var InfoForSessionType
     */
    #[Accessor(getter: "getAdminSessions", setter: "setAdminSessions")]
    #[SerializedName("admin")]
    #[Type(InfoForSessionType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?InfoForSessionType $adminSessions;

    /**
     * Information about WIKI sessions
     *
     * @var InfoForSessionType
     */
    #[Accessor(getter: "getWikiSessions", setter: "setWikiSessions")]
    #[SerializedName("wiki")]
    #[Type(InfoForSessionType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?InfoForSessionType $wikiSessions;

    /**
     * Information about SYNCLISTENER sessions
     *
     * @var InfoForSessionType
     */
    #[
        Accessor(
            getter: "getSynclistenerSessions",
            setter: "setSynclistenerSessions"
        )
    ]
    #[SerializedName("synclistener")]
    #[Type(InfoForSessionType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?InfoForSessionType $synclistenerSessions;

    /**
     * Information about WaitSet sessions
     *
     * @var InfoForSessionType
     */
    #[Accessor(getter: "getWaitsetSessions", setter: "setWaitsetSessions")]
    #[SerializedName("waitset")]
    #[Type(InfoForSessionType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?InfoForSessionType $waitsetSessions;

    /**
     * Constructor
     *
     * @param int $totalActiveSessions
     * @param InfoForSessionType $soapSessions
     * @param InfoForSessionType $imapSessions
     * @param InfoForSessionType $adminSessions
     * @param InfoForSessionType $wikiSessions
     * @param InfoForSessionType $synclistenerSessions
     * @param InfoForSessionType $waitsetSessions
     * @return self
     */
    public function __construct(
        int $totalActiveSessions = 0,
        ?InfoForSessionType $soapSessions = null,
        ?InfoForSessionType $imapSessions = null,
        ?InfoForSessionType $adminSessions = null,
        ?InfoForSessionType $wikiSessions = null,
        ?InfoForSessionType $synclistenerSessions = null,
        ?InfoForSessionType $waitsetSessions = null
    ) {
        $this->setTotalActiveSessions($totalActiveSessions);
        $this->soapSessions = $soapSessions;
        $this->imapSessions = $imapSessions;
        $this->adminSessions = $adminSessions;
        $this->wikiSessions = $wikiSessions;
        $this->synclistenerSessions = $synclistenerSessions;
        $this->waitsetSessions = $waitsetSessions;
    }

    /**
     * Get totalActiveSessions
     *
     * @return int
     */
    public function getTotalActiveSessions(): int
    {
        return $this->totalActiveSessions;
    }

    /**
     * Set totalActiveSessions
     *
     * @param  int $totalActiveSessions
     * @return self
     */
    public function setTotalActiveSessions(int $totalActiveSessions): self
    {
        $this->totalActiveSessions = $totalActiveSessions;
        return $this;
    }

    /**
     * Get the soapSessions.
     *
     * @return InfoForSessionType
     */
    public function getSoapSessions(): ?InfoForSessionType
    {
        return $this->soapSessions;
    }

    /**
     * Set the soapSessions.
     *
     * @param  InfoForSessionType $soapSessions
     * @return self
     */
    public function setSoapSessions(InfoForSessionType $soapSessions): self
    {
        $this->soapSessions = $soapSessions;
        return $this;
    }

    /**
     * Get the imapSessions.
     *
     * @return InfoForSessionType
     */
    public function getImapSessions(): ?InfoForSessionType
    {
        return $this->imapSessions;
    }

    /**
     * Set the imapSessions.
     *
     * @param  InfoForSessionType $imapSessions
     * @return self
     */
    public function setImapSessions(InfoForSessionType $imapSessions): self
    {
        $this->imapSessions = $imapSessions;
        return $this;
    }

    /**
     * Get the adminSessions.
     *
     * @return InfoForSessionType
     */
    public function getAdminSessions(): ?InfoForSessionType
    {
        return $this->adminSessions;
    }

    /**
     * Set the adminSessions.
     *
     * @param  InfoForSessionType $adminSessions
     * @return self
     */
    public function setAdminSessions(InfoForSessionType $adminSessions): self
    {
        $this->adminSessions = $adminSessions;
        return $this;
    }

    /**
     * Get the wikiSessions.
     *
     * @return InfoForSessionType
     */
    public function getWikiSessions(): ?InfoForSessionType
    {
        return $this->wikiSessions;
    }

    /**
     * Set the wikiSessions.
     *
     * @param  InfoForSessionType $wikiSessions
     * @return self
     */
    public function setWikiSessions(InfoForSessionType $wikiSessions): self
    {
        $this->wikiSessions = $wikiSessions;
        return $this;
    }

    /**
     * Get the synclistenerSessions.
     *
     * @return InfoForSessionType
     */
    public function getSynclistenerSessions(): ?InfoForSessionType
    {
        return $this->synclistenerSessions;
    }

    /**
     * Set the synclistenerSessions.
     *
     * @param  InfoForSessionType $synclistenerSessions
     * @return self
     */
    public function setSynclistenerSessions(
        InfoForSessionType $synclistenerSessions
    ): self {
        $this->synclistenerSessions = $synclistenerSessions;
        return $this;
    }

    /**
     * Get the waitsetSessions.
     *
     * @return InfoForSessionType
     */
    public function getWaitsetSessions(): ?InfoForSessionType
    {
        return $this->waitsetSessions;
    }

    /**
     * Set the waitsetSessions.
     *
     * @param  InfoForSessionType $waitsetSessions
     * @return self
     */
    public function setWaitsetSessions(
        InfoForSessionType $waitsetSessions
    ): self {
        $this->waitsetSessions = $waitsetSessions;
        return $this;
    }
}
