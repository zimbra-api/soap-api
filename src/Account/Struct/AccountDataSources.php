<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, VirtualProperty, XmlList};

/**
 * AccountDataSources struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AccountDataSources
{
    /**
     * Data sources
     * @Exclude
     */
    private $dataSources = [];

    /**
     * Constructor method for AccountDataSources
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
     * @Type("array<Zimbra\Account\Struct\AccountImapDataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "imap")
     *
     * @return array
     */
    public function getImapDataSources(): array
    {
        return array_filter($this->dataSources, static fn($imap) => $imap instanceof AccountImapDataSource);
    }

    /**
     * Gets pop3 data sources
     *
     * @SerializedName("pop3")
     * @Type("array<Zimbra\Account\Struct\AccountPop3DataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "pop3")
     *
     * @return array
     */
    public function getPop3DataSources(): array
    {
        return array_filter($this->dataSources, static fn($pop3) => $pop3 instanceof AccountPop3DataSource);
    }

    /**
     * Gets caldav data sources
     *
     * @SerializedName("caldav")
     * @Type("array<Zimbra\Account\Struct\AccountCaldavDataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "caldav")
     *
     * @return array
     */
    public function getCaldavDataSources(): array
    {
        return array_filter($this->dataSources, static fn($caldav) => $caldav instanceof AccountCaldavDataSource);
    }

    /**
     * Gets yab data sources
     *
     * @SerializedName("yab")
     * @Type("array<Zimbra\Account\Struct\AccountYabDataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "yab")
     *
     * @return array
     */
    public function getYabDataSources(): array
    {
        return array_filter($this->dataSources, static fn($yab) => $yab instanceof AccountYabDataSource);
    }

    /**
     * Gets rss data sources
     *
     * @SerializedName("rss")
     * @Type("array<Zimbra\Account\Struct\AccountRssDataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "rss")
     *
     * @return array
     */
    public function getRssDataSources(): array
    {
        return array_filter($this->dataSources, static fn($rss) => $rss instanceof AccountRssDataSource);
    }

    /**
     * Gets gal data sources
     *
     * @SerializedName("gal")
     * @Type("array<Zimbra\Account\Struct\AccountGalDataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "gal")
     *
     * @return array
     */
    public function getGalDataSources(): array
    {
        return array_filter($this->dataSources, static fn($gal) => $gal instanceof AccountGalDataSource);
    }

    /**
     * Gets cal data sources
     *
     * @SerializedName("cal")
     * @Type("array<Zimbra\Account\Struct\AccountCalDataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "cal")
     *
     * @return array
     */
    public function getCalDataSources(): array
    {
        return array_filter($this->dataSources, static fn($cal) => $cal instanceof AccountCalDataSource);
    }

    /**
     * Gets unknown data sources
     *
     * @SerializedName("unknown")
     * @Type("array<Zimbra\Account\Struct\AccountUnknownDataSource>")
     * @VirtualProperty
     * @XmlList(inline = true, entry = "unknown")
     *
     * @return array
     */
    public function getUnknownDataSources(): array
    {
        return array_filter($this->dataSources, static fn($unknown) => $unknown instanceof AccountUnknownDataSource);
    }

    /**
     * Add dataSource
     *
     * @param  AccountDataSource $dataSource
     * @return self
     */
    public function addDataSource(AccountDataSource $dataSource): self
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
        $this->dataSources = array_filter($dataSources, static fn($source) => $source instanceof AccountDataSource);
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
            'imap' => AccountImapDataSource::class,
            'pop3' => AccountPop3DataSource::class,
            'caldav' => AccountCaldavDataSource::class,
            'yab' => AccountYabDataSource::class,
            'rss' => AccountRssDataSource::class,
            'gal' => AccountGalDataSource::class,
            'cal' => AccountCalDataSource::class,
            'unknown' => AccountUnknownDataSource::class,
        ];
    }
}
