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
 * SearchGalResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchGalResponse extends SoapResponse
{
    /**
     * Name of attribute sorted on.
     * 
     * @var string
     */
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName(name: 'sortBy')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $sortBy;

    /**
     * The 0-based offset into the results list returned as the first result for this search operation.
     * 
     * @var int
     */
    #[Accessor(getter: 'getOffset', setter: 'setOffset')]
    #[SerializedName(name: 'offset')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $offset;

    /**
     * Set if the results are truncated
     * 
     * @var bool
     */
    #[Accessor(getter: 'getMore', setter: 'setMore')]
    #[SerializedName(name: 'more')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $more;

    /**
     * Valid values: and|or
     * Not present if the search key was not tokenized.
     * Some clients backtrack on GAL results assuming the results of a more specific key is the subset of a more
     *      generic key, and it checks cached results instead of issuing another SOAP request to the server.  
     *      If search key was tokenized and expanded with AND or OR, this cannot be assumed.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getTokenizeKey', setter: 'setTokenizeKey')]
    #[SerializedName(name: 'tokenizeKey')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $tokenizeKey;

    /**
     * Matching contacts
     * 
     * @var array
     */
    #[Accessor(getter: 'getContacts', setter: 'setContacts')]
    #[Type(name: 'array<Zimbra\Admin\Struct\ContactInfo>')]
    #[XmlList(inline: true, entry: 'cn', namespace: 'urn:zimbraAdmin')]
    private $contacts = [];

    /**
     * Constructor
     *
     * @param string $sortBy
     * @param int $offset
     * @param bool $more
     * @param bool $tokenizeKey
     * @param array $contacts
     * @return self
     */
    public function __construct(
        ?string $sortBy = NULL,
        ?int $offset = NULL,
        ?bool $more = NULL,
        ?bool $tokenizeKey = NULL,
        array $contacts = []
    )
    {
        $this->setContacts($contacts);
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
    }

    /**
     * Get sortBy
     *
     * @return string
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * Set sortBy
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
     * Get offset
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Set offset
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
     * Get more
     *
     * @return bool
     */
    public function getMore(): bool
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
     * Set contacts
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
     * Get contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }
}
