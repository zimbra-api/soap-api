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
    MailImapDataSource,
    MailPop3DataSource,
    MailCaldavDataSource,
    MailYabDataSource,
    MailRssDataSource,
    MailGalDataSource,
    MailCalDataSource,
    MailUnknownDataSource,
    MailDataSource
};
use Zimbra\Soap\ResponseInterface;

/**
 * GetDataSourcesResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDataSourcesResponse implements ResponseInterface
{
    /**
     * Data source information
     * @Exclude
     */
    private $dataSources = [];

    /**
     * Constructor method for GetDataSourcesResponse
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
     * @Type("array<Zimbra\Mail\Struct\MailImapDataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="imap", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getImapDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($imap) => $imap instanceof MailImapDataSource);
    }

    /**
     * Gets pop3 data sources
     *
     * @Type("array<Zimbra\Mail\Struct\MailPop3DataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="pop3", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getPop3DataSources(): array
    {
        return array_filter($this->dataSources, static fn ($pop3) => $pop3 instanceof MailPop3DataSource);
    }

    /**
     * Gets caldav data sources
     *
     * @Type("array<Zimbra\Mail\Struct\MailCaldavDataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="caldav", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCaldavDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($caldav) => $caldav instanceof MailCaldavDataSource);
    }

    /**
     * Gets yab data sources
     *
     * @Type("array<Zimbra\Mail\Struct\MailYabDataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="yab", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getYabDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($yab) => $yab instanceof MailYabDataSource);
    }

    /**
     * Gets rss data sources
     *
     * @Type("array<Zimbra\Mail\Struct\MailRssDataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="rss", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getRssDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($rss) => $rss instanceof MailRssDataSource);
    }

    /**
     * Gets gal data sources
     *
     * @Type("array<Zimbra\Mail\Struct\MailGalDataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="gal", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getGalDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($gal) => $gal instanceof MailGalDataSource);
    }

    /**
     * Gets cal data sources
     *
     * @Type("array<Zimbra\Mail\Struct\MailCalDataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="cal", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getCalDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($cal) => $cal instanceof MailCalDataSource);
    }

    /**
     * Gets unknown data sources
     *
     * @Type("array<Zimbra\Mail\Struct\MailUnknownDataSource>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="unknown", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getUnknownDataSources(): array
    {
        return array_filter($this->dataSources, static fn ($unknown) => $unknown instanceof MailUnknownDataSource);
    }

    /**
     * Add dataSource
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function addDataSource(MailDataSource $dataSource): self
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
        $this->dataSources = array_filter($dataSources, static fn ($source) => $source instanceof MailDataSource);
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
            'imap' => MailImapDataSource::class,
            'pop3' => MailPop3DataSource::class,
            'caldav' => MailCaldavDataSource::class,
            'yab' => MailYabDataSource::class,
            'rss' => MailRssDataSource::class,
            'gal' => MailGalDataSource::class,
            'cal' => MailCalDataSource::class,
            'unknown' => MailUnknownDataSource::class,
        ];
    }
}
