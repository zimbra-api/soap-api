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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Common\Struct\{Id, SoapResponse};

/**
 * SyncGalResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncGalResponse extends SoapResponse
{
    /**
     * Flags whether there are more results
     *
     * @var bool
     */
    #[Accessor(getter: "getMore", setter: "setMore")]
    #[SerializedName("more")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $more = null;

    /**
     * New synchronization token
     *
     * @var string
     */
    #[Accessor(getter: "getToken", setter: "setToken")]
    #[SerializedName("token")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $token = null;

    /**
     * galDefinitionLastModified is the time at which the GAL definition is last modified.
     * This is returned if the sync does not happen using GAL sync account.
     *
     * @var string
     */
    #[
        Accessor(
            getter: "getGalDefinitionLastModified",
            setter: "setGalDefinitionLastModified"
        )
    ]
    #[SerializedName("galDefinitionLastModified")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $galDefinitionLastModified = null;

    /**
     * True if the SyncGal request is throttled
     *
     * @var bool
     */
    #[Accessor(getter: "getThrottled", setter: "setThrottled")]
    #[SerializedName("throttled")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $throttled = null;

    /**
     * True if the fullSync is recommended
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getFullSyncRecommended",
            setter: "setFullSyncRecommended"
        )
    ]
    #[SerializedName("fullSyncRecommended")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $fullSyncRecommended = null;

    /**
     * count of records still to be returned in paginated response
     *
     * @var int
     */
    #[Accessor(getter: "getRemain", setter: "setRemain")]
    #[SerializedName("remain")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $remain = null;

    /**
     * Details of contact
     *
     * @var array
     */
    #[Accessor(getter: "getContacts", setter: "setContacts")]
    #[Type("array<Zimbra\Account\Struct\ContactInfo>")]
    #[XmlList(inline: true, entry: "cn", namespace: "urn:zimbraAccount")]
    private array $contacts = [];

    /**
     * Details of deleted entries
     *
     * @var array
     */
    #[Accessor(getter: "getDeleted", setter: "setDeleted")]
    #[Type("array<Zimbra\Common\Struct\Id>")]
    #[XmlList(inline: true, entry: "deleted", namespace: "urn:zimbraAccount")]
    private array $deleted = [];

    /**
     * Constructor
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
        ?bool $more = null,
        ?string $token = null,
        ?string $galDefinitionLastModified = null,
        ?bool $throttled = null,
        ?bool $fullSyncRecommended = null,
        ?int $remain = null,
        array $contacts = [],
        array $deleted = []
    ) {
        $this->setContacts($contacts)->setDeleted($deleted);
        if (null !== $more) {
            $this->setMore($more);
        }
        if (null !== $token) {
            $this->setToken($token);
        }
        if (null !== $galDefinitionLastModified) {
            $this->setGalDefinitionLastModified($galDefinitionLastModified);
        }
        if (null !== $throttled) {
            $this->setThrottled($throttled);
        }
        if (null !== $fullSyncRecommended) {
            $this->setFullSyncRecommended($fullSyncRecommended);
        }
        if (null !== $remain) {
            $this->setRemain($remain);
        }
    }

    /**
     * Get more flag
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Set more flag
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
     * Get token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set token
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
     * Get galDefinitionLastModified
     *
     * @return string
     */
    public function getGalDefinitionLastModified(): ?string
    {
        return $this->galDefinitionLastModified;
    }

    /**
     * Set galDefinitionLastModified
     *
     * @param  string $galDefinitionLastModified
     * @return self
     */
    public function setGalDefinitionLastModified(
        string $galDefinitionLastModified
    ): self {
        $this->galDefinitionLastModified = $galDefinitionLastModified;
        return $this;
    }

    /**
     * Get throttled
     *
     * @return bool
     */
    public function getThrottled(): ?bool
    {
        return $this->throttled;
    }

    /**
     * Set throttled
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
     * Get fullSyncRecommended
     *
     * @return bool
     */
    public function getFullSyncRecommended(): ?bool
    {
        return $this->fullSyncRecommended;
    }

    /**
     * Set fullSyncRecommended
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
     * Get remain
     *
     * @return int
     */
    public function getRemain(): ?int
    {
        return $this->remain;
    }

    /**
     * Set remain
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
     * Get contacts matching the autocomplete request
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * Set contacts matching the autocomplete request
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = array_filter(
            $contacts,
            static fn($contact) => $contact instanceof ContactInfo
        );
        return $this;
    }

    /**
     * Get deleted
     *
     * @return array
     */
    public function getDeleted(): array
    {
        return $this->deleted;
    }

    /**
     * Set deleted
     *
     * @param  array $contacts
     * @return self
     */
    public function setDeleted(array $contacts): self
    {
        $this->deleted = array_filter(
            $contacts,
            static fn($contact) => $contact instanceof Id
        );
        return $this;
    }
}
