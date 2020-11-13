<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * AuthTokenControl struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="authTokenControl")
 */
class AuthTokenControl
{
    /**
     * @Accessor(getter="getVoidOnExpired", setter="setVoidOnExpired")
     * @SerializedName("voidOnExpired")
     * @Type("boolean")
     * @XmlAttribute
     */
    private $voidOnExpired;

    /**
     * Constructor method for AuthTokenControl
     * @param bool $voidOnExpired
     * @return self
     */
    public function __construct($voidOnExpired = NULL)
    {
        if (NULL !== $voidOnExpired) {
            $this->setVoidOnExpired($voidOnExpired);
        }
    }

    /**
     * Gets an voidOnExpired
     *
     * @param  bool $voidOnExpired
     * @return bool
     */
    public function getVoidOnExpired(): bool
    {
        return $this->voidOnExpired;
    }

    /**
     * Sets voidOnExpired
     *
     * @param  bool $voidOnExpired
     * @return self
     */
    public function setVoidOnExpired($voidOnExpired): self
    {
        $this->voidOnExpired = (bool) $voidOnExpired;
        return $this;
    }
}
