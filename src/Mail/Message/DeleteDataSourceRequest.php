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
use Zimbra\Mail\Struct\CalDataSourceNameOrId;
use Zimbra\Mail\Struct\CaldavDataSourceNameOrId;
use Zimbra\Mail\Struct\DataSourceNameOrId;
use Zimbra\Mail\Struct\GalDataSourceNameOrId;
use Zimbra\Mail\Struct\ImapDataSourceNameOrId;
use Zimbra\Mail\Struct\Pop3DataSourceNameOrId;
use Zimbra\Mail\Struct\RssDataSourceNameOrId;
use Zimbra\Mail\Struct\UnknownDataSourceNameOrId;
use Zimbra\Mail\Struct\YabDataSourceNameOrId;
use Zimbra\Common\Soap\{SoapEnvelopeInterface, SoapRequest};

/**
 * DeleteDataSourceRequest class
 * Deletes the given data sources.
 * The name or id of each data source must be specified.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteDataSourceRequest extends SoapRequest
{
    /**
     * Imap data sources
     * 
     * @Accessor(getter="getImapDataSources", setter="setImapDataSources")
     * @Type("array<Zimbra\Mail\Struct\ImapDataSourceNameOrId>")
     * @XmlList(inline=true, entry="imap", namespace="urn:zimbraMail")
     */
    private $imapDataSources = [];

    /**
     * Pop3 data sources
     * 
     * @Accessor(getter="getPop3DataSources", setter="setPop3DataSources")
     * @Type("array<Zimbra\Mail\Struct\Pop3DataSourceNameOrId>")
     * @XmlList(inline=true, entry="pop3", namespace="urn:zimbraMail")
     */
    private $pop3DataSources = [];

    /**
     * Caldav data sources
     * 
     * @Accessor(getter="getCaldavDataSources", setter="setCaldavDataSources")
     * @Type("array<Zimbra\Mail\Struct\CaldavDataSourceNameOrId>")
     * @XmlList(inline=true, entry="caldav", namespace="urn:zimbraMail")
     */
    private $caldavDataSources = [];

    /**
     * Yab data sources
     * 
     * @Accessor(getter="getYabDataSources", setter="setYabDataSources")
     * @Type("array<Zimbra\Mail\Struct\YabDataSourceNameOrId>")
     * @XmlList(inline=true, entry="yab", namespace="urn:zimbraMail")
     */
    private $yabDataSources = [];

    /**
     * Rss data sources
     * 
     * @Accessor(getter="getRssDataSources", setter="setRssDataSources")
     * @Type("array<Zimbra\Mail\Struct\RssDataSourceNameOrId>")
     * @XmlList(inline=true, entry="rss", namespace="urn:zimbraMail")
     */
    private $rssDataSources = [];

    /**
     * Gal data sources
     * 
     * @Accessor(getter="getGalDataSources", setter="setGalDataSources")
     * @Type("array<Zimbra\Mail\Struct\GalDataSourceNameOrId>")
     * @XmlList(inline=true, entry="gal", namespace="urn:zimbraMail")
     */
    private $galDataSources = [];

    /**
     * Cal data sources
     * 
     * @Accessor(getter="getCalDataSources", setter="setCalDataSources")
     * @Type("array<Zimbra\Mail\Struct\CalDataSourceNameOrId>")
     * @XmlList(inline=true, entry="cal", namespace="urn:zimbraMail")
     */
    private $calDataSources = [];

    /**
     * Unknown data sources
     * 
     * @Accessor(getter="getUnknownDataSources", setter="setUnknownDataSources")
     * @Type("array<Zimbra\Mail\Struct\UnknownDataSourceNameOrId>")
     * @XmlList(inline=true, entry="unknown", namespace="urn:zimbraMail")
     */
    private $unknownDataSources = [];

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
     * @return array
     */
    public function getImapDataSources(): array
    {
        return $this->imapDataSources;
    }

    /**
     * Sets imap data sources
     *
     * @return self
     */
    public function setImapDataSources(array $dataSources): self
    {
        $this->imapDataSources = array_values(
            array_filter($dataSources, static fn ($imap) => $imap instanceof ImapDataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Gets pop3 data sources
     *
     * @return array
     */
    public function getPop3DataSources(): array
    {
        return $this->pop3DataSources;
    }

    /**
     * Sets pop3 data sources
     *
     * @return self
     */
    public function setPop3DataSources(array $dataSources): self
    {
        $this->pop3DataSources = array_values(
            array_filter($dataSources, static fn ($pop3) => $pop3 instanceof Pop3DataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Gets caldav data sources
     *
     * @return array
     */
    public function getCaldavDataSources(): array
    {
        return $this->caldavDataSources;
    }

    /**
     * Sets caldav data sources
     *
     * @return self
     */
    public function setCaldavDataSources(array $dataSources): self
    {
        $this->caldavDataSources = array_values(
            array_filter($dataSources, static fn ($caldav) => $caldav instanceof CaldavDataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Gets yab data sources
     *
     * @return array
     */
    public function getYabDataSources(): array
    {
        return $this->yabDataSources;
    }

    /**
     * Sets yab data sources
     *
     * @return self
     */
    public function setYabDataSources(array $dataSources): self
    {
        $this->yabDataSources = array_values(
            array_filter($dataSources, static fn ($yab) => $yab instanceof YabDataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Gets rss data sources
     *
     * @return array
     */
    public function getRssDataSources(): array
    {
        return $this->rssDataSources;
    }

    /**
     * Sets rss data sources
     *
     * @return self
     */
    public function setRssDataSources(array $dataSources): self
    {
        $this->rssDataSources = array_values(
            array_filter($dataSources, static fn ($rss) => $rss instanceof RssDataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Gets gal data sources
     *
     * @return array
     */
    public function getGalDataSources(): array
    {
        return $this->galDataSources;
    }

    /**
     * Sets gal data sources
     *
     * @return self
     */
    public function setGalDataSources(array $dataSources): self
    {
        $this->galDataSources = array_values(
            array_filter($dataSources, static fn ($gal) => $gal instanceof GalDataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Gets cal data sources
     *
     * @return array
     */
    public function getCalDataSources(): array
    {
        return $this->calDataSources;
    }

    /**
     * Sets cal data sources
     *
     * @return self
     */
    public function setCalDataSources(array $dataSources): self
    {
        $this->calDataSources = array_values(
            array_filter($dataSources, static fn ($cal) => $cal instanceof CalDataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Gets unknown data sources
     *
     * @return array
     */
    public function getUnknownDataSources(): array
    {
        return $this->unknownDataSources;
    }

    /**
     * Sets unknown data sources
     *
     * @return self
     */
    public function setUnknownDataSources(array $dataSources): self
    {
        $this->unknownDataSources = array_values(
            array_filter($dataSources, static fn ($unknown) => $unknown instanceof UnknownDataSourceNameOrId)
        );
        return $this;
    }

    /**
     * Add data source
     *
     * @param  DataSourceNameOrId $dataSource
     * @return self
     */
    public function addDataSource(DataSourceNameOrId $dataSource): self
    {
        if ($dataSource instanceof ImapDataSourceNameOrId) {
            $this->imapDataSources[] = $dataSource;
        }
        if ($dataSource instanceof Pop3DataSourceNameOrId) {
            $this->pop3DataSources[] = $dataSource;
        }
        if ($dataSource instanceof CaldavDataSourceNameOrId) {
            $this->caldavDataSources[] = $dataSource;
        }
        if ($dataSource instanceof YabDataSourceNameOrId) {
            $this->yabDataSources[] = $dataSource;
        }
        if ($dataSource instanceof RssDataSourceNameOrId) {
            $this->rssDataSources[] = $dataSource;
        }
        if ($dataSource instanceof GalDataSourceNameOrId) {
            $this->galDataSources[] = $dataSource;
        }
        if ($dataSource instanceof CalDataSourceNameOrId) {
            $this->calDataSources[] = $dataSource;
        }
        if ($dataSource instanceof UnknownDataSourceNameOrId) {
            $this->unknownDataSources[] = $dataSource;
        }
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
     * Gets dataSources
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

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DeleteDataSourceEnvelope(
            new DeleteDataSourceBody($this)
        );
    }
}
