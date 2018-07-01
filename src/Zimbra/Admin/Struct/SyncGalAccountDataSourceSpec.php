<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlValue;

use Zimbra\Enum\DataSourceBy;

/**
 * SyncGalAccountDataSourceSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="datasource")
 */
class SyncGalAccountDataSourceSpec
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("string")
     * @XmlAttribute
     */
    private $_by;

    /**
     * @Accessor(getter="getFullSync", setter="setFullSync")
     * @SerializedName("fullSync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_fullSync;

    /**
     * @Accessor(getter="getReset", setter="setReset")
     * @SerializedName("reset")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_reset;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $_value;

    /**
     * Constructor method for SyncGalAccountDataSourceSpec
     * @param string $by The by
     * @param string $value The value
     * @param bool $fullSync If fullSync is set to 0 (false) or unset the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync. If fullSync is set to 1 (true), then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
     * @param bool $reset Reset flag. If set, then all the contacts will be populated again, regardless of the status since last sync.
     * @return self
     */
    public function __construct(
        $by,
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
     * @return string
     */
    public function getBy()
    {
        return $this->_by;
    }

    /**
     * Sets by enum
     *
     * @param  string $by
     * @return self
     */
    public function setBy($by)
    {
        if (DataSourceBy::has(trim($by))) {
            $this->_by = trim($by);
        }
        return $this;
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * Sets value
     *
     * @param  string $name
     * @return self
     */
    public function setValue($value)
    {
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets the full sync flag
     *
     * @return bool
     */
    public function getFullSync()
    {
        return $this->_fullSync;
    }

    /**
     * Sets the full sync flag
     *
     * @param  bool $fullSync
     * @return self
     */
    public function setFullSync($fullSync)
    {
        $this->_fullSync = (bool) $fullSync;
        return $this;
    }

    /**
     * Gets the reset flag
     *
     * @return bool
     */
    public function getReset()
    {
        return $this->_reset;
    }

    /**
     * Sets the reset flag
     *
     * @param  bool $reset
     * @return self
     */
    public function setReset($reset)
    {
        $this->_reset = (bool) $reset;
        return $this;
    }
}
