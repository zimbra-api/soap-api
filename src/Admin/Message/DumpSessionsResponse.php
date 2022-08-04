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
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?InfoForSessionType $soapSessions = NULL;

    /**
     * Information about IMAP sessions
     * @Accessor(getter="getImapSessions", setter="setImapSessions")
     * @SerializedName("imap")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?InfoForSessionType $imapSessions = NULL;

    /**
     * Information about ADMIN sessions
     * @Accessor(getter="getAdminSessions", setter="setAdminSessions")
     * @SerializedName("admin")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?InfoForSessionType $adminSessions = NULL;

    /**
     * Information about WIKI sessions
     * @Accessor(getter="getWikiSessions", setter="setWikiSessions")
     * @SerializedName("wiki")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?InfoForSessionType $wikiSessions = NULL;

    /**
     * Information about SYNCLISTENER sessions
     * @Accessor(getter="getSynclistenerSessions", setter="setSynclistenerSessions")
     * @SerializedName("synclistener")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?InfoForSessionType $synclistenerSessions = NULL;

    /**
     * Information about WaitSet sessions
     * @Accessor(getter="getWaitsetSessions", setter="setWaitsetSessions")
     * @SerializedName("waitset")
     * @Type("Zimbra\Admin\Struct\InfoForSessionType")
     * @XmlElement(namespace="urn:zimbraAdmin")
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
    public function __construct(
        int $totalActiveSessions = 0,
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
    public function setSynclistenerSessions(InfoForSessionType $synclistenerSessions): self
    {
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
    public function setWaitsetSessions(InfoForSessionType $waitsetSessions): self
    {
        $this->waitsetSessions = $waitsetSessions;
        return $this;
    }
}
