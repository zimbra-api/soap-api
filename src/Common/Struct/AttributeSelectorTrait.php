<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * AttributeSelectorImpl trait
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
trait AttributeSelectorTrait
{
    /**
     * @var string
     */
    #[Accessor(getter: 'getAttrs', setter: 'setAttrs')]
    #[SerializedName('attrs')]
    #[Type('string')]
    #[XmlAttribute]
    private $attrs;

    /**
     * Get attributes
     *
     * @return string
     */
    public function getAttrs(): ?string
    {
        return $this->attrs;
    }

    /**
     * Set attributes
     *
     * @param  string $attrs
     * @return self
     */
    public function setAttrs(string $attrs): self
    {
        $this->attrs = $attrs;
        return $this;
    }


    /**
     * Add attributes
     *
     * @return self
     */
    public function addAttrs(string ...$attrs): self
    {
        if (!empty($attrs)) {
            $this->attrs = empty($this->attrs) ? implode(',', $attrs) : $this->attrs . ',' . implode(',', $attrs);
        }
        return $this;
    }
}
