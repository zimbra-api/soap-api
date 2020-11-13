<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};
use Zimbra\Enum\DataSourceBy;

/**
 * SyncGalAccountDataSourceSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="datasource")
 */
class SyncGalAccountDataSourceSpec
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\DataSourceBy")
     * @XmlAttribute
     */
    private $by;

    /**
     * @Accessor(getter="getFullSync", setter="setFullSync")
     * @SerializedName("fullSync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $fullSync;

    /**
     * @Accessor(getter="getReset", setter="setReset")
     * @SerializedName("reset")
     * @Type("bool")
     * @XmlAttribute
     */
    private $reset;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for SyncGalAccountDataSourceSpec
     * @param DataSourceBy $by The by
     * @param string $value The value
     * @param bool $fullSync If fullSync is set to 0 (false) or unset the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync. If fullSync is set to 1 (true), then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
     * @param bool $reset Reset flag. If set, then all the contacts will be populated again, regardless of the status since last sync.
     * @return self
     */
    public function __construct(
        DataSourceBy $by,
        $value = NULL,
        $fullSync = NULL,
        $reset = NULL
    )
    {
        $this->setBy($by);
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $fullSync) {
            $this->setFullSync($fullSync);
        }
        if (NULL !== $reset) {
            $this->setReset($reset);
        }
    }

    /**
     * Gets by enum
     *
     * @return DataSourceBy
     */
    public function getBy(): DataSourceBy
    {
        return $this->by;
    }

    /**
     * Sets by enum
     *
     * @param  DataSourceBy $by
     * @return self
     */
    public function setBy(DataSourceBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value): self
    {
        $this->value = trim($value);
        return $this;
    }

    /**
     * Gets the full sync flag
     *
     * @return bool
     */
    public function getFullSync(): bool
    {
        return $this->fullSync;
    }

    /**
     * Sets the full sync flag
     *
     * @param  bool $fullSync
     * @return self
     */
    public function setFullSync($fullSync): self
    {
        $this->fullSync = (bool) $fullSync;
        return $this;
    }

    /**
     * Gets the reset flag
     *
     * @return bool
     */
    public function getReset(): bool
    {
        return $this->reset;
    }

    /**
     * Sets the reset flag
     *
     * @param  bool $reset
     * @return self
     */
    public function setReset($reset): self
    {
        $this->reset = (bool) $reset;
        return $this;
    }
}
