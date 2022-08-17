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
 * Rights struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Rights
{
    /**
     * The effective permissions of the specified folder
     * 
     * @Accessor(getter="getEffectivePermissions", setter="setEffectivePermissions")
     * @SerializedName("perm")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getEffectivePermissions', setter: 'setEffectivePermissions')]
    #[SerializedName(name: 'perm')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $effectivePermissions;

    /**
     * Constructor
     * 
     * @param string $effectivePermissions
     * @return self
     */
    public function __construct(string $effectivePermissions = '')
    {
        $this->setEffectivePermissions($effectivePermissions);
    }

    /**
     * Get effectivePermissions
     *
     * @return string
     */
    public function getEffectivePermissions(): ?string
    {
        return $this->effectivePermissions;
    }

    /**
     * Set effectivePermissions
     *
     * @param  string $effectivePermissions
     * @return self
     */
    public function setEffectivePermissions(string $effectivePermissions): self
    {
        $this->effectivePermissions = $effectivePermissions;
        return $this;
    }
}
