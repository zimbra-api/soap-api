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
 * ParentId class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ParentId
{
    /**
     * Item ID of parent
     * 
     * @var string
     */
    #[Accessor(getter: 'getParentId', setter: 'setParentId')]
    #[SerializedName(name: 'parentId')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $parentId;

    /**
     * Constructor
     *
     * @param  string $parentId
     * @return self
     */
    public function __construct(string $parentId = '')
    {
        $this->setParentId($parentId);
    }

    /**
     * Get parentId
     *
     * @return string
     */
    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * Set parentId
     *
     * @param  string $parentId
     * @return self
     */
    public function setParentId(string $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }
}
