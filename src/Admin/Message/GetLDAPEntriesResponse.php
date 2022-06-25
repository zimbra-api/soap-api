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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetLDAPEntriesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetLDAPEntriesResponse implements ResponseInterface
{
    /**
     * LDAP entries
     * 
     * @Accessor(getter="getLDAPEntries", setter="setLDAPEntries")
     * @SerializedName("LDAPEntry")
     * @Type("array<Zimbra\Admin\Struct\LDAPEntryInfo>")
     * @XmlList(inline = true, entry = "LDAPEntry")
     */
    private $LDAPEntries = [];

    /**
     * Constructor method for GetLDAPEntriesResponse
     *
     * @param array $LDAPEntries
     * @return self
     */
    public function __construct(array $LDAPEntries = [])
    {
        $this->setLDAPEntries($LDAPEntries);
    }

    /**
     * Add a LDAPEntry information
     *
     * @param  LDAPEntryInfo $LDAPEntry
     * @return self
     */
    public function addLDAPentry(LDAPEntryInfo $LDAPentry): self
    {
        $this->LDAPEntries[] = $LDAPentry;
        return $this;
    }

    /**
     * Sets LDAPEntry informations
     *
     * @param  array $LDAPEntries
     * @return self
     */
    public function setLDAPEntries(array $LDAPEntries): self
    {
        $this->LDAPEntries = array_filter($LDAPEntries, static fn ($LDAPEntry) => $LDAPEntry instanceof LDAPEntryInfo);
        return $this;
    }

    /**
     * Gets LDAPEntry informations
     *
     * @return array
     */
    public function getLDAPEntries(): array
    {
        return $this->LDAPEntries;
    }
}
