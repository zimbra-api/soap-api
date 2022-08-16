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
 * CurrentVolumeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CurrentVolumeInfo
{
    /**
     * @var int
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $type;

    /**
     * @var int
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $id;

    /**
     * Constructor
     * 
     * @param  int $type
     * @param  int $id
     * @return self
     */
    public function __construct(int $type = 0, int $id = 0)
    {
        $this->setId($id)
             ->setType($type);
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param  int $type
     * @return self
     */
    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
}
