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
use Zimbra\Common\Soap\ResponseInterface;

/**
 * CreateDataSourceResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateDataSourceResponse implements ResponseInterface
{
    /**
     * Imap data source
     * 
     * @Accessor(getter="getImapDataSource", setter="setDataSource")
     * @SerializedName("imap")
     * @Type("Zimbra\Mail\Struct\ImapDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ImapDataSourceId $imapDataSource = NULL;

    /**
     * Pop3 data source
     * 
     * @Accessor(getter="getPop3DataSource", setter="setDataSource")
     * @SerializedName("pop3")
     * @Type("Zimbra\Mail\Struct\Pop3DataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?Pop3DataSourceId $pop3DataSource = NULL;

    /**
     * Caldav data source
     * 
     * @Accessor(getter="getCaldavDataSource", setter="setDataSource")
     * @SerializedName("caldav")
     * @Type("Zimbra\Mail\Struct\CaldavDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CaldavDataSourceId $caldavDataSource = NULL;

    /**
     * Yab data source
     * 
     * @Accessor(getter="getYabDataSource", setter="setDataSource")
     * @SerializedName("yab")
     * @Type("Zimbra\Mail\Struct\YabDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?YabDataSourceId $yabDataSource = NULL;

    /**
     * Rss data source
     * 
     * @Accessor(getter="getRssDataSource", setter="setDataSource")
     * @SerializedName("rss")
     * @Type("Zimbra\Mail\Struct\RssDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?RssDataSourceId $rssDataSource = NULL;

    /**
     * Gal data source
     * 
     * @Accessor(getter="getGalDataSource", setter="setDataSource")
     * @SerializedName("gal")
     * @Type("Zimbra\Mail\Struct\GalDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?GalDataSourceId $galDataSource = NULL;

    /**
     * Cal data source
     * 
     * @Accessor(getter="getCalDataSource", setter="setDataSource")
     * @SerializedName("cal")
     * @Type("Zimbra\Mail\Struct\CalDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?CalDataSourceId $calDataSource = NULL;

    /**
     * Unknown data source
     * 
     * @Accessor(getter="getUnknownDataSource", setter="setDataSource")
     * @SerializedName("unknown")
     * @Type("Zimbra\Mail\Struct\UnknownDataSourceId")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?UnknownDataSourceId $unknownDataSource = NULL;

    /**
     * Constructor method for CreateDataSourceResponse
     *
     * @param  DataSourceInfo $dataSource
     * @return self
     */
    public function __construct(?Id $dataSource = NULL)
    {
        if ($dataSource instanceof Id) {
            $this->setDataSource($dataSource);
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
     * Get pop3 data source
     * 
     * @return Pop3DataSourceId
     */
    public function getPop3DataSource(): ?Pop3DataSourceId
    {
        return $this->pop3DataSource;
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
     * Get yab data source
     * 
     * @return YabDataSourceId
     */
    public function getYabDataSource(): ?YabDataSourceId
    {
        return $this->yabDataSource;
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
     * Get gal data source
     * 
     * @return GalDataSourceId
     */
    public function getGalDataSource(): ?GalDataSourceId
    {
        return $this->galDataSource;
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
     * Get unknown data source
     * 
     * @return UnknownDataSourceId
     */
    public function getUnknownDataSource(): ?UnknownDataSourceId
    {
        return $this->unknownDataSource;
    }

    /**
     * Sets dataSource
     *
     * @param  Id $dataSource
     * @return self
     */
    public function setDataSource(Id $dataSource): self
    {
        $this->imapDataSource =
        $this->pop3DataSource =
        $this->caldavDataSource =
        $this->yabDataSource =
        $this->rssDataSource =
        $this->galDataSource =
        $this->calDataSource =
        $this->unknownDataSource = NULL;
        if ($dataSource instanceof ImapDataSourceId) {
            $this->imapDataSource = $dataSource;
        }
        if ($dataSource instanceof Pop3DataSourceId) {
            $this->pop3DataSource = $dataSource;
        }
        if ($dataSource instanceof CaldavDataSourceId) {
            $this->caldavDataSource = $dataSource;
        }
        if ($dataSource instanceof YabDataSourceId) {
            $this->yabDataSource = $dataSource;
        }
        if ($dataSource instanceof RssDataSourceId) {
            $this->rssDataSource = $dataSource;
        }
        if ($dataSource instanceof GalDataSourceId) {
            $this->galDataSource = $dataSource;
        }
        if ($dataSource instanceof CalDataSourceId) {
            $this->calDataSource = $dataSource;
        }
        if ($dataSource instanceof UnknownDataSourceId) {
            $this->unknownDataSource = $dataSource;
        }
        return $this;
    }
}
