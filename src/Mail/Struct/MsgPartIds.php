<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * MsgPartIds struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MsgPartIds
{
    /**
     * Message ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Comma separated list of part IDs to remove
     * 
     * @Accessor(getter="getPartIds", setter="setPartIds")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $partIds;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $partIds
     * @return self
     */
    public function __construct(
        string $id = '',
        string $partIds = ''
    )
    {
        $this->setId($id)
             ->setPartIds($partIds);
    }

    /**
     * Get partIds
     *
     * @return string
     */
    public function getPartIds(): string
    {
        return $this->partIds;
    }

    /**
     * Set partIds
     *
     * @param  string $partIds
     * @return self
     */
    public function setPartIds(string $partIds): self
    {
        $this->partIds = $partIds;
        return $this;
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
}
