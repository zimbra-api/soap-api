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

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, VirtualProperty};
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
    private ?Id $dataSource = NULL;

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
     * @VirtualProperty
     */
    public function getImapDataSource(): ?ImapDataSourceId
    {
        return ($this->dataSource instanceof ImapDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("pop3")
     * @VirtualProperty
     */
    public function getPop3DataSource(): ?Pop3DataSourceId
    {
        return ($this->dataSource instanceof Pop3DataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("caldav")
     * @VirtualProperty
     */
    public function getCaldavDataSource(): ?CaldavDataSourceId
    {
        return ($this->dataSource instanceof CaldavDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("yab")
     * @VirtualProperty
     */
    public function getYabDataSource(): ?YabDataSourceId
    {
        return ($this->dataSource instanceof YabDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("rss")
     * @VirtualProperty
     */
    public function getRssDataSource(): ?RssDataSourceId
    {
        return ($this->dataSource instanceof RssDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("gal")
     * @VirtualProperty
     */
    public function getGalDataSource(): ?GalDataSourceId
    {
        return ($this->dataSource instanceof GalDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("cal")
     * @VirtualProperty
     */
    public function getCalDataSource(): ?CalDataSourceId
    {
        return ($this->dataSource instanceof CalDataSourceId) ? $this->dataSource : NULL;
    }

    /**
     * @SerializedName("unknown")
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
