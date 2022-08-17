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
 * AttachSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class AttachSpec
{
    /**
     * Optional
     * 
     * @Accessor(getter="getOptional", setter="setOptional")
     * @SerializedName("optional")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getOptional', setter: 'setOptional')]
    #[SerializedName(name: 'optional')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $optional;

    /**
     * Constructor
     *
     * @param bool $optional
     * @return self
     */
    public function __construct(?bool $optional = NULL)
    {
        if (NULL !== $optional) {
            $this->setOptional($optional);
        }
    }

    /**
     * Get optional
     *
     * @return bool
     */
    public function getOptional(): ?bool
    {
        return $this->optional;
    }

    /**
     * Set optional
     *
     * @param  bool $optional
     * @return self
     */
    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;
        return $this;
    }
}
