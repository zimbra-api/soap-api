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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * DiscoverRightsEmail struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiscoverRightsEmail
{
    /**
     * Email address
     * 
     * @Accessor(getter="getAddr", setter="setAddr")
     * @SerializedName("addr")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAddr', setter: 'setAddr')]
    #[SerializedName(name: 'addr')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $addr;

    /**
     * Constructor
     * 
     * @param string $addr
     * @return self
     */
    public function __construct(string $addr = '')
    {
        $this->setAddr($addr);
    }

    /**
     * Get addr
     *
     * @return string
     */
    public function getAddr(): string
    {
        return $this->addr;
    }

    /**
     * Set addr
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
