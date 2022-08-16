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
use Zimbra\Mail\Struct\TestDataSource;
use Zimbra\Common\Struct\SoapResponse;

/**
 * TestDataSourceResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TestDataSourceResponse extends SoapResponse
{
    /**
     * Imap data sources
     * 
     * @Accessor(getter="getImapDataSources", setter="setImapDataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="imap", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getImapDataSources', setter: 'setImapDataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'imap', namespace: 'urn:zimbraMail')]
    private $imapDataSources = [];

    /**
     * Pop3 data sources
     * 
     * @Accessor(getter="getPop3DataSources", setter="setPop3DataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="pop3", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getPop3DataSources', setter: 'setPop3DataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'pop3', namespace: 'urn:zimbraMail')]
    private $pop3DataSources = [];

    /**
     * Caldav data sources
     * 
     * @Accessor(getter="getCaldavDataSources", setter="setCaldavDataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="caldav", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCaldavDataSources', setter: 'setCaldavDataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'caldav', namespace: 'urn:zimbraMail')]
    private $caldavDataSources = [];

    /**
     * Yab data sources
     * 
     * @Accessor(getter="getYabDataSources", setter="setYabDataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="yab", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getYabDataSources', setter: 'setYabDataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'yab', namespace: 'urn:zimbraMail')]
    private $yabDataSources = [];

    /**
     * Rss data sources
     * 
     * @Accessor(getter="getRssDataSources", setter="setRssDataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="rss", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getRssDataSources', setter: 'setRssDataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'rss', namespace: 'urn:zimbraMail')]
    private $rssDataSources = [];

    /**
     * Gal data sources
     * 
     * @Accessor(getter="getGalDataSources", setter="setGalDataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="gal", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getGalDataSources', setter: 'setGalDataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'gal', namespace: 'urn:zimbraMail')]
    private $galDataSources = [];

    /**
     * Cal data sources
     * 
     * @Accessor(getter="getCalDataSources", setter="setCalDataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="cal", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCalDataSources', setter: 'setCalDataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'cal', namespace: 'urn:zimbraMail')]
    private $calDataSources = [];

    /**
     * Unknown data sources
     * 
     * @Accessor(getter="getUnknownDataSources", setter="setUnknownDataSources")
     * @Type("array<Zimbra\Mail\Struct\TestDataSource>")
     * @XmlList(inline=true, entry="unknown", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getUnknownDataSources', setter: 'setUnknownDataSources')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TestDataSource>')]
    #[XmlList(inline: true, entry: 'unknown', namespace: 'urn:zimbraMail')]
    private $unknownDataSources = [];

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
     * @return self
     */
    public function setImapDataSources(array $dataSources): self
    {
        $this->imapDataSources = array_values(
            array_filter($dataSources, static fn ($imap) => $imap instanceof TestDataSource)
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
     * @return self
     */
    public function setPop3DataSources(array $dataSources): self
    {
        $this->pop3DataSources = array_values(
            array_filter($dataSources, static fn ($pop3) => $pop3 instanceof TestDataSource)
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
     * @return self
     */
    public function setCaldavDataSources(array $dataSources): self
    {
        $this->caldavDataSources = array_values(
            array_filter($dataSources, static fn ($caldav) => $caldav instanceof TestDataSource)
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
     * @return self
     */
    public function setYabDataSources(array $dataSources): self
    {
        $this->yabDataSources = array_values(
            array_filter($dataSources, static fn ($yab) => $yab instanceof TestDataSource)
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
     * @return self
     */
    public function setRssDataSources(array $dataSources): self
    {
        $this->rssDataSources = array_values(
            array_filter($dataSources, static fn ($rss) => $rss instanceof TestDataSource)
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
     * @return self
     */
    public function setGalDataSources(array $dataSources): self
    {
        $this->galDataSources = array_values(
            array_filter($dataSources, static fn ($gal) => $gal instanceof TestDataSource)
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
     * @return self
     */
    public function setCalDataSources(array $dataSources): self
    {
        $this->calDataSources = array_values(
            array_filter($dataSources, static fn ($cal) => $cal instanceof TestDataSource)
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
     * @return self
     */
    public function setUnknownDataSources(array $dataSources): self
    {
        $this->unknownDataSources = array_values(
            array_filter($dataSources, static fn ($unknown) => $unknown instanceof TestDataSource)
        );
        return $this;
    }

    /**
     * Get dataSources
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
