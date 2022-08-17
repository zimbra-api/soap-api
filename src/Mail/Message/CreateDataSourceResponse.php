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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\Id;
use Zimbra\Mail\Struct\{
    ImapDataSourceId,
    Pop3DataSourceId,
    CaldavDataSourceId,
    YabDataSourceId,
    RssDataSourceId,
    GalDataSourceId,
    CalDataSourceId,
    UnknownDataSourceId
};
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateDataSourceResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateDataSourceResponse extends SoapResponse
{
    /**
     * Imap data source
     * 
     * @Accessor(getter="getImapDataSource", setter="setImapDataSource")
     * @SerializedName("imap")
     * @Type("Zimbra\Mail\Struct\ImapDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ImapDataSourceId
     */
    #[Accessor(getter: "getImapDataSource", setter: "setImapDataSource")]
    #[SerializedName(name: 'imap')]
    #[Type(name: ImapDataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $imapDataSource;

    /**
     * Pop3 data source
     * 
     * @Accessor(getter="getPop3DataSource", setter="setPop3DataSource")
     * @SerializedName("pop3")
     * @Type("Zimbra\Mail\Struct\Pop3DataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Pop3DataSourceId
     */
    #[Accessor(getter: "getPop3DataSource", setter: "setPop3DataSource")]
    #[SerializedName(name: 'pop3')]
    #[Type(name: Pop3DataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $pop3DataSource;

    /**
     * Caldav data source
     * 
     * @Accessor(getter="getCaldavDataSource", setter="setCaldavDataSource")
     * @SerializedName("caldav")
     * @Type("Zimbra\Mail\Struct\CaldavDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var CaldavDataSourceId
     */
    #[Accessor(getter: "getCaldavDataSource", setter: "setCaldavDataSource")]
    #[SerializedName(name: 'caldav')]
    #[Type(name: CaldavDataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $caldavDataSource;

    /**
     * Yab data source
     * 
     * @Accessor(getter="getYabDataSource", setter="setYabDataSource")
     * @SerializedName("yab")
     * @Type("Zimbra\Mail\Struct\YabDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var YabDataSourceId
     */
    #[Accessor(getter: "getYabDataSource", setter: "setYabDataSource")]
    #[SerializedName(name: 'yab')]
    #[Type(name: YabDataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $yabDataSource;

    /**
     * Rss data source
     * 
     * @Accessor(getter="getRssDataSource", setter="setRssDataSource")
     * @SerializedName("rss")
     * @Type("Zimbra\Mail\Struct\RssDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var RssDataSourceId
     */
    #[Accessor(getter: "getRssDataSource", setter: "setRssDataSource")]
    #[SerializedName(name: 'rss')]
    #[Type(name: RssDataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $rssDataSource;

    /**
     * Gal data source
     * 
     * @Accessor(getter="getGalDataSource", setter="setGalDataSource")
     * @SerializedName("gal")
     * @Type("Zimbra\Mail\Struct\GalDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var GalDataSourceId
     */
    #[Accessor(getter: "getGalDataSource", setter: "setGalDataSource")]
    #[SerializedName(name: 'gal')]
    #[Type(name: GalDataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $galDataSource;

    /**
     * Cal data source
     * 
     * @Accessor(getter="getCalDataSource", setter="setCalDataSource")
     * @SerializedName("cal")
     * @Type("Zimbra\Mail\Struct\CalDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var CalDataSourceId
     */
    #[Accessor(getter: "getCalDataSource", setter: "setCalDataSource")]
    #[SerializedName(name: 'cal')]
    #[Type(name: CalDataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $calDataSource;

    /**
     * Unknown data source
     * 
     * @Accessor(getter="getUnknownDataSource", setter="setUnknownDataSource")
     * @SerializedName("unknown")
     * @Type("Zimbra\Mail\Struct\UnknownDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var UnknownDataSourceId
     */
    #[Accessor(getter: "getUnknownDataSource", setter: "setUnknownDataSource")]
    #[SerializedName(name: 'unknown')]
    #[Type(name: UnknownDataSourceId::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $unknownDataSource;

    /**
     * Constructor
     *
     * @param  Id $dataSource
     * @return self
     */
    public function __construct(?Id $dataSource = NULL)
    {
        if ($dataSource instanceof ImapDataSourceId) {
            $this->setImapDataSource($dataSource);
        }
        if ($dataSource instanceof Pop3DataSourceId) {
            $this->setPop3DataSource($dataSource);
        }
        if ($dataSource instanceof CaldavDataSourceId) {
            $this->setCaldavDataSource($dataSource);
        }
        if ($dataSource instanceof YabDataSourceId) {
            $this->setYabDataSource($dataSource);
        }
        if ($dataSource instanceof RssDataSourceId) {
            $this->setRssDataSource($dataSource);
        }
        if ($dataSource instanceof GalDataSourceId) {
            $this->setGalDataSource($dataSource);
        }
        if ($dataSource instanceof CalDataSourceId) {
            $this->setCalDataSource($dataSource);
        }
        if ($dataSource instanceof UnknownDataSourceId) {
            $this->setUnknownDataSource($dataSource);
        }
    }

    /**
     * Get imap data source
     * 
     * @return ImapDataSourceId
     */
    public function getImapDataSource(): ?ImapDataSourceId
    {
        return $this->imapDataSource;
    }

    /**
     * Set imap data source
     *
     * @param  ImapDataSourceId $dataSource
     * @return self
     */
    public function setImapDataSource(ImapDataSourceId $dataSource): self
    {
        $this->imapDataSource = $dataSource;
        return $this;
    }

    /**
     * Get pop3 data source
     * 
     * @return Pop3DataSourceId
     */
    public function getPop3DataSource(): ?Pop3DataSourceId
    {
        return $this->pop3DataSource;
    }

    /**
     * Set pop3 data source
     *
     * @param  Pop3DataSourceId $dataSource
     * @return self
     */
    public function setPop3DataSource(Pop3DataSourceId $dataSource): self
    {
        $this->pop3DataSource = $dataSource;
        return $this;
    }

    /**
     * Get caldav data source
     * 
     * @return CaldavDataSourceId
     */
    public function getCaldavDataSource(): ?CaldavDataSourceId
    {
        return $this->caldavDataSource;
    }

    /**
     * Set caldav data source
     *
     * @param  CaldavDataSourceId $dataSource
     * @return self
     */
    public function setCaldavDataSource(CaldavDataSourceId $dataSource): self
    {
        $this->caldavDataSource = $dataSource;
        return $this;
    }

    /**
     * Get yab data source
     * 
     * @return YabDataSourceId
     */
    public function getYabDataSource(): ?YabDataSourceId
    {
        return $this->yabDataSource;
    }

    /**
     * Set yab data source
     *
     * @param  YabDataSourceId $dataSource
     * @return self
     */
    public function setYabDataSource(YabDataSourceId $dataSource): self
    {
        $this->yabDataSource = $dataSource;
        return $this;
    }

    /**
     * Get rss data source
     * 
     * @return RssDataSourceId
     */
    public function getRssDataSource(): ?RssDataSourceId
    {
        return $this->rssDataSource;
    }

    /**
     * Set rss data source
     *
     * @param  RssDataSourceId $dataSource
     * @return self
     */
    public function setRssDataSource(RssDataSourceId $dataSource): self
    {
        $this->rssDataSource = $dataSource;
        return $this;
    }

    /**
     * Get gal data source
     * 
     * @return GalDataSourceId
     */
    public function getGalDataSource(): ?GalDataSourceId
    {
        return $this->galDataSource;
    }

    /**
     * Set gal data source
     *
     * @param  GalDataSourceId $dataSource
     * @return self
     */
    public function setGalDataSource(GalDataSourceId $dataSource): self
    {
        $this->galDataSource = $dataSource;
        return $this;
    }

    /**
     * Get cal data source
     * 
     * @return CalDataSourceId
     */
    public function getCalDataSource(): ?CalDataSourceId
    {
        return $this->calDataSource;
    }

    /**
     * Set cal data source
     *
     * @param  CalDataSourceId $dataSource
     * @return self
     */
    public function setCalDataSource(CalDataSourceId $dataSource): self
    {
        $this->calDataSource = $dataSource;
        return $this;
    }

    /**
     * Get unknown data source
     * 
     * @return UnknownDataSourceId
     */
    public function getUnknownDataSource(): ?UnknownDataSourceId
    {
        return $this->unknownDataSource;
    }

    /**
     * Set unknown data source
     *
     * @param  UnknownDataSourceId $dataSource
     * @return self
     */
    public function setUnknownDataSource(UnknownDataSourceId $dataSource): self
    {
        $this->unknownDataSource = $dataSource;
        return $this;
    }
}
