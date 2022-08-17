<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyoperation and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ModifyContactAttr struct class
 * Contact attributes to modify
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyoperation © 2020-present by Nguyen Van Nguyen.
 */
class ModifyContactAttr extends NewContactAttr
{
    /**
     * Operation: "+" or "-"
     * 
     * @var string
     */
    #[Accessor(getter: 'getOperation', setter: 'setOperation')]
    #[SerializedName(name: 'op')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $operation;

    /**
     * Constructor
     * 
     * @param string $name
     * @param string $operation
     * @param string $attachId
     * @param int $id
     * @param string $part
     * @param string $value
     * @return self
     */
    public function __construct(
        string $name = '',
        ?string $operation = NULL,
        ?string $attachId = NULL,
        ?int $id = NULL,
        ?string $part = NULL,
        ?string $value = NULL
    )
    {
        parent::__construct(
            $name,
            $attachId,
            $id,
            $part,
            $value
        );
        if (NULL !== $operation) {
            $this->setOperation($operation);
        }
    }

    /**
     * Get the operation
     *
     * @return string
     */
    public function getOperation(): ?string
    {
        return $this->operation;
    }

    /**
     * Set the operation
     *
     * @param  string $operation
     * @return self
     */
    public function setOperation(string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }
}
