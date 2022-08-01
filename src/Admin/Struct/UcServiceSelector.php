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
use Zimbra\Common\Enum\UcServiceBy;

/**
 * UcServiceSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class UcServiceSelector
{
    /**
     * Selects the meaning of {ucservice-key}
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\UcServiceBy")
     * @XmlAttribute
     */
    private UcServiceBy $by;

    /**
     * Key for choosing ucservice
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for UcServiceSelector
     * @param  UcServiceBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?UcServiceBy $by = NULL, ?string $value = NULL)
    {
        $this->setBy($by ?? UcServiceBy::ID());
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by enum
     *
     * @return UcServiceBy
     */
    public function getBy(): UcServiceBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  UcServiceBy $by
     * @return self
     */
    public function setBy(UcServiceBy $by): self
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
}
