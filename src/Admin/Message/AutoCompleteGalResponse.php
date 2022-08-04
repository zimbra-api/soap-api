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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\ContactInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * AutoCompleteGalResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteGalResponse extends SoapResponse
{
    /**
     * Set to 1 if the results were truncated
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Either "and" or "or" (if present)
     * @Accessor(getter="getTokenizeKey", setter="setTokenizeKey")
     * @SerializedName("tokenizeKey")
     * @Type("bool")
     * @XmlAttribute
     */
    private $tokenizeKey;

    /**
     * Flag if pagination is supported
     * @Accessor(getter="getPagingSupported", setter="setPagingSupported")
     * @SerializedName("paginationSupported")
     * @Type("bool")
     * @XmlAttribute
     */
    private $pagingSupported;

    /**
     * Contacts matching the autocomplete request
     * @Accessor(getter="getContacts", setter="setContacts")
     * @Type("array<Zimbra\Admin\Struct\ContactInfo>")
     * @XmlList(inline=true, entry="cn", namespace="urn:zimbraAdmin")
     */
    private $contacts = [];

    /**
     * Constructor method for AutoCompleteGalResponse
     * 
     * @param bool  $more
     * @param bool  $tokenizeKey
     * @param bool  $pagingSupported
     * @param array $contacts
     * @return self
     */
    public function __construct(
        ?bool $more = NULL, ?bool $tokenizeKey = NULL, ?bool $pagingSupported = NULL, array $contacts = []
    )
    {
        if (NULL !== $more) {
            $this->setMore($more);
        }
        if (NULL !== $tokenizeKey) {
            $this->setTokenizeKey($tokenizeKey);
        }
        if (NULL !== $pagingSupported) {
            $this->setPagingSupported($pagingSupported);
        }
        $this->setContacts($contacts);
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Set more
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
     * Get tokenizeKey
     *
     * @return bool
     */
    public function getTokenizeKey(): ?bool
    {
        return $this->tokenizeKey;
    }

    /**
     * Set tokenizeKey
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
     * Get pagingSupported
     *
     * @return bool
     */
    public function getPagingSupported(): ?bool
    {
        return $this->pagingSupported;
    }

    /**
     * Set pagingSupported
     *
     * @param  bool $pagingSupported
     * @return self
     */
    public function setPagingSupported(bool $pagingSupported): self
    {
        $this->pagingSupported = $pagingSupported;
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
     * Set contacts
     *
     * @param array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = array_filter($contacts, static fn ($contact) => $contact instanceof ContactInfo);
        return $this;
    }

    /**
     * Get contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }
}
