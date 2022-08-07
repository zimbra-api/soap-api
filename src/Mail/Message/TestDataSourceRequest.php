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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * TestDataSourceRequest class
 * Tests the connection to the specified data source.  Does not modify the data source or
 * import data.  If the id is specified, uses an existing data source.  Any values specified in the request are used
 * in the test instead of the saved values.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TestDataSourceRequest extends SoapRequest
{
    /**
     * Imap data source
     * 
     * @Accessor(getter="getImapDataSource", setter="setDataSource")
     * @SerializedName("imap")
     * @Type("Zimbra\Mail\Struct\MailImapDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailImapDataSource $imapDataSource = NULL;

    /**
     * Pop3 data source
     * 
     * @Accessor(getter="getPop3DataSource", setter="setDataSource")
     * @SerializedName("pop3")
     * @Type("Zimbra\Mail\Struct\MailPop3DataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailPop3DataSource $pop3DataSource = NULL;

    /**
     * Caldav data source
     * 
     * @Accessor(getter="getCaldavDataSource", setter="setDataSource")
     * @SerializedName("caldav")
     * @Type("Zimbra\Mail\Struct\MailCaldavDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailCaldavDataSource $caldavDataSource = NULL;

    /**
     * Yab data source
     * 
     * @Accessor(getter="getYabDataSource", setter="setDataSource")
     * @SerializedName("yab")
     * @Type("Zimbra\Mail\Struct\MailYabDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailYabDataSource $yabDataSource = NULL;

    /**
     * Rss data source
     * 
     * @Accessor(getter="getRssDataSource", setter="setDataSource")
     * @SerializedName("rss")
     * @Type("Zimbra\Mail\Struct\MailRssDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailRssDataSource $rssDataSource = NULL;

    /**
     * Gal data source
     * 
     * @Accessor(getter="getGalDataSource", setter="setDataSource")
     * @SerializedName("gal")
     * @Type("Zimbra\Mail\Struct\MailGalDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailGalDataSource $galDataSource = NULL;

    /**
     * Cal data source
     * 
     * @Accessor(getter="getCalDataSource", setter="setDataSource")
     * @SerializedName("cal")
     * @Type("Zimbra\Mail\Struct\MailCalDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailCalDataSource $calDataSource = NULL;

    /**
     * Unknown data source
     * 
     * @Accessor(getter="getUnknownDataSource", setter="setDataSource")
     * @SerializedName("unknown")
     * @Type("Zimbra\Mail\Struct\MailUnknownDataSource")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailUnknownDataSource $unknownDataSource = NULL;

    /**
     * Constructor
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function __construct(?MailDataSource $dataSource = NULL)
    {
        if ($dataSource instanceof MailDataSource) {
            $this->setDataSource($dataSource);
        }
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
     * Get pop3 data source
     * 
     * @return MailPop3DataSource
     */
    public function getPop3DataSource(): ?MailPop3DataSource
    {
        return $this->pop3DataSource;
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
     * Get yab data source
     * 
     * @return MailYabDataSource
     */
    public function getYabDataSource(): ?MailYabDataSource
    {
        return $this->yabDataSource;
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
     * Get gal data source
     * 
     * @return MailGalDataSource
     */
    public function getGalDataSource(): ?MailGalDataSource
    {
        return $this->galDataSource;
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
     * Get unknown data source
     * 
     * @return MailUnknownDataSource
     */
    public function getUnknownDataSource(): ?MailUnknownDataSource
    {
        return $this->unknownDataSource;
    }

    /**
     * Set dataSource
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function setDataSource(MailDataSource $dataSource): self
    {
        $this->imapDataSource =
        $this->pop3DataSource =
        $this->caldavDataSource =
        $this->yabDataSource =
        $this->rssDataSource =
        $this->galDataSource =
        $this->calDataSource =
        $this->unknownDataSource = NULL;
        if ($dataSource instanceof MailImapDataSource) {
            $this->imapDataSource = $dataSource;
        }
        if ($dataSource instanceof MailPop3DataSource) {
            $this->pop3DataSource = $dataSource;
        }
        if ($dataSource instanceof MailCaldavDataSource) {
            $this->caldavDataSource = $dataSource;
        }
        if ($dataSource instanceof MailYabDataSource) {
            $this->yabDataSource = $dataSource;
        }
        if ($dataSource instanceof MailRssDataSource) {
            $this->rssDataSource = $dataSource;
        }
        if ($dataSource instanceof MailGalDataSource) {
            $this->galDataSource = $dataSource;
        }
        if ($dataSource instanceof MailCalDataSource) {
            $this->calDataSource = $dataSource;
        }
        if ($dataSource instanceof MailUnknownDataSource) {
            $this->unknownDataSource = $dataSource;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new TestDataSourceEnvelope(
            new TestDataSourceBody($this)
        );
    }
}
