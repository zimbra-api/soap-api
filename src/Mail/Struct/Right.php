<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * Right struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Right
{
    /**
     * Name for right
     * 
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
     * @XmlAttribute
     */
    private $right;

    /**
     * Constructor method for Right
     * @param string $right
     * @return self
     */
    public function __construct(string $right = '')
    {
        $this->setRight($right);
    }

    /**
     * Gets right
     *
     * @return string
     */
    public function getRight(): string
    {
        return $this->right;
    }

    /**
     * Sets right
     *
     * @param  string $right
     * @return self
     */
    public function setRight(string $right): self
    {
        $this->right = $right;
        return $this;
    }
}
