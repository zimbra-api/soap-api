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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\ZimletStatus;

/**
 * ZimletPrefsSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="zimlet")
 */
class ZimletPrefsSpec
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getPresence", setter="setPresence")
     * @SerializedName("presence")
     * @Type("Zimbra\Enum\ZimletStatus")
     * @XmlAttribute
     */
    private $presence;

    /**
     * Constructor method for ZimletPrefsSpec
     * @param  string $name
     * @param  ZimletStatus $presence
     * @return self
     */
    public function __construct(string $name, ZimletStatus $presence)
    {
        $this->setName($name)
             ->setPresence($presence);
    }

    /**
     * Gets zimlet name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets zimlet name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets presence
     *
     * @return ZimletStatus
     */
    public function getPresence(): ZimletStatus
    {
        return $this->presence;
    }

    /**
     * Sets presence
     *
     * @param  ZimletStatus $presence
     * @return self
     */
    public function setPresence(ZimletStatus $presence)
    {
        $this->presence = $presence;
        return $this;
    }
}
