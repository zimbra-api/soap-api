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
    private $dataSources;

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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountImapDataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountPop3DataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountCaldavDataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountYabDataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountRssDataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountGalDataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountCalDataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $dataSources = [];
        foreach ($this->dataSources as $dataSource) {
            if ($dataSource instanceof AccountUnknownDataSource) {
                $dataSources[] = $dataSource;
            }
        }
        return $dataSources;
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
        $this->dataSources = $dataSources;
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
