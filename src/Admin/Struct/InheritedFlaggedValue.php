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

/**
 * InheritedFlaggedValue struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InheritedFlaggedValue
{
    /**
     * Inherited flag
     * 1 (true): inherited from a group
     * 0 (false): set directly on the entry
     * 
     * @Accessor(getter="getInherited", setter="setInherited")
     * @SerializedName("inherited")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getInherited', setter: 'setInherited')]
    #[SerializedName('inherited')]
    #[Type('bool')]
    #[XmlAttribute]
    private $inherited;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
     * @param  bool   $inherited
     * @param  string $value
     * @return self
     */
    public function __construct(bool $inherited = FALSE, ?string $value = NULL)
    {
        $this->setInherited($inherited);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get inherited
     *
     * @return bool
     */
    public function getInherited(): bool
    {
        return $this->inherited;
    }

    /**
     * Set inherited
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
     * Get value
     *
     * @return string
     */
    public function getValue(): string
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
