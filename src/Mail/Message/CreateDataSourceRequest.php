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

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, VirtualProperty};
use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;
use Zimbra\Mail\Struct\MailCaldavDataSource;
use Zimbra\Mail\Struct\MailYabDataSource;
use Zimbra\Mail\Struct\MailRssDataSource;
use Zimbra\Mail\Struct\MailGalDataSource;
use Zimbra\Mail\Struct\MailCalDataSource;
use Zimbra\Mail\Struct\MailUnknownDataSource;
use Zimbra\Mail\Struct\MailDataSource;
use Zimbra\Struct\DataSource;
use Zimbra\Soap\Request;

/**
 * CreateDataSourceRequest class
 * Creates a data source that imports mail items into the specified folder, for example
 * via the POP3 or IMAP protocols.  Only one data source is allowed per request.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateDataSourceRequest extends Request
{
    /**
     * The data source
     * @Exclude
     */
    private $dataSource;

    /**
     * Constructor method for CreateDataSourceRequest
     *
     * @param  DataSource $dataSource
     * @return self
     */
    public function __construct(DataSource $dataSource = NULL)
    {
        if ($dataSource instanceof MailDataSource) {
            $this->setDataSource($dataSource);
        }
    }

    /**
     * @SerializedName("imap")
     * @Type("Zimbra\Mail\Struct\MailImapDataSource")
     * @VirtualProperty
     */
    public function getImapDataSource(): ?MailImapDataSource
    {
        return ($this->dataSource instanceof MailImapDataSource) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("pop3")
     * @Type("Zimbra\Mail\Struct\MailPop3DataSource")
     * @VirtualProperty
     */
    public function getPop3DataSource(): ?MailPop3DataSource
    {
        return ($this->dataSource instanceof MailPop3DataSource) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("caldav")
     * @Type("Zimbra\Mail\Struct\MailCaldavDataSource")
     * @VirtualProperty
     */
    public function getCaldavDataSource(): ?MailCaldavDataSource
    {
        return ($this->dataSource instanceof MailCaldavDataSource) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("yab")
     * @Type("Zimbra\Mail\Struct\MailYabDataSource")
     * @VirtualProperty
     */
    public function getYabDataSource(): ?MailYabDataSource
    {
        return ($this->dataSource instanceof MailYabDataSource) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("rss")
     * @Type("Zimbra\Mail\Struct\MailRssDataSource")
     * @VirtualProperty
     */
    public function getRssDataSource(): ?MailRssDataSource
    {
        return ($this->dataSource instanceof MailRssDataSource) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("gal")
     * @Type("Zimbra\Mail\Struct\MailGalDataSource")
     * @VirtualProperty
     */
    public function getGalDataSource(): ?MailGalDataSource
    {
        return ($this->dataSource instanceof MailGalDataSource) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("cal")
     * @Type("Zimbra\Mail\Struct\MailCalDataSource")
     * @VirtualProperty
     */
    public function getCalDataSource(): ?MailCalDataSource
    {
        return ($this->dataSource instanceof MailCalDataSource) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("unknown")
     * @Type("Zimbra\Mail\Struct\MailUnknownDataSource")
     * @VirtualProperty
     */
    public function getUnknownDataSource(): ?MailUnknownDataSource
    {
        return ($this->dataSource instanceof MailUnknownDataSource) ? $this->dataSource : NULL;
    }

    /**
     * Gets dataSource
     *
     * @return DataSource
     */
    public function getDataSource(): ?DataSource
    {
        return $this->dataSource;
    }

    /**
     * Sets dataSource
     *
     * @param  DataSource $dataSource
     * @return self
     */
    public function setDataSource(DataSource $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
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

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CreateDataSourceEnvelope)) {
            $this->envelope = new CreateDataSourceEnvelope(
                new CreateDataSourceBody($this)
            );
        }
    }
}
