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
 * IdsAttr class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IdsAttr
{
    /**
     * IDs
     * 
     * @Accessor(getter="getIds", setter="setIds")
     * @SerializedName("ids")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getIds', setter: 'setIds')]
    #[SerializedName(name: 'ids')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $ids;

    /**
     * Constructor
     *
     * @param  string $ids
     * @return self
     */
    public function __construct(string $ids = '')
    {
        $this->setIds($ids);
    }

    /**
     * Get ids
     *
     * @return string
     */
    public function getIds(): string
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
