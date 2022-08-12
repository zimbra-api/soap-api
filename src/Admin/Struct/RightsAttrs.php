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
 * RightsAttrs struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RightsAttrs
{
    use AdminAttrsImplTrait;

    /**
     * All flag
     * 
     * @Accessor(getter="getAll", setter="setAll")
     * @SerializedName("all")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getAll', setter: 'setAll')]
    #[SerializedName(name: 'all')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $all;

    /**
     * Constructor
     * 
     * @param  bool $all
     * @param  array $attrs
     * @return self
     */
    public function __construct(?bool $all = NULL, array $attrs = [])
    {
        if (NULL !== $all) {
            $this->setAll($all);
        }
        $this->setAttrs($attrs);
    }

    /**
     * Get all
     *
     * @return bool
     */
    public function getAll(): ?bool
    {
        return $this->all;
    }

    /**
     * Set all
     *
     * @param  bool $all
     * @return self
     */
    public function setAll(bool $all): self
    {
        $this->all = $all;
        return $this;
    }
}
