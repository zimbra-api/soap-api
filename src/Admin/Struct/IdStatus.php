<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * IdStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IdStatus
{
    /**
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * @var string
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[SerializedName(name: 'status')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $status;

    /**
     * Constructor
     * 
     * @param  string $id
     * @param  string $status
     * @return self
     */
    public function __construct(?string $id = NULL, ?string $status = NULL)
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $status) {
            $this->setStatus($status);
        }
    }

    /**
     * Get Zimbra ID
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
