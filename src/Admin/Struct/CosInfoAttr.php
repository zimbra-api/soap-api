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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * CosInfoAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CosInfoAttr extends Attr
{
    /**
     * Flags that this is a Class Of Service (COS) attribute.
     * @Accessor(getter="getCosAttr", setter="setCosAttr")
     * @SerializedName("c")
     * @Type("bool")
     * @XmlAttribute
     */
    private $cosAttr;

    /**
     * Flags that the value of this attribute has been suppressed for permissions reasons
     * @Accessor(getter="getPermDenied", setter="setPermDenied")
     * @SerializedName("pd")
     * @Type("bool")
     * @XmlAttribute
     */
    private $permDenied;

    /**
     * Constructor method for CosInfoAttr
     * @param  string $key
     * @param  string $value
     * @param  bool $cosAttr
     * @param  bool $permDenied
     * @return self
     */
    public function __construct(string $key, ?string $value = NULL, ?bool $cosAttr = NULL, ?bool $permDenied = NULL)
    {
    	parent::__construct($key, $value);
        if (NULL !== $cosAttr) {
            $this->setCosAttr($cosAttr);
        }
        if (NULL !== $permDenied) {
            $this->setPermDenied($permDenied);
        }
    }

    /**
     * Gets cosAttr
     *
     * @return bool
     */
    public function getCosAttr(): ?bool
    {
        return $this->cosAttr;
    }

    /**
     * Sets cosAttr
     *
     * @param  bool $cosAttr
     * @return self
     */
    public function setCosAttr(bool $cosAttr): self
    {
        $this->cosAttr = $cosAttr;
        return $this;
    }

    /**
     * Gets destination name
     *
     * @return bool
     */
    public function getPermDenied(): ?bool
    {
        return $this->permDenied;
    }

    /**
     * Sets permDenied
     *
     * @param  bool $permDenied
     * @return self
     */
    public function setPermDenied(bool $permDenied): self
    {
        $this->permDenied = $permDenied;
        return $this;
    }
}
