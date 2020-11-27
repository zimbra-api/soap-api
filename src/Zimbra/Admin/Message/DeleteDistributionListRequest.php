<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Soap\Request;

/**
 * DeleteDistributionListRequest class
 * Delete a distribution list
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DeleteDistributionListRequest")
 */
class DeleteDistributionListRequest extends Request
{
    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * If true, cascade delete the hab-groups else return error
     * @Accessor(getter="isCascadeDelete", setter="setCascadeDelete")
     * @SerializedName("cascadeDelete")
     * @Type("bool")
     * @XmlAttribute
     */
    private $cascadeDelete;

    /**
     * Constructor method for DeleteDistributionListRequest
     * @param  string $id
     * @param  bool $cascadeDelete
     * @return self
     */
    public function __construct(string $id, ?bool $cascadeDelete = NULL)
    {
        $this->setId($id);
        if (NULL !== $cascadeDelete) {
            $this->setCascadeDelete($cascadeDelete);
        }
    }

    /**
     * Gets zimbra id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets zimbra id
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
     * Gets cascadeDelete
     *
     * @return bool
     */
    public function isCascadeDelete(): ?bool
    {
        return $this->cascadeDelete;
    }

    /**
     * Sets cascadeDelete
     *
     * @param  bool $cascadeDelete
     * @return self
     */
    public function setCascadeDelete(bool $cascadeDelete): self
    {
        $this->cascadeDelete = $cascadeDelete;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof DeleteDistributionListEnvelope)) {
            $this->envelope = new DeleteDistributionListEnvelope(
                new DeleteDistributionListBody($this)
            );
        }
    }
}
