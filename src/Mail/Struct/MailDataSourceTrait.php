<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * MailDataSource trait
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
trait MailDataSourceTrait
{
    /**
     * Imap data source
     * 
     * @Accessor(getter="getImapDataSource", setter="setDataSource")
     * @SerializedName("imap")
     * @Type("Zimbra\Mail\Struct\MailImapDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailImapDataSource
     */
    private $imapDataSource;

    /**
     * Pop3 data source
     * 
     * @Accessor(getter="getPop3DataSource", setter="setDataSource")
     * @SerializedName("pop3")
     * @Type("Zimbra\Mail\Struct\MailPop3DataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailPop3DataSource
     */
    private $pop3DataSource;

    /**
     * Caldav data source
     * 
     * @Accessor(getter="getCaldavDataSource", setter="setDataSource")
     * @SerializedName("caldav")
     * @Type("Zimbra\Mail\Struct\MailCaldavDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailCaldavDataSource
     */
    private $caldavDataSource;

    /**
     * Yab data source
     * 
     * @Accessor(getter="getYabDataSource", setter="setDataSource")
     * @SerializedName("yab")
     * @Type("Zimbra\Mail\Struct\MailYabDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailYabDataSource
     */
    private $yabDataSource;

    /**
     * Rss data source
     * 
     * @Accessor(getter="getRssDataSource", setter="setDataSource")
     * @SerializedName("rss")
     * @Type("Zimbra\Mail\Struct\MailRssDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailRssDataSource
     */
    private $rssDataSource;

    /**
     * Gal data source
     * 
     * @Accessor(getter="getGalDataSource", setter="setDataSource")
     * @SerializedName("gal")
     * @Type("Zimbra\Mail\Struct\MailGalDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailGalDataSource
     */
    private $galDataSource;

    /**
     * Cal data source
     * 
     * @Accessor(getter="getCalDataSource", setter="setDataSource")
     * @SerializedName("cal")
     * @Type("Zimbra\Mail\Struct\MailCalDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailCalDataSource
     */
    private $calDataSource;

    /**
     * Unknown data source
     * 
     * @Accessor(getter="getUnknownDataSource", setter="setDataSource")
     * @SerializedName("unknown")
     * @Type("Zimbra\Mail\Struct\MailUnknownDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var MailUnknownDataSource
     */
    private $unknownDataSource;

    /**
     * Set dataSource
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function setDataSource(MailDataSource $dataSource): self
    {
        if ($dataSource instanceof MailImapDataSource) {
            return $this->setImapDataSource($dataSource);
        }
        if ($dataSource instanceof MailPop3DataSource) {
            return $this->setPop3DataSource($dataSource);
        }
        if ($dataSource instanceof MailCaldavDataSource) {
            return $this->setCaldavDataSource($dataSource);
        }
        if ($dataSource instanceof MailYabDataSource) {
            return $this->setYabDataSource($dataSource);
        }
        if ($dataSource instanceof MailRssDataSource) {
            return $this->setRssDataSource($dataSource);
        }
        if ($dataSource instanceof MailGalDataSource) {
            return $this->setGalDataSource($dataSource);
        }
        if ($dataSource instanceof MailCalDataSource) {
            return $this->setCalDataSource($dataSource);
        }
        if ($dataSource instanceof MailUnknownDataSource) {
             return $this->setUnknownDataSource($dataSource);
        }
        return $this;
    }

    /**
     * Get imap data source
     * 
     * @return MailImapDataSource
     */
    public function getImapDataSource(): ?MailImapDataSource
    {
        return $this->imapDataSource;
    }

    /**
     * Set imap data source
     *
     * @param  MailImapDataSource $dataSource
     * @return self
     */
    public function setImapDataSource(MailImapDataSource $dataSource): self
    {
        $this->imapDataSource = $dataSource;
        return $this;
    }

    /**
     * Get pop3 data source
     * 
     * @return MailPop3DataSource
     */
    public function getPop3DataSource(): ?MailPop3DataSource
    {
        return $this->pop3DataSource;
    }

    /**
     * Set pop3 data source
     *
     * @param  MailPop3DataSource $dataSource
     * @return self
     */
    public function setPop3DataSource(MailPop3DataSource $dataSource): self
    {
        $this->pop3DataSource = $dataSource;
        return $this;
    }

    /**
     * Get caldav data source
     * 
     * @return MailCaldavDataSource
     */
    public function getCaldavDataSource(): ?MailCaldavDataSource
    {
        return $this->caldavDataSource;
    }

    /**
     * Set caldav data source
     *
     * @param  MailCaldavDataSource $dataSource
     * @return self
     */
    public function setCaldavDataSource(MailCaldavDataSource $dataSource): self
    {
        $this->caldavDataSource = $dataSource;
        return $this;
    }

    /**
     * Get yab data source
     * 
     * @return MailYabDataSource
     */
    public function getYabDataSource(): ?MailYabDataSource
    {
        return $this->yabDataSource;
    }

    /**
     * Set yab data source
     *
     * @param  MailYabDataSource $dataSource
     * @return self
     */
    public function setYabDataSource(MailYabDataSource $dataSource): self
    {
        $this->yabDataSource = $dataSource;
        return $this;
    }

    /**
     * Get rss data source
     * 
     * @return MailRssDataSource
     */
    public function getRssDataSource(): ?MailRssDataSource
    {
        return $this->rssDataSource;
    }

    /**
     * Set rss data source
     *
     * @param  MailRssDataSource $dataSource
     * @return self
     */
    public function setRssDataSource(MailRssDataSource $dataSource): self
    {
        $this->rssDataSource = $dataSource;
        return $this;
    }

    /**
     * Get gal data source
     * 
     * @return MailGalDataSource
     */
    public function getGalDataSource(): ?MailGalDataSource
    {
        return $this->galDataSource;
    }

    /**
     * Set gal data source
     *
     * @param  MailGalDataSource $dataSource
     * @return self
     */
    public function setGalDataSource(MailGalDataSource $dataSource): self
    {
        $this->galDataSource = $dataSource;
        return $this;
    }

    /**
     * Get cal data source
     * 
     * @return MailCalDataSource
     */
    public function getCalDataSource(): ?MailCalDataSource
    {
        return $this->calDataSource;
    }

    /**
     * Set cal data source
     *
     * @param  MailCalDataSource $dataSource
     * @return self
     */
    public function setCalDataSource(MailCalDataSource $dataSource): self
    {
        $this->calDataSource = $dataSource;
        return $this;
    }

    /**
     * Get unknown data source
     * 
     * @return MailUnknownDataSource
     */
    public function getUnknownDataSource(): ?MailUnknownDataSource
    {
        return $this->unknownDataSource;
    }

    /**
     * Set unknown data source
     *
     * @param  MailUnknownDataSource $dataSource
     * @return self
     */
    public function setUnknownDataSource(MailUnknownDataSource $dataSource): self
    {
        $this->unknownDataSource = $dataSource;
        return $this;
    }
}