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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * RightPermission class
 * Individual right information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RightPermission
{
    /**
     * If set then the authed user has the right {right-name} on the target.
     * @Accessor(getter="getAllow", setter="setAllow")
     * @SerializedName("allow")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allow;

    /**
     * Right name
     * @Accessor(getter="getRightName", setter="setRightName")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $rightName;

    /**
     * Constructor method for RightPermission
     *
     * @param  bool $allow
     * @param  string $rightName
     * @return self
     */
    public function __construct(
        bool $allow, ?string $rightName = NULL
    )
    {
        $this->setAllow($allow);
        if (NULL !== $rightName) {
            $this->setRightName($rightName);
        }
    }

    /**
     * Gets allow
     *
     * @return bool
     */
    public function getAllow(): bool
    {
        return $this->allow;
    }

    /**
     * Sets allow
     *
     * @param  bool $allow
     * @return self
     */
    public function setAllow(bool $allow): self
    {
        $this->allow = $allow;
        return $this;
    }

    /**
     * Gets rightName
     *
     * @return string
     */
    public function getRightName(): ?string
    {
        return $this->rightName;
    }

    /**
     * Sets rightName
     *
     * @param  string $rightName
     * @return self
     */
    public function setRightName(string $rightName): self
    {
        $this->rightName = $rightName;
        return $this;
    }
}
