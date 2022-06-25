<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Common\Struct\Id;
use Zimbra\Soap\ResponseInterface;

/**
 * SyncGalResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SyncGalResponse implements ResponseInterface
{
    /**
     * Flags whether there are more results
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * New synchronization token
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $token;

    /**
     * galDefinitionLastModified is the time at which the GAL definition is last modified.
     * This is returned if the sync does not happen using GAL sync account.
     * @Accessor(getter="getGalDefinitionLastModified", setter="setGalDefinitionLastModified")
     * @SerializedName("galDefinitionLastModified")
     * @Type("string")
     * @XmlAttribute
     */
    private $galDefinitionLastModified;

    /**
     * True if the SyncGal request is throttled
     * @Accessor(getter="getThrottled", setter="setThrottled")
     * @SerializedName("throttled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $throttled;

    /**
     * True if the fullSync is recommended
     * @Accessor(getter="getFullSyncRecommended", setter="setFullSyncRecommended")
     * @SerializedName("fullSyncRecommended")
     * @Type("bool")
     * @XmlAttribute
     */
    private $fullSyncRecommended;

    /**
     * count of records still to be returned in paginated response
     * @Accessor(getter="getRemain", setter="setRemain")
     * @SerializedName("remain")
     * @Type("integer")
     * @XmlAttribute
     */
    private $remain;

    /**
     * Details of contact
     * @Accessor(getter="getContacts", setter="setContacts")
     * @SerializedName("cn")
     * @Type("array<Zimbra\Account\Struct\ContactInfo>")
     * @XmlList(inline = true, entry = "cn")
     */
    private $contacts = [];

    /**
     * details of deleted entries
     * @Accessor(getter="getDeleted", setter="setDeleted")
     * @SerializedName("deleted")
     * @Type("array<Zimbra\Common\Struct\Id>")
     * @XmlList(inline = true, entry = "deleted")
     */
    private $deleted = [];

    /**
     * Constructor method for SyncGalResponse
     *
     * @param  bool $more
     * @param  string $token
     * @param  string $galDefinitionLastModified
     * @param  bool $throttled
     * @param  bool $fullSyncRecommended
     * @param  int $remain
     * @param  array $contacts
     * @param  array $deleted
     * @return self
     */
    public function __construct(
        ?bool $more = NULL,
        ?string $token = NULL,
        ?string $galDefinitionLastModified = NULL,
        ?bool $throttled = NULL,
        ?bool $fullSyncRecommended = NULL,
        ?int $remain = NULL,
        array $contacts = [],
        array $deleted = []
    )
    {
        $this->setContacts($contacts)
             ->setDeleted($deleted);
        if(NULL !== $more) {
            $this->setMore($more);
        }
        if(NULL !== $token) {
            $this->setToken($token);
        }
        if(NULL !== $galDefinitionLastModified) {
            $this->setGalDefinitionLastModified($galDefinitionLastModified);
        }
        if(NULL !== $throttled) {
            $this->setThrottled($throttled);
        }
        if(NULL !== $fullSyncRecommended) {
            $this->setFullSyncRecommended($fullSyncRecommended);
        }
        if(NULL !== $remain) {
            $this->setRemain($remain);
        }
    }

    /**
     * Gets more flag
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Sets more flag
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }

    /**
     * Gets token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Sets token
     *
     * @param  string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Gets galDefinitionLastModified
     *
     * @return string
     */
    public function getGalDefinitionLastModified(): ?string
    {
        return $this->galDefinitionLastModified;
    }

    /**
     * Sets galDefinitionLastModified
     *
     * @param  string $galDefinitionLastModified
     * @return self
     */
    public function setGalDefinitionLastModified(string $galDefinitionLastModified): self
    {
        $this->galDefinitionLastModified = $galDefinitionLastModified;
        return $this;
    }

    /**
     * Gets throttled
     *
     * @return bool
     */
    public function getThrottled(): ?bool
    {
        return $this->throttled;
    }

    /**
     * Sets throttled
     *
     * @param  bool $throttled
     * @return self
     */
    public function setThrottled(bool $throttled): self
    {
        $this->throttled = $throttled;
        return $this;
    }

    /**
     * Gets fullSyncRecommended
     *
     * @return bool
     */
    public function getFullSyncRecommended(): ?bool
    {
        return $this->fullSyncRecommended;
    }

    /**
     * Sets fullSyncRecommended
     *
     * @param  bool $fullSyncRecommended
     * @return self
     */
    public function setFullSyncRecommended(bool $fullSyncRecommended): self
    {
        $this->fullSyncRecommended = $fullSyncRecommended;
        return $this;
    }

    /**
     * Gets remain
     *
     * @return int
     */
    public function getRemain(): ?int
    {
        return $this->remain;
    }

    /**
     * Sets remain
     *
     * @param  int $remain
     * @return self
     */
    public function setRemain(int $remain): self
    {
        $this->remain = $remain;
        return $this;
    }

    /**
     * Gets contacts matching the autocomplete request
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * Sets contacts matching the autocomplete request
     *
     * @param  array $contacts 
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = array_filter($contacts, static fn ($contact) => $contact instanceof ContactInfo);
        return $this;
    }

    /**
     * Add contact matching the autocomplete request
     *
     * @param  ContactInfo $contact
     * @return self
     */
    public function addContact(ContactInfo $contact): self
    {
        $this->contacts[] = $contact;
        return $this;
    }

    /**
     * Gets deleted
     *
     * @return array
     */
    public function getDeleted(): array
    {
        return $this->deleted;
    }

    /**
     * Sets deleted
     *
     * @param  array $contacts 
     * @return self
     */
    public function setDeleted(array $contacts): self
    {
        $this->deleted = array_filter($contacts, static fn ($contact) => $contact instanceof Id);
        return $this;
    }
}
