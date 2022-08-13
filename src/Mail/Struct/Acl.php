<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * Acl class
 * Access control level
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Acl
{
    /**
     * Time when grants to internal grantees expire.
     * 
     * @Accessor(getter="getInternalGrantExpiry", setter="setInternalGrantExpiry")
     * @SerializedName("internalGrantExpiry")
     * @Type("int")
     * @XmlAttribute
     */
    private $internalGrantExpiry;

    /**
     * Time when grants to guest grantees expire.
     * 
     * @Accessor(getter="getGuestGrantExpiry", setter="setGuestGrantExpiry")
     * @SerializedName("guestGrantExpiry")
     * @Type("int")
     * @XmlAttribute
     */
    private $guestGrantExpiry;

    /**
     * Grants
     * 
     * @Accessor(getter="getGrants", setter="setGrants")
     * @Type("array<Zimbra\Mail\Struct\Grant>")
     * @XmlList(inline=true, entry="grant", namespace="urn:zimbraMail")
     */
    private $grants = [];

    /**
     * Constructor
     *
     * @param  int $internalGrantExpiry
     * @param  int $guestGrantExpiry
     * @param  array $grants
     * @return self
     */
    public function __construct(
        ?int $internalGrantExpiry = NULL,
        ?int $guestGrantExpiry = NULL,
        array $grants = []
    )
    {
        $this->setGrants($grants);
        if (NULL !== $internalGrantExpiry) {
            $this->setInternalGrantExpiry($internalGrantExpiry);
        }
        if (NULL !== $guestGrantExpiry) {
            $this->setGuestGrantExpiry($guestGrantExpiry);
        }
    }

    /**
     * Get internalGrantExpiry
     *
     * @return int
     */
    public function getInternalGrantExpiry(): ?int
    {
        return $this->internalGrantExpiry;
    }

    /**
     * Set internalGrantExpiry
     *
     * @param  int $internalGrantExpiry
     * @return self
     */
    public function setInternalGrantExpiry(int $internalGrantExpiry): self
    {
        $this->internalGrantExpiry = $internalGrantExpiry;
        return $this;
    }

    /**
     * Get guestGrantExpiry
     *
     * @return int
     */
    public function getGuestGrantExpiry(): ?int
    {
        return $this->guestGrantExpiry;
    }

    /**
     * Set guestGrantExpiry
     *
     * @param  int $guestGrantExpiry
     * @return self
     */
    public function setGuestGrantExpiry(int $guestGrantExpiry): self
    {
        $this->guestGrantExpiry = $guestGrantExpiry;
        return $this;
    }

    /**
     * Set grants
     *
     * @param  array $grants
     * @return self
     */
    public function setGrants(array $grants): self
    {
        $this->grants = array_filter($grants, static fn ($grant) => $grant instanceof Grant);
        return $this;
    }

    /**
     * Get grants
     *
     * @return array
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * Add grant
     *
     * @param  Grant $grant
     * @return self
     */
    public function addGrant(Grant $grant): self
    {
        $this->grants[] = $grant;
        return $this;
    }
}
