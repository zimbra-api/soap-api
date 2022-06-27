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

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, VirtualProperty, XmlList};
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
     * Import status information
     * @Exclude
     */
    private $statuses = [];

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
     * Gets imap data sources
     *
     * @SerializedName("imap")
     * @Type("array<Zimbra\Mail\Struct\ImapImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="imap", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getImapStatuses(): array
    {
        return array_filter($this->statuses, static fn ($imap) => $imap instanceof ImapImportStatusInfo);
    }

    /**
     * Gets pop3 data sources
     *
     * @SerializedName("pop3")
     * @Type("array<Zimbra\Mail\Struct\Pop3ImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="pop3", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getPop3Statuses(): array
    {
        return array_filter($this->statuses, static fn ($pop3) => $pop3 instanceof Pop3ImportStatusInfo);
    }

    /**
     * Gets caldav data sources
     *
     * @SerializedName("caldav")
     * @Type("array<Zimbra\Mail\Struct\CaldavImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="caldav", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCaldavStatuses(): array
    {
        return array_filter($this->statuses, static fn ($caldav) => $caldav instanceof CaldavImportStatusInfo);
    }

    /**
     * Gets yab data sources
     *
     * @SerializedName("yab")
     * @Type("array<Zimbra\Mail\Struct\YabImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="yab", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getYabStatuses(): array
    {
        return array_filter($this->statuses, static fn ($yab) => $yab instanceof YabImportStatusInfo);
    }

    /**
     * Gets rss data sources
     *
     * @SerializedName("rss")
     * @Type("array<Zimbra\Mail\Struct\RssImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="rss", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getRssStatuses(): array
    {
        return array_filter($this->statuses, static fn ($rss) => $rss instanceof RssImportStatusInfo);
    }

    /**
     * Gets gal data sources
     *
     * @SerializedName("gal")
     * @Type("array<Zimbra\Mail\Struct\GalImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="gal", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getGalStatuses(): array
    {
        return array_filter($this->statuses, static fn ($gal) => $gal instanceof GalImportStatusInfo);
    }

    /**
     * Gets cal data sources
     *
     * @SerializedName("cal")
     * @Type("array<Zimbra\Mail\Struct\CalImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="cal", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCalStatuses(): array
    {
        return array_filter($this->statuses, static fn ($cal) => $cal instanceof CalImportStatusInfo);
    }

    /**
     * Gets unknown data sources
     *
     * @SerializedName("unknown")
     * @Type("array<Zimbra\Mail\Struct\UnknownImportStatusInfo>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="unknown", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getUnknownStatuses(): array
    {
        return array_filter($this->statuses, static fn ($unknown) => $unknown instanceof UnknownImportStatusInfo);
    }

    /**
     * Add status
     *
     * @param  ImportStatusInfo $status
     * @return self
     */
    public function addStatus(ImportStatusInfo $status): self
    {
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
        $this->statuses = array_filter($statuses, static fn ($source) => $source instanceof ImportStatusInfo);
        return $this;
    }

    /**
     * Gets statuses
     *
     * @return array
     */
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    public static function statusTypes(): array
    {
        return [
            'imap' => ImapImportStatusInfo::class,
            'pop3' => Pop3ImportStatusInfo::class,
            'caldav' => CaldavImportStatusInfo::class,
            'yab' => YabImportStatusInfo::class,
            'rss' => RssImportStatusInfo::class,
            'gal' => GalImportStatusInfo::class,
            'cal' => CalImportStatusInfo::class,
            'unknown' => UnknownImportStatusInfo::class,
        ];
    }
}
