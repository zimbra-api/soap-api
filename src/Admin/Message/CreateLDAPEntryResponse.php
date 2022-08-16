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
 * CreateLDAPEntryResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateLDAPEntryResponse extends SoapResponse
{
    /**
     * Information about the newly created LDAPEntry
     * 
     * @var LDAPEntryInfo
     */
    #[Accessor(getter: 'getLDAPEntry', setter: 'setLDAPEntry')]
    #[SerializedName(name: 'LDAPEntry')]
    #[Type(name: LDAPEntryInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $LDAPEntry;

    /**
     * Constructor
     *
     * @param LDAPEntryInfo $LDAPEntry
     * @return self
     */
    public function __construct(?LDAPEntryInfo $LDAPEntry = NULL)
    {
        if ($LDAPEntry instanceof LDAPEntryInfo) {
            $this->setLDAPEntry($LDAPEntry);
        }
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
