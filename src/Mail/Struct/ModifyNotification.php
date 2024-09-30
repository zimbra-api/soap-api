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
 * ModifyNotification struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class ModifyNotification
{
    /**
     * Bitmask of modification change
     *
     * @var int
     */
    #[Accessor(getter: "getChangeBitmask", setter: "setChangeBitmask")]
    #[SerializedName("change")]
    #[Type("int")]
    #[XmlAttribute]
    private $changeBitmask;

    /**
     * Constructor
     *
     * @param  int $changeBitmask
     * @return self
     */
    public function __construct(int $changeBitmask = 0)
    {
        $this->setChangeBitmask($changeBitmask);
    }

    /**
     * Get bitmask of modification change
     *
     * @return int
     */
    public function getChangeBitmask(): int
    {
        return $this->changeBitmask;
    }

    /**
     * Set bitmask of modification change
     *
     * @param  int $changeBitmask
     * @return self
     */
    public function setChangeBitmask(int $changeBitmask): self
    {
        $this->changeBitmask = $changeBitmask;
        return $this;
    }
}
