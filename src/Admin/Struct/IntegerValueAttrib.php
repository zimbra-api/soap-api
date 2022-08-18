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
 * IntegerValueAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IntegerValueAttrib
{
    /**
     * @var int
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[SerializedName('value')]
    #[Type('int')]
    #[XmlAttribute]
    private $value;

    /**
     * Constructor
     * 
     * @param  int $value
     * @return self
     */
    public function __construct(?int $value = NULL)
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get value
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  int $value
     * @return self
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }
}
