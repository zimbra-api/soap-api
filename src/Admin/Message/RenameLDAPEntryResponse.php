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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * RenameLDAPEntryResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RenameLDAPEntryResponse extends SoapResponse
{
    /**
     * Information about updated LDAP entry
     * 
     * @var LDAPEntryInfo
     */
    #[Accessor(getter: 'getLDAPEntry', setter: 'setLDAPEntry')]
    #[SerializedName('LDAPEntry')]
    #[Type(LDAPEntryInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?LDAPEntryInfo $LDAPEntry;

    /**
     * Constructor
     *
     * @param LDAPEntryInfo $LDAPEntry
     * @return self
     */
    public function __construct(?LDAPEntryInfo $LDAPEntry = null)
    {
        $this->LDAPEntry = $LDAPEntry;
    }

    /**
     * Get the LDAPEntry.
     *
     * @return LDAPEntryInfo
     */
    public function getLDAPEntry(): ?LDAPEntryInfo
    {
        return $this->LDAPEntry;
    }

    /**
     * Set the LDAPEntry.
     *
     * @param  LDAPEntryInfo $LDAPEntry
     * @return self
     */
    public function setLDAPEntry(LDAPEntryInfo $LDAPEntry): self
    {
        $this->LDAPEntry = $LDAPEntry;
        return $this;
    }
}
