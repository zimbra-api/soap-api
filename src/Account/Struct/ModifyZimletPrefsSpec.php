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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ZimletStatus;

/**
 * ModifyZimletPrefsSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyZimletPrefsSpec
{
    /**
     * Zimlet name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Zimlet presence setting
     * Valid values : "enabled" | "disabled"
     * 
     * @Accessor(getter="getPresence", setter="setPresence")
     * @SerializedName("presence")
     * @Type("Enum<Zimbra\Common\Enum\ZimletStatus>")
     * @XmlAttribute
     * 
     * @var ZimletStatus
     */
    #[Accessor(getter: 'getPresence', setter: 'setPresence')]
    #[SerializedName(name: 'presence')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ZimletStatus>')]
    #[XmlAttribute]
    private $presence;

    /**
     * Constructor
     * 
     * @param  string $name
     * @param  ZimletStatus $presence
     * @return self
     */
    public function __construct(string $name = '', ?ZimletStatus $presence = NULL)
    {
        $this->setName($name)
             ->setPresence($presence ?? new ZimletStatus('enabled'));
    }

    /**
     * Get zimlet name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set zimlet name
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
     * Get presence
     *
     * @return ZimletStatus
     */
    public function getPresence(): ZimletStatus
    {
        return $this->presence;
    }

    /**
     * Set presence
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
