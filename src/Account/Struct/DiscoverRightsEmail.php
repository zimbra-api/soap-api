<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyaddr and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * DiscoverRightsEmail struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="email")
 */
class DiscoverRightsEmail
{
    /**
     * Email address
     * @Accessor(getter="getAddr", setter="setAddr")
     * @SerializedName("addr")
     * @Type("string")
     * @XmlAttribute
     */
    private $addr;

    /**
     * Constructor method for DiscoverRightsEmail
     * @param string $addr
     * @return self
     */
    public function __construct(string $addr)
    {
        $this->setAddr($addr);
    }

    /**
     * Gets addr
     *
     * @return string
     */
    public function getAddr(): string
    {
        return $this->addr;
    }

    /**
     * Sets addr
     *
     * @param  string $addr
     * @return self
     */
    public function setAddr(string $addr): self
    {
        $this->addr = $addr;
        return $this;
    }
}