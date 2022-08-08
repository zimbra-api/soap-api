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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\DataSourceBy;

/**
 * SyncGalAccountDataSourceSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncGalAccountDataSourceSpec
{
    /**
     * The by
     * 
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Enum<Zimbra\Common\Enum\DataSourceBy>")
     * @XmlAttribute
     * @var DataSourceBy
     */
    private $by;

    /**
     * If fullSync is set to 0 (false) or unset the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync.
     * If fullSync is set to 1 (true), then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
     * 
     * @Accessor(getter="getFullSync", setter="setFullSync")
     * @SerializedName("fullSync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $fullSync;

    /**
     * Reset flag. If set, then all the contacts will be populated again, regardless of the status since last sync.
     * 
     * @Accessor(getter="getReset", setter="setReset")
     * @SerializedName("reset")
     * @Type("bool")
     * @XmlAttribute
     */
    private $reset;

    /**
     * The value
     * 
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor
     * 
     * @param DataSourceBy $by
     * @param string $value
     * @param bool $fullSync
     * @param bool $reset
     * @return self
     */
    public function __construct(
        ?DataSourceBy $by = NULL,
        ?string $value = NULL,
        ?bool $fullSync = NULL,
        ?bool $reset = NULL
    )
    {
        $this->setBy($by ?? new DataSourceBy('id'));
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
     * Get by enum
     *
     * @return DataSourceBy
     */
    public function getBy(): DataSourceBy
    {
        return $this->by;
    }

    /**
     * Set by enum
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
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get the full sync flag
     *
     * @return bool
     */
    public function getFullSync(): ?bool
    {
        return $this->fullSync;
    }

    /**
     * Set the full sync flag
     *
     * @param  bool $fullSync
     * @return self
     */
    public function setFullSync(bool $fullSync): self
    {
        $this->fullSync = $fullSync;
        return $this;
    }

    /**
     * Get the reset flag
     *
     * @return bool
     */
    public function getReset(): ?bool
    {
        return $this->reset;
    }

    /**
     * Set the reset flag
     *
     * @param  bool $reset
     * @return self
     */
    public function setReset(bool $reset): self
    {
        $this->reset = $reset;
        return $this;
    }
}
