<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * AuthTokenControl struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_voidOnExpired;

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
    public function getVoidOnExpired()
    {
        return $this->_voidOnExpired;
    }

    /**
     * Sets voidOnExpired
     *
     * @param  bool $voidOnExpired
     * @return self
     */
    public function setVoidOnExpired($voidOnExpired)
    {
        $this->_voidOnExpired = (bool) $voidOnExpired;
        return $this;
    }
}
