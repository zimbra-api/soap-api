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
 * RedirectAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RedirectAction extends FilterAction
{
    /**
     * Email address
     *
     * @var string
     */
    #[Accessor(getter: "getAddress", setter: "setAddress")]
    #[SerializedName("a")]
    #[Type("string")]
    #[XmlAttribute]
    private $address;

    /**
     * If true, item's copy will be redirected, leaving the original in place.
     * See https://tools.ietf.org/html/rfc3894 "Sieve Extension: Copying Without Side Effects"
     *
     * @var bool
     */
    #[Accessor(getter: "isCopy", setter: "setCopy")]
    #[SerializedName("copy")]
    #[Type("bool")]
    #[XmlAttribute]
    private $copy;

    /**
     * Constructor
     *
     * @param int $index
     * @param string $address
     * @param bool $copy
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?string $address = null,
        ?bool $copy = null
    ) {
        parent::__construct($index);
        if (null !== $address) {
            $this->setAddress($address);
        }
        if (null !== $copy) {
            $this->setCopy($copy);
        }
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get copy
     *
     * @return bool
     */
    public function isCopy(): ?bool
    {
        return $this->copy;
    }

    /**
     * Set copy
     *
     * @param  bool $copy
     * @return self
     */
    public function setCopy(bool $copy)
    {
        $this->copy = $copy;
        return $this;
    }
}
