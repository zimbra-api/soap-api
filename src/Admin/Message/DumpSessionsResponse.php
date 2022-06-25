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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\InfoForSessionType;
use Zimbra\Soap\ResponseInterface;

/**
 * DumpSessionsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DumpSessionsResponse implements ResponseInterface
{
    /**
     * Count of active sessions
     * @Accessor(getter="getTotalActiveSessions", setter="setTotalActiveSessions")
     * @SerializedName("activeSessions")
     * @Type("int")
     * @XmlAttribute
     */
    private $totalActiveSessions;

    /**
     * Information about SOAP sessions
     * @Accessor(getter="getSoapSessions", setter="setSoapSessions")
     * @SerializedName("soap")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement
     */
    private ?InfoForSessionType $soapSessions = NULL;

    /**
     * Information about IMAP sessions
     * @Accessor(getter="getImapSessions", setter="setImapSessions")
     * @SerializedName("imap")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement
     */
    private ?InfoForSessionType $imapSessions = NULL;

    /**
     * Information about ADMIN sessions
     * @Accessor(getter="getAdminSessions", setter="setAdminSessions")
     * @SerializedName("admin")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement
     */
    private ?InfoForSessionType $adminSessions = NULL;

    /**
     * Information about WIKI sessions
     * @Accessor(getter="getWikiSessions", setter="setWikiSessions")
     * @SerializedName("wiki")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement
     */
    private ?InfoForSessionType $wikiSessions = NULL;

    /**
     * Information about SYNCLISTENER sessions
     * @Accessor(getter="getSynclistenerSessions", setter="setSynclistenerSessions")
     * @SerializedName("synclistener")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement
     */
    private ?InfoForSessionType $synclistenerSessions = NULL;

    /**
     * Information about WaitSet sessions
     * @Accessor(getter="getWaitsetSessions", setter="setWaitsetSessions")
     * @SerializedName("waitset")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement
     */
    private ?InfoForSessionType $waitsetSessions = NULL;

    /**
     * Constructor method for DumpSessionsResponse
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
    public function __construct(int $totalActiveSessions,
        ?InfoForSessionType $soapSessions = NULL,
        ?InfoForSessionType $imapSessions = NULL,
        ?InfoForSessionType $adminSessions = NULL,
        ?InfoForSessionType $wikiSessions = NULL,
        ?InfoForSessionType $synclistenerSessions = NULL,
        ?InfoForSessionType $waitsetSessions = NULL
    )
    {
        $this->setTotalActiveSessions($totalActiveSessions);
        if ($soapSessions instanceof InfoForSessionType) {
            $this->setSoapSessions($soapSessions);
        }
        if ($imapSessions instanceof InfoForSessionType) {
            $this->setImapSessions($imapSessions);
        }
        if ($adminSessions instanceof InfoForSessionType) {
            $this->setAdminSessions($adminSessions);
        }
        if ($wikiSessions instanceof InfoForSessionType) {
            $this->setWikiSessions($wikiSessions);
        }
        if ($synclistenerSessions instanceof InfoForSessionType) {
            $this->setSynclistenerSessions($synclistenerSessions);
        }
        if ($waitsetSessions instanceof InfoForSessionType) {
            $this->setWaitsetSessions($waitsetSessions);
        }
    }

    /**
     * Gets totalActiveSessions
     *
     * @return int
     */
    public function getTotalActiveSessions(): int
    {
        return $this->totalActiveSessions;
    }

    /**
     * Sets totalActiveSessions
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
     * Gets the soapSessions.
     *
     * @return InfoForSessionType
     */
    public function getSoapSessions(): ?InfoForSessionType
    {
        return $this->soapSessions;
    }

    /**
     * Sets the soapSessions.
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
     * Gets the imapSessions.
     *
     * @return InfoForSessionType
     */
    public function getImapSessions(): ?InfoForSessionType
    {
        return $this->imapSessions;
    }

    /**
     * Sets the imapSessions.
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
     * Gets the adminSessions.
     *
     * @return InfoForSessionType
     */
    public function getAdminSessions(): ?InfoForSessionType
    {
        return $this->adminSessions;
    }

    /**
     * Sets the adminSessions.
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
     * Gets the wikiSessions.
     *
     * @return InfoForSessionType
     */
    public function getWikiSessions(): ?InfoForSessionType
    {
        return $this->wikiSessions;
    }

    /**
     * Sets the wikiSessions.
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
     * Gets the synclistenerSessions.
     *
     * @return InfoForSessionType
     */
    public function getSynclistenerSessions(): ?InfoForSessionType
    {
        return $this->synclistenerSessions;
    }

    /**
     * Sets the synclistenerSessions.
     *
     * @param  InfoForSessionType $synclistenerSessions
     * @return self
     */
    public function setSynclistenerSessions(InfoForSessionType $synclistenerSessions): self
    {
        $this->synclistenerSessions = $synclistenerSessions;
        return $this;
    }

    /**
     * Gets the waitsetSessions.
     *
     * @return InfoForSessionType
     */
    public function getWaitsetSessions(): ?InfoForSessionType
    {
        return $this->waitsetSessions;
    }

    /**
     * Sets the waitsetSessions.
     *
     * @param  InfoForSessionType $waitsetSessions
     * @return self
     */
    public function setWaitsetSessions(InfoForSessionType $waitsetSessions): self
    {
        $this->waitsetSessions = $waitsetSessions;
        return $this;
    }
}
