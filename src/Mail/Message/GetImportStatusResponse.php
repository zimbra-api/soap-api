<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, Exclude, Type, VirtualProperty, XmlList};
use Zimbra\Mail\Struct\{
    ImapImportStatusInfo,
    Pop3ImportStatusInfo,
    CaldavImportStatusInfo,
    YabImportStatusInfo,
    RssImportStatusInfo,
    GalImportStatusInfo,
    CalImportStatusInfo,
    UnknownImportStatusInfo,
    ImportStatusInfo
};
use Zimbra\Soap\ResponseInterface;

/**
 * GetImportStatusResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetImportStatusResponse implements ResponseInterface
{
    /**
     * Imap statuses
     * 
     * @Accessor(getter="getImapStatuses", setter="setImapStatuses")
     * @Type("array<Zimbra\Mail\Struct\ImapImportStatusInfo>")
     * @XmlList(inline=true, entry="imap", namespace="urn:zimbraMail")
     */
    private $imapStatuses = [];

    /**
     * Pop3 statuses
     * 
     * @Accessor(getter="getPop3Statuses", setter="setPop3Statuses")
     * @Type("array<Zimbra\Mail\Struct\Pop3ImportStatusInfo>")
     * @XmlList(inline=true, entry="pop3", namespace="urn:zimbraMail")
     */
    private $pop3Statuses = [];

    /**
     * Caldav statuses
     * 
     * @Accessor(getter="getCaldavStatuses", setter="setCaldavStatuses")
     * @Type("array<Zimbra\Mail\Struct\CaldavImportStatusInfo>")
     * @XmlList(inline=true, entry="caldav", namespace="urn:zimbraMail")
     */
    private $caldavStatuses = [];

    /**
     * Yab statuses
     * 
     * @Accessor(getter="getYabStatuses", setter="setYabStatuses")
     * @Type("array<Zimbra\Mail\Struct\YabImportStatusInfo>")
     * @XmlList(inline=true, entry="yab", namespace="urn:zimbraMail")
     */
    private $yabStatuses = [];

    /**
     * Rss statuses
     * 
     * @Accessor(getter="getRssStatuses", setter="setRssStatuses")
     * @Type("array<Zimbra\Mail\Struct\RssImportStatusInfo>")
     * @XmlList(inline=true, entry="rss", namespace="urn:zimbraMail")
     */
    private $rssStatuses = [];

    /**
     * Gal statuses
     * 
     * @Accessor(getter="getGalStatuses", setter="setGalStatuses")
     * @Type("array<Zimbra\Mail\Struct\GalImportStatusInfo>")
     * @XmlList(inline=true, entry="gal", namespace="urn:zimbraMail")
     */
    private $galStatuses = [];

    /**
     * Cal statuses
     * 
     * @Accessor(getter="getCalStatuses", setter="setCalStatuses")
     * @Type("array<Zimbra\Mail\Struct\CalImportStatusInfo>")
     * @XmlList(inline=true, entry="cal", namespace="urn:zimbraMail")
     */
    private $calStatuses = [];

    /**
     * Unknown statuses
     * 
     * @Accessor(getter="getUnknownStatuses", setter="setUnknownStatuses")
     * @Type("array<Zimbra\Mail\Struct\UnknownImportStatusInfo>")
     * @XmlList(inline=true, entry="unknown", namespace="urn:zimbraMail")
     */
    private $unknownStatuses = [];

    /**
     * Constructor method for GetImportStatusResponse
     *
     * @param  array $statuses
     * @return self
     */
    public function __construct(array $statuses = [])
    {
        $this->setStatuses($statuses);
    }

    /**
     * Gets imap statuses
     *
     * @return array
     */
    public function getImapStatuses(): array
    {
        return $this->imapStatuses;
    }

    /**
     * Sets imap statuses
     *
     * @return self
     */
    public function setImapStatuses(array $statuss): self
    {
        $this->imapStatuses = array_filter($statuss, static fn ($imap) => $imap instanceof ImapImportStatusInfo);
        return $this;
    }

    /**
     * Gets pop3 statuses
     *
     * @return array
     */
    public function getPop3Statuses(): array
    {
        return $this->pop3Statuses;
    }

    /**
     * Sets pop3 statuses
     *
     * @return self
     */
    public function setPop3Statuses(array $statuss): self
    {
        $this->pop3Statuses = array_filter($statuss, static fn ($pop3) => $pop3 instanceof Pop3ImportStatusInfo);
        return $this;
    }

    /**
     * Gets caldav statuses
     *
     * @return array
     */
    public function getCaldavStatuses(): array
    {
        return $this->caldavStatuses;
    }

    /**
     * Sets caldav statuses
     *
     * @return self
     */
    public function setCaldavStatuses(array $statuss): self
    {
        $this->caldavStatuses = array_filter($statuss, static fn ($caldav) => $caldav instanceof CaldavImportStatusInfo);
        return $this;
    }

    /**
     * Gets yab statuses
     *
     * @return array
     */
    public function getYabStatuses(): array
    {
        return $this->yabStatuses;
    }

    /**
     * Sets yab statuses
     *
     * @return self
     */
    public function setYabStatuses(array $statuss): self
    {
        $this->yabStatuses = array_filter($statuss, static fn ($yab) => $yab instanceof YabImportStatusInfo);
        return $this;
    }

    /**
     * Gets rss statuses
     *
     * @return array
     */
    public function getRssStatuses(): array
    {
        return $this->rssStatuses;
    }

    /**
     * Sets rss statuses
     *
     * @return self
     */
    public function setRssStatuses(array $statuss): self
    {
        $this->rssStatuses = array_filter($statuss, static fn ($rss) => $rss instanceof RssImportStatusInfo);
        return $this;
    }

    /**
     * Gets gal statuses
     *
     * @return array
     */
    public function getGalStatuses(): array
    {
        return $this->galStatuses;
    }

    /**
     * Sets gal statuses
     *
     * @return self
     */
    public function setGalStatuses(array $statuss): self
    {
        $this->galStatuses = array_filter($statuss, static fn ($gal) => $gal instanceof GalImportStatusInfo);
        return $this;
    }

    /**
     * Gets cal statuses
     *
     * @return array
     */
    public function getCalStatuses(): array
    {
        return $this->calStatuses;
    }

    /**
     * Sets cal statuses
     *
     * @return self
     */
    public function setCalStatuses(array $statuss): self
    {
        $this->calStatuses = array_filter($statuss, static fn ($cal) => $cal instanceof CalImportStatusInfo);
        return $this;
    }

    /**
     * Gets unknown statuses
     *
     * @return array
     */
    public function getUnknownStatuses(): array
    {
        return $this->unknownStatuses;
    }

    /**
     * Sets unknown statuses
     *
     * @return self
     */
    public function setUnknownStatuses(array $statuss): self
    {
        $this->unknownStatuses = array_filter($statuss, static fn ($unknown) => $unknown instanceof UnknownImportStatusInfo);
        return $this;
    }

    /**
     * Add status
     *
     * @param  ImportStatusInfo $status
     * @return self
     */
    public function addStatus(ImportStatusInfo $status): self
    {
        if ($status instanceof ImapImportStatusInfo) {
            $this->imapStatuses[] = $status;
        }
        if ($status instanceof Pop3ImportStatusInfo) {
            $this->pop3Statuses[] = $status;
        }
        if ($status instanceof CaldavImportStatusInfo) {
            $this->caldavStatuses[] = $status;
        }
        if ($status instanceof YabImportStatusInfo) {
            $this->yabStatuses[] = $status;
        }
        if ($status instanceof RssImportStatusInfo) {
            $this->rssStatuses[] = $status;
        }
        if ($status instanceof GalImportStatusInfo) {
            $this->galStatuses[] = $status;
        }
        if ($status instanceof CalImportStatusInfo) {
            $this->calStatuses[] = $status;
        }
        if ($status instanceof UnknownImportStatusInfo) {
            $this->unknownStatuses[] = $status;
        }
        $this->statuses[] = $status;
        return $this;
    }

    /**
     * Set statuses
     *
     * @param  array $statuses
     * @return self
     */
    public function setStatuses(array $statuses): self
    {
        $this->setImapStatuses($statuses)
             ->setPop3Statuses($statuses)
             ->setCaldavStatuses($statuses)
             ->setYabStatuses($statuses)
             ->setRssStatuses($statuses)
             ->setGalStatuses($statuses)
             ->setCalStatuses($statuses)
             ->setUnknownStatuses($statuses);
        return $this;
    }

    /**
     * Gets statuses
     *
     * @return array
     */
    public function getStatuses(): array
    {
        return array_merge(
            $this->imapStatuses,
            $this->pop3Statuses,
            $this->caldavStatuses,
            $this->yabStatuses,
            $this->rssStatuses,
            $this->galStatuses,
            $this->calStatuses,
            $this->unknownStatuses
        );
    }
}
