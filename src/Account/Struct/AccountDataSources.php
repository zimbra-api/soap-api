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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * AccountDataSources struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountDataSources
{
    /**
     * Imap data sources
     * 
     * @Accessor(getter="getImapDataSources", setter="setImapDataSources")
     * @Type("array<Zimbra\Account\Struct\AccountImapDataSource>")
     * @XmlList(inline=true, entry="imap", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getImapDataSources', setter: 'setImapDataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountImapDataSource>')]
    #[XmlList(inline: true, entry: 'imap', namespace: 'urn:zimbraAccount')]
    private $imapDataSources = [];

    /**
     * Pop3 data sources
     * 
     * @Accessor(getter="getPop3DataSources", setter="setPop3DataSources")
     * @Type("array<Zimbra\Account\Struct\AccountPop3DataSource>")
     * @XmlList(inline=true, entry="pop3", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getPop3DataSources', setter: 'setPop3DataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountPop3DataSource>')]
    #[XmlList(inline: true, entry: 'pop3', namespace: 'urn:zimbraAccount')]
    private $pop3DataSources = [];

    /**
     * Caldav data sources
     * 
     * @Accessor(getter="getCaldavDataSources", setter="setCaldavDataSources")
     * @Type("array<Zimbra\Account\Struct\AccountCaldavDataSource>")
     * @XmlList(inline=true, entry="caldav", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCaldavDataSources', setter: 'setCaldavDataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountCaldavDataSource>')]
    #[XmlList(inline: true, entry: 'caldav', namespace: 'urn:zimbraAccount')]
    private $caldavDataSources = [];

    /**
     * Yab data sources
     * 
     * @Accessor(getter="getYabDataSources", setter="setYabDataSources")
     * @Type("array<Zimbra\Account\Struct\AccountYabDataSource>")
     * @XmlList(inline=true, entry="yab", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getYabDataSources', setter: 'setYabDataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountYabDataSource>')]
    #[XmlList(inline: true, entry: 'yab', namespace: 'urn:zimbraAccount')]
    private $yabDataSources = [];

    /**
     * Rss data sources
     * 
     * @Accessor(getter="getRssDataSources", setter="setRssDataSources")
     * @Type("array<Zimbra\Account\Struct\AccountRssDataSource>")
     * @XmlList(inline=true, entry="rss", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getRssDataSources', setter: 'setRssDataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountRssDataSource>')]
    #[XmlList(inline: true, entry: 'rss', namespace: 'urn:zimbraAccount')]
    private $rssDataSources = [];

    /**
     * Gal data sources
     * 
     * @Accessor(getter="getGalDataSources", setter="setGalDataSources")
     * @Type("array<Zimbra\Account\Struct\AccountGalDataSource>")
     * @XmlList(inline=true, entry="gal", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getGalDataSources', setter: 'setGalDataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountGalDataSource>')]
    #[XmlList(inline: true, entry: 'gal', namespace: 'urn:zimbraAccount')]
    private $galDataSources = [];

    /**
     * Cal data sources
     * 
     * @Accessor(getter="getCalDataSources", setter="setCalDataSources")
     * @Type("array<Zimbra\Account\Struct\AccountCalDataSource>")
     * @XmlList(inline=true, entry="cal", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCalDataSources', setter: 'setCalDataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountCalDataSource>')]
    #[XmlList(inline: true, entry: 'cal', namespace: 'urn:zimbraAccount')]
    private $calDataSources = [];

    /**
     * Unknown data sources
     * 
     * @Accessor(getter="getUnknownDataSources", setter="setUnknownDataSources")
     * @Type("array<Zimbra\Account\Struct\AccountUnknownDataSource>")
     * @XmlList(inline=true, entry="unknown", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getUnknownDataSources', setter: 'setUnknownDataSources')]
    #[Type(name: 'array<Zimbra\Account\Struct\AccountUnknownDataSource>')]
    #[XmlList(inline: true, entry: 'unknown', namespace: 'urn:zimbraAccount')]
    private $unknownDataSources = [];

    /**
     * Constructor
     * 
     * @param  array $dataSources
     * @return self
     */
    public function __construct(array $dataSources = [])
    {
        $this->setDataSources($dataSources);
    }

    /**
     * Get imap data sources
     *
     * @return array
     */
    public function getImapDataSources(): array
    {
        return $this->imapDataSources;
    }

    /**
     * Set imap data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setImapDataSources(array $dataSources): self
    {
        $this->imapDataSources = array_values(
            array_filter($dataSources, static fn ($imap) => $imap instanceof AccountImapDataSource)
        );
        return $this;
    }

    /**
     * Get pop3 data sources
     *
     * @return array
     */
    public function getPop3DataSources(): array
    {
        return $this->pop3DataSources;
    }

    /**
     * Set pop3 data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setPop3DataSources(array $dataSources): self
    {
        $this->pop3DataSources = array_values(
            array_filter($dataSources, static fn ($pop3) => $pop3 instanceof AccountPop3DataSource)
        );
        return $this;
    }

    /**
     * Get caldav data sources
     *
     * @return array
     */
    public function getCaldavDataSources(): array
    {
        return $this->caldavDataSources;
    }

    /**
     * Set caldav data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setCaldavDataSources(array $dataSources): self
    {
        $this->caldavDataSources = array_values(
            array_filter($dataSources, static fn ($caldav) => $caldav instanceof AccountCaldavDataSource)
        );
        return $this;
    }

    /**
     * Get yab data sources
     *
     * @return array
     */
    public function getYabDataSources(): array
    {
        return $this->yabDataSources;
    }

    /**
     * Set yab data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setYabDataSources(array $dataSources): self
    {
        $this->yabDataSources = array_values(
            array_filter($dataSources, static fn ($yab) => $yab instanceof AccountYabDataSource)
        );
        return $this;
    }

    /**
     * Get rss data sources
     *
     * @return array
     */
    public function getRssDataSources(): array
    {
        return $this->rssDataSources;
    }

    /**
     * Set rss data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setRssDataSources(array $dataSources): self
    {
        $this->rssDataSources = array_values(
            array_filter($dataSources, static fn ($rss) => $rss instanceof AccountRssDataSource)
        );
        return $this;
    }

    /**
     * Get gal data sources
     *
     * @return array
     */
    public function getGalDataSources(): array
    {
        return $this->galDataSources;
    }

    /**
     * Set gal data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setGalDataSources(array $dataSources): self
    {
        $this->galDataSources = array_values(
            array_filter($dataSources, static fn ($gal) => $gal instanceof AccountGalDataSource)
        );
        return $this;
    }

    /**
     * Get cal data sources
     *
     * @return array
     */
    public function getCalDataSources(): array
    {
        return $this->calDataSources;
    }

    /**
     * Set cal data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setCalDataSources(array $dataSources): self
    {
        $this->calDataSources = array_values(
            array_filter($dataSources, static fn ($cal) => $cal instanceof AccountCalDataSource)
        );
        return $this;
    }

    /**
     * Get unknown data sources
     *
     * @return array
     */
    public function getUnknownDataSources(): array
    {
        return $this->unknownDataSources;
    }

    /**
     * Set unknown data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setUnknownDataSources(array $dataSources): self
    {
        $this->unknownDataSources = array_values(
            array_filter($dataSources, static fn ($unknown) => $unknown instanceof AccountUnknownDataSource)
        );
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
        $this->setImapDataSources($dataSources)
             ->setPop3DataSources($dataSources)
             ->setCaldavDataSources($dataSources)
             ->setYabDataSources($dataSources)
             ->setRssDataSources($dataSources)
             ->setGalDataSources($dataSources)
             ->setCalDataSources($dataSources)
             ->setUnknownDataSources($dataSources);
        return $this;
    }

    /**
     * Get data sources
     *
     * @return array
     */
    public function getDataSources(): array
    {
        return array_merge(
            $this->imapDataSources,
            $this->pop3DataSources,
            $this->caldavDataSources,
            $this->yabDataSources,
            $this->rssDataSources,
            $this->galDataSources,
            $this->calDataSources,
            $this->unknownDataSources
        );
    }
}
