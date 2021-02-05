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

/**
 * InheritedFlaggedValue struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="flag")
 */
class InheritedFlaggedValue
{
    /**
     * Inherited flag
     * 1 (true): inherited from a group
     * 0 (false): set directly on the entry
     * @Accessor(getter="getInherited", setter="setInherited")
     * @SerializedName("inherited")
     * @Type("bool")
     * @XmlAttribute
     */
    private $inherited;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for InheritedFlaggedValue
     * @param  bool   $inherited
     * @param  string $value
     * @return self
     */
    public function __construct(bool $inherited, ?string $value = NULL)
    {
        $this->setInherited($inherited);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets inherited
     *
     * @return bool
     */
    public function getInherited(): bool
    {
        return $this->inherited;
    }

    /**
     * Sets inherited
     *
     * @param  bool $inherited
     * @return self
     */
    public function setInherited(bool $inherited): self
    {
        $this->inherited = $inherited;
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
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}