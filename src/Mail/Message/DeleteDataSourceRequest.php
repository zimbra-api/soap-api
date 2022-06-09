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
use Zimbra\Mail\Struct\CalDataSourceNameOrId;
use Zimbra\Mail\Struct\CaldavDataSourceNameOrId;
use Zimbra\Mail\Struct\DataSourceNameOrId;
use Zimbra\Mail\Struct\GalDataSourceNameOrId;
use Zimbra\Mail\Struct\ImapDataSourceNameOrId;
use Zimbra\Mail\Struct\NameOrId;
use Zimbra\Mail\Struct\Pop3DataSourceNameOrId;
use Zimbra\Mail\Struct\RssDataSourceNameOrId;
use Zimbra\Mail\Struct\UnknownDataSourceNameOrId;
use Zimbra\Mail\Struct\YabDataSourceNameOrId;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * DeleteDataSourceRequest class
 * Creates a data source that imports mail items into the specified folder, for example
 * via the POP3 or IMAP protocols.  Only one data source is allowed per request.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteDataSourceRequest extends Request
{
    /**
     * Data sources
     * @Exclude
     */
    private $dataSources = [];

    /**
     * Constructor method for DeleteDataSourceRequest
     *
     * @param  array $dataSources
     * @return self
     */
    public function __construct(array $dataSources = [])
    {
        $this->setDataSources($dataSources);
    }

    /**
     * Gets imap data sources
     *
     * @SerializedName("imap")
     * @Type("array<Zimbra\Mail\Struct\ImapDataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "imap")
     *
     * @return array
     */
    public function getImapDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($imap) => $imap instanceof ImapDataSourceNameOrId);
    }

    /**
     * Gets pop3 data sources
     *
     * @SerializedName("pop3")
     * @Type("array<Zimbra\Mail\Struct\Pop3DataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "pop3")
     *
     * @return array
     */
    public function getPop3DataSources(): array
    {
        return array_filter($this->dataSources, static fn ($pop3) => $pop3 instanceof Pop3DataSourceNameOrId);
    }

    /**
     * Gets caldav data sources
     *
     * @SerializedName("caldav")
     * @Type("array<Zimbra\Mail\Struct\CaldavDataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "caldav")
     *
     * @return array
     */
    public function getCaldavDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($caldav) => $caldav instanceof CaldavDataSourceNameOrId);
    }

    /**
     * Gets yab data sources
     *
     * @SerializedName("yab")
     * @Type("array<Zimbra\Mail\Struct\YabDataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "yab")
     *
     * @return array
     */
    public function getYabDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($yab) => $yab instanceof YabDataSourceNameOrId);
    }

    /**
     * Gets rss data sources
     *
     * @SerializedName("rss")
     * @Type("array<Zimbra\Mail\Struct\RssDataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "rss")
     *
     * @return array
     */
    public function getRssDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($rss) => $rss instanceof RssDataSourceNameOrId);
    }

    /**
     * Gets gal data sources
     *
     * @SerializedName("gal")
     * @Type("array<Zimbra\Mail\Struct\GalDataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "gal")
     *
     * @return array
     */
    public function getGalDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($gal) => $gal instanceof GalDataSourceNameOrId);
    }

    /**
     * Gets cal data sources
     *
     * @SerializedName("cal")
     * @Type("array<Zimbra\Mail\Struct\CalDataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "cal")
     *
     * @return array
     */
    public function getCalDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($cal) => $cal instanceof CalDataSourceNameOrId);
    }

    /**
     * Gets unknown data sources
     *
     * @SerializedName("unknown")
     * @Type("array<Zimbra\Mail\Struct\UnknownDataSourceNameOrId>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "unknown")
     *
     * @return array
     */
    public function getUnknownDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($unknown) => $unknown instanceof UnknownDataSourceNameOrId);
    }

    /**
     * Add dataSource
     *
     * @param  NameOrId $dataSource
     * @return self
     */
    public function addDataSource(NameOrId $dataSource): self
    {
        $this->dataSources[] = $dataSource;
        return $this;
    }

    /**
     * Set dataSources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setDataSources(array $dataSources): self
    {
        $this->dataSources = array_filter($dataSources, static fn ($source) => $source instanceof NameOrId);
        return $this;
    }

    /**
     * Gets dataSources
     *
     * @return array
     */
    public function getDataSources(): array
    {
        return $this->dataSources;
    }

    public static function dataSourceTypes(): array
    {
        return [
            'imap' => ImapDataSourceNameOrId::class,
            'pop3' => Pop3DataSourceNameOrId::class,
            'caldav' => CaldavDataSourceNameOrId::class,
            'yab' => YabDataSourceNameOrId::class,
            'rss' => RssDataSourceNameOrId::class,
            'gal' => GalDataSourceNameOrId::class,
            'cal' => CalDataSourceNameOrId::class,
            'unknown' => UnknownDataSourceNameOrId::class,
        ];
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new DeleteDataSourceEnvelope(
            new DeleteDataSourceBody($this)
        );
    }
}
