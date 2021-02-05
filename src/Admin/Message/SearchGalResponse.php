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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * SearchGalResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="SearchGalResponse")
 */
class SearchGalResponse implements ResponseInterface
{
    /**
     * Name of attribute sorted on.
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * The 0-based offset into the results list returned as the first result for this search operation.
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * Set if the results are truncated
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Valid values: and|or
     * Not present if the search key was not tokenized.
     * Some clients backtrack on GAL results assuming the results of a more specific key is the subset of a more
     *      generic key, and it checks cached results instead of issuing another SOAP request to the server.  
     *      If search key was tokenized and expanded with AND or OR, this cannot be assumed.
     * @Accessor(getter="getTokenizeKey", setter="setTokenizeKey")
     * @SerializedName("tokenizeKey")
     * @Type("bool")
     * @XmlAttribute
     */
    private $tokenizeKey;

    /**
     * Matching contacts
     * 
     * @Accessor(getter="getContacts", setter="setContacts")
     * @SerializedName("cn")
     * @Type("array<Zimbra\Admin\Struct\ContactInfo>")
     * @XmlList(inline = true, entry = "cn")
     */
    private $contacts;

    /**
     * Constructor method for SearchGalResponse
     *
     * @param string $sortBy
     * @param int $offset
     * @param bool $more
     * @param bool $tokenizeKey
     * @param array $contacts
     * @return self
     */
    public function __construct(
        string $sortBy = NULL,
        int $offset = NULL,
        bool $more = NULL,
        bool $tokenizeKey = NULL,
        array $contacts = []
    )
    {
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $more) {
            $this->setMore($more);
        }
        if (NULL !== $tokenizeKey) {
            $this->setTokenizeKey($tokenizeKey);
        }
        $this->setContacts($contacts);
    }

    /**
     * Gets sortBy
     *
     * @return string
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * Sets sortBy
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy(string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Gets offset
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Sets offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Gets more
     *
     * @return bool
     */
    public function getMore(): bool
    {
        return $this->more;
    }

    /**
     * Sets more
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
     * Gets tokenizeKey
     *
     * @return bool
     */
    public function getTokenizeKey(): ?bool
    {
        return $this->tokenizeKey;
    }

    /**
     * Sets tokenizeKey
     *
     * @param  bool $tokenizeKey
     * @return self
     */
    public function setTokenizeKey(bool $tokenizeKey): self
    {
        $this->tokenizeKey = $tokenizeKey;
        return $this;
    }

    /**
     * Add contact
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
     * Sets contacts
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = [];
        foreach ($contacts as $contact) {
            if ($contact instanceof ContactInfo) {
                $this->contacts[] = $contact;
            }
        }
        return $this;
    }

    /**
     * Gets contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }
}