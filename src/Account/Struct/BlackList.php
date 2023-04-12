<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Common\Struct\OpValue;

/**
 * BlackList struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2022020-present0 by Nguyen Van Nguyen.
 */
class BlackList
{
    /**
     * @var array
     */
    #[Accessor(getter: 'getAddrs', setter: 'setAddrs')]
    #[Type('array<Zimbra\Common\Struct\OpValue>')]
    #[XmlList(inline: true, entry: 'addr', namespace: 'urn:zimbraAccount')]
    private $addrs = [];

    /**
     * Constructor
     * 
     * @param array $addrs
     * @return self
     */
    public function __construct(array $addrs = [])
    {
        $this->setAddrs($addrs);
    }

    /**
     * Add an addr
     *
     * @param  OpValue $addr
     * @return self
     */
    public function addAddr(OpValue $addr): self
    {
        $this->addrs[] = $addr;
        return $this;
    }

    /**
     * Set addr array
     *
     * @param array $addrs
     * @return self
     */
    public function setAddrs(array $addrs): self
    {
        $this->addrs = array_filter($addrs, static fn ($addr) => $addr instanceof OpValue);
        return $this;
    }

    /**
     * Get addr array
     *
     * @return array
     */
    public function getAddrs(): array
    {
        return $this->addrs;
    }
}
