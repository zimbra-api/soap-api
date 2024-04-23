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
use Zimbra\Common\Enum\ReindexType;

/**
 * ReindexMailboxInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ReindexMailboxInfo
{
    /**
     * Account ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Comma separated list of types.
     * Legal values are: conversation|message|contact|appointment|task|note|wiki|document
     * 
     * @var string
     */
    #[Accessor(getter: 'getTypes', setter: 'setTypes')]
    #[SerializedName('types')]
    #[Type('string')]
    #[XmlAttribute]
    private $types;

    /**
     * Comma separated list of IDs to re-index
     * 
     * @var string
     */
    #[Accessor(getter: 'getIds', setter: 'setIds')]
    #[SerializedName('ids')]
    #[Type('string')]
    #[XmlAttribute]
    private $ids;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $types
     * @param string $ids
     * @return self
     */
    public function __construct(
        string $id = '', ?string $types = null, ?string $ids = null
    )
    {
        $this->setId($id);
        if (null !== $types) {
            $this->setTypes($types);
        }
        if (null !== $ids) {
            $this->setIds($ids);
        }
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
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
     * Get types
     *
     * @return string
     */
    public function getTypes(): ?string
    {
        return $this->types;
    }

    /**
     * Set types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes(string $types): self
    {
        $types = array_filter(
            array_map(
                static fn ($type) => trim($type), explode(',', $types)
            ),
            static fn ($type) => ReindexType::tryFrom($type) !== null
        );
        $this->types = implode(',', array_unique($types));
        return $this;
    }

    /**
     * Set ids
     *
     * @return string
     */
    public function getIds(): ?string
    {
        return $this->ids;
    }

    /**
     * Set ids
     *
     * @param  string $ids
     * @return self
     */
    public function setIds(string $ids): self
    {
        $this->ids = $ids;
        return $this;
    }
}
