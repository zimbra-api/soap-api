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
use Zimbra\Mail\Struct\ImapDataSourceId;
use Zimbra\Mail\Struct\Pop3DataSourceId;
use Zimbra\Mail\Struct\CaldavDataSourceId;
use Zimbra\Mail\Struct\YabDataSourceId;
use Zimbra\Mail\Struct\RssDataSourceId;
use Zimbra\Mail\Struct\GalDataSourceId;
use Zimbra\Mail\Struct\CalDataSourceId;
use Zimbra\Mail\Struct\UnknownDataSourceId;
use Zimbra\Struct\Id;
use Zimbra\Soap\ResponseInterface;

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
     * ID information for the created data source
     * @Exclude
     */
    private $dataSource;

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
     * @SerializedName("imap")
     * @Type("Zimbra\Mail\Struct\ImapDataSourceId")
     * @VirtualProperty
     */
    public function getImapDataSource(): ?ImapDataSourceId
    {
        return ($this->dataSource instanceof ImapDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("pop3")
     * @Type("Zimbra\Mail\Struct\Pop3DataSourceId")
     * @VirtualProperty
     */
    public function getPop3DataSource(): ?Pop3DataSourceId
    {
        return ($this->dataSource instanceof Pop3DataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("caldav")
     * @Type("Zimbra\Mail\Struct\CaldavDataSourceId")
     * @VirtualProperty
     */
    public function getCaldavDataSource(): ?CaldavDataSourceId
    {
        return ($this->dataSource instanceof CaldavDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("yab")
     * @Type("Zimbra\Mail\Struct\YabDataSourceId")
     * @VirtualProperty
     */
    public function getYabDataSource(): ?YabDataSourceId
    {
        return ($this->dataSource instanceof YabDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("rss")
     * @Type("Zimbra\Mail\Struct\RssDataSourceId")
     * @VirtualProperty
     */
    public function getRssDataSource(): ?RssDataSourceId
    {
        return ($this->dataSource instanceof RssDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("gal")
     * @Type("Zimbra\Mail\Struct\GalDataSourceId")
     * @VirtualProperty
     */
    public function getGalDataSource(): ?GalDataSourceId
    {
        return ($this->dataSource instanceof GalDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("cal")
     * @Type("Zimbra\Mail\Struct\CalDataSourceId")
     * @VirtualProperty
     */
    public function getCalDataSource(): ?CalDataSourceId
    {
        return ($this->dataSource instanceof CalDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("unknown")
     * @Type("Zimbra\Mail\Struct\UnknownDataSourceId")
     * @VirtualProperty
     */
    public function getUnknownDataSource(): ?UnknownDataSourceId
    {
        return ($this->dataSource instanceof UnknownDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * Gets dataSource
     *
     * @return Id
     */
    public function getDataSource(): ?Id
    {
        return $this->dataSource;
    }

    /**
     * Sets dataSource
     *
     * @param  Id $dataSource
     * @return self
     */
    public function setDataSource(Id $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
    }

    public static function dataSourceTypes(): array
    {
        return [
            'imap' => ImapDataSourceId::class,
            'pop3' => Pop3DataSourceId::class,
            'caldav' => CaldavDataSourceId::class,
            'yab' => YabDataSourceId::class,
            'rss' => RssDataSourceId::class,
            'gal' => GalDataSourceId::class,
            'cal' => CalDataSourceId::class,
            'unknown' => UnknownDataSourceId::class,
        ];
    }
}
