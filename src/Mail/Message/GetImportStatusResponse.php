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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetImportStatusResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetImportStatusResponse extends SoapResponse
{
    /**
     * Imap statuses
     *
     * @var array
     */
    #[Accessor(getter: "getImapStatuses", setter: "setImapStatuses")]
    #[Type("array<Zimbra\Mail\Struct\ImapImportStatusInfo>")]
    #[XmlList(inline: true, entry: "imap", namespace: "urn:zimbraMail")]
    private array $imapStatuses = [];

    /**
     * Pop3 statuses
     *
     * @var array
     */
    #[Accessor(getter: "getPop3Statuses", setter: "setPop3Statuses")]
    #[Type("array<Zimbra\Mail\Struct\Pop3ImportStatusInfo>")]
    #[XmlList(inline: true, entry: "pop3", namespace: "urn:zimbraMail")]
    private array $pop3Statuses = [];

    /**
     * Caldav statuses
     *
     * @var array
     */
    #[Accessor(getter: "getCaldavStatuses", setter: "setCaldavStatuses")]
    #[Type("array<Zimbra\Mail\Struct\CaldavImportStatusInfo>")]
    #[XmlList(inline: true, entry: "caldav", namespace: "urn:zimbraMail")]
    private array $caldavStatuses = [];

    /**
     * Yab statuses
     *
     * @var array
     */
    #[Accessor(getter: "getYabStatuses", setter: "setYabStatuses")]
    #[Type("array<Zimbra\Mail\Struct\YabImportStatusInfo>")]
    #[XmlList(inline: true, entry: "yab", namespace: "urn:zimbraMail")]
    private array $yabStatuses = [];

    /**
     * Rss statuses
     *
     * @var array
     */
    #[Accessor(getter: "getRssStatuses", setter: "setRssStatuses")]
    #[Type("array<Zimbra\Mail\Struct\RssImportStatusInfo>")]
    #[XmlList(inline: true, entry: "rss", namespace: "urn:zimbraMail")]
    private array $rssStatuses = [];

    /**
     * Gal statuses
     *
     * @var array
     */
    #[Accessor(getter: "getGalStatuses", setter: "setGalStatuses")]
    #[Type("array<Zimbra\Mail\Struct\GalImportStatusInfo>")]
    #[XmlList(inline: true, entry: "gal", namespace: "urn:zimbraMail")]
    private array $galStatuses = [];

    /**
     * Cal statuses
     *
     * @var array
     */
    #[Accessor(getter: "getCalStatuses", setter: "setCalStatuses")]
    #[Type("array<Zimbra\Mail\Struct\CalImportStatusInfo>")]
    #[XmlList(inline: true, entry: "cal", namespace: "urn:zimbraMail")]
    private array $calStatuses = [];

    /**
     * Unknown statuses
     *
     * @var array
     */
    #[Accessor(getter: "getUnknownStatuses", setter: "setUnknownStatuses")]
    #[Type("array<Zimbra\Mail\Struct\UnknownImportStatusInfo>")]
    #[XmlList(inline: true, entry: "unknown", namespace: "urn:zimbraMail")]
    private array $unknownStatuses = [];

    /**
     * Constructor
     *
     * @param  array $statuses
     * @return self
     */
    public function __construct(array $statuses = [])
    {
        $this->setStatuses($statuses);
    }

    /**
     * Get imap statuses
     *
     * @return array
     */
    public function getImapStatuses(): array
    {
        return $this->imapStatuses;
    }

    /**
     * Set imap statuses
     *
     * @return self
     */
    public function setImapStatuses(array $statuses): self
    {
        $this->imapStatuses = array_values(
            array_filter(
                $statuses,
                static fn($imap) => $imap instanceof ImapImportStatusInfo
            )
        );
        return $this;
    }

    /**
     * Get pop3 statuses
     *
     * @return array
     */
    public function getPop3Statuses(): array
    {
        return $this->pop3Statuses;
    }

    /**
     * Set pop3 statuses
     *
     * @return self
     */
    public function setPop3Statuses(array $statuses): self
    {
        $this->pop3Statuses = array_values(
            array_filter(
                $statuses,
                static fn($pop3) => $pop3 instanceof Pop3ImportStatusInfo
            )
        );
        return $this;
    }

    /**
     * Get caldav statuses
     *
     * @return array
     */
    public function getCaldavStatuses(): array
    {
        return $this->caldavStatuses;
    }

    /**
     * Set caldav statuses
     *
     * @return self
     */
    public function setCaldavStatuses(array $statuses): self
    {
        $this->caldavStatuses = array_values(
            array_filter(
                $statuses,
                static fn($caldav) => $caldav instanceof CaldavImportStatusInfo
            )
        );
        return $this;
    }

    /**
     * Get yab statuses
     *
     * @return array
     */
    public function getYabStatuses(): array
    {
        return $this->yabStatuses;
    }

    /**
     * Set yab statuses
     *
     * @return self
     */
    public function setYabStatuses(array $statuses): self
    {
        $this->yabStatuses = array_values(
            array_filter(
                $statuses,
                static fn($yab) => $yab instanceof YabImportStatusInfo
            )
        );
        return $this;
    }

    /**
     * Get rss statuses
     *
     * @return array
     */
    public function getRssStatuses(): array
    {
        return $this->rssStatuses;
    }

    /**
     * Set rss statuses
     *
     * @return self
     */
    public function setRssStatuses(array $statuses): self
    {
        $this->rssStatuses = array_values(
            array_filter(
                $statuses,
                static fn($rss) => $rss instanceof RssImportStatusInfo
            )
        );
        return $this;
    }

    /**
     * Get gal statuses
     *
     * @return array
     */
    public function getGalStatuses(): array
    {
        return $this->galStatuses;
    }

    /**
     * Set gal statuses
     *
     * @return self
     */
    public function setGalStatuses(array $statuses): self
    {
        $this->galStatuses = array_values(
            array_filter(
                $statuses,
                static fn($gal) => $gal instanceof GalImportStatusInfo
            )
        );
        return $this;
    }

    /**
     * Get cal statuses
     *
     * @return array
     */
    public function getCalStatuses(): array
    {
        return $this->calStatuses;
    }

    /**
     * Set cal statuses
     *
     * @return self
     */
    public function setCalStatuses(array $statuses): self
    {
        $this->calStatuses = array_values(
            array_filter(
                $statuses,
                static fn($cal) => $cal instanceof CalImportStatusInfo
            )
        );
        return $this;
    }

    /**
     * Get unknown statuses
     *
     * @return array
     */
    public function getUnknownStatuses(): array
    {
        return $this->unknownStatuses;
    }

    /**
     * Set unknown statuses
     *
     * @return self
     */
    public function setUnknownStatuses(array $statuses): self
    {
        $this->unknownStatuses = array_values(
            array_filter(
                $statuses,
                static fn($unknown) => $unknown instanceof
                    UnknownImportStatusInfo
            )
        );
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
     * Get statuses
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
