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
use Zimbra\Common\Enum\AlwaysOnClusterBy;

/**
 * AlwaysOnClusterSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AlwaysOnClusterSelector
{
    /**
     * Selects the meaning of alwaysOnCluster-key
     * 
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\AlwaysOnClusterBy")
     * @XmlAttribute
     */
    private AlwaysOnClusterBy $by;

    /**
     * Key for choosing alwaysOnCluster
     * 
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for AlwaysOnClusterSelector
     * @param  AlwaysOnClusterBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(
        ?AlwaysOnClusterBy $by = NULL, ?string $value = NULL
    )
    {
        $this->setBy($by ?? AlwaysOnClusterBy::ID());
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get account by
     *
     * @return AlwaysOnClusterBy
     */
    public function getBy(): AlwaysOnClusterBy
    {
        return $this->by;
    }

    /**
     * Set account by enum
     *
     * @param  AlwaysOnClusterBy $by
     * @return self
     */
    public function setBy(AlwaysOnClusterBy $by): self
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
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
