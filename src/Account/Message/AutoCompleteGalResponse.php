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
use Zimbra\Common\Struct\SoapResponse;

/**
 * AutoCompleteGalResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteGalResponse extends SoapResponse
{
    /**
     * Set to 1 if the results were truncated
     * 
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Either "and" or "or" (if present)
     * - Not present if the search key was not tokenized.
     * - Some clients backtrack on GAL results assuming the results of a more specific key is the subset of a more generic key,
     *   and it checks cached results instead of issuing another SOAP request to the server.
     *   If search key was tokenized and expanded with AND or OR, this cannot be assumed. 
     * 
     * @Accessor(getter="getTokenizeKey", setter="setTokenizeKey")
     * @SerializedName("tokenizeKey")
     * @Type("bool")
     * @XmlAttribute
     */
    private $tokenizeKey;

    /**
     * Flag if pagination is supported
     * 
     * @Accessor(getter="getPagingSupported", setter="setPagingSupported")
     * @SerializedName("paginationSupported")
     * @Type("bool")
     * @XmlAttribute
     */
    private $pagingSupported;

    /**
     * Contacts matching the autocomplete request
     * 
     * @Accessor(getter="getContacts", setter="setContacts")
     * @Type("array<Zimbra\Account\Struct\ContactInfo>")
     * @XmlList(inline=true, entry="cn", namespace="urn:zimbraAccount")
     */
    private $contacts = [];

    /**
     * Constructor
     *
     * @param  bool $more
     * @param  bool $tokenizeKey
     * @param  bool $pagingSupported
     * @param  array $contacts
     * @return self
     */
    public function __construct(
        ?bool $more = NULL,
        ?bool $tokenizeKey = NULL,
        ?bool $pagingSupported = NULL,
        array $contacts = []
    )
    {
        $this->setContacts($contacts);
        if(NULL !== $more) {
            $this->setMore($more);
        }
        if(NULL !== $tokenizeKey) {
            $this->setTokenizeKey($tokenizeKey);
        }
        if(NULL !== $pagingSupported) {
            $this->setPagingSupported($pagingSupported);
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
     * Get tokenize key
     *
     * @return bool
     */
    public function getTokenizeKey(): ?bool
    {
        return $this->tokenizeKey;
    }

    /**
     * Set tokenize key
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
     * Get flag if pagination is supported
     *
     * @return bool
     */
    public function getPagingSupported(): ?bool
    {
        return $this->pagingSupported;
    }

    /**
     * Set flag if pagination is supported
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
        $this->contacts = array_filter($contacts, static fn ($contact) => $contact instanceof ContactInfo);
        return $this;
    }
}
