<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * AuthTokenControl struct class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AuthTokenControl
{
    /**
     * @var bool
     */
    #[Accessor(getter: 'getVoidOnExpired', setter: 'setVoidOnExpired')]
    #[SerializedName('voidOnExpired')]
    #[Type('bool')]
    #[XmlAttribute]
    private $voidOnExpired;

    /**
     * Constructor
     * 
     * @param bool $voidOnExpired
     * @return self
     */
    public function __construct(?bool $voidOnExpired = NULL)
    {
        if (NULL !== $voidOnExpired) {
            $this->setVoidOnExpired($voidOnExpired);
        }
    }

    /**
     * Get voidOnExpired
     *
     * @return bool
     */
    public function getVoidOnExpired(): ?bool
    {
        return $this->voidOnExpired;
    }

    /**
     * Set voidOnExpired
     *
     * @param  bool $voidOnExpired
     * @return self
     */
    public function setVoidOnExpired(bool $voidOnExpired): self
    {
        $this->voidOnExpired = $voidOnExpired;
        return $this;
    }
}
