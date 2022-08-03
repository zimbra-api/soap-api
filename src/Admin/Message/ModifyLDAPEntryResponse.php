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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * ModifyLDAPEntryResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyLDAPEntryResponse implements SoapResponseInterface
{
    /**
     * Information about LDAP entry
     * @Accessor(getter="getLDAPEntry", setter="setLDAPEntry")
     * @SerializedName("LDAPEntry")
     * @Type("Zimbra\Admin\Struct\LDAPEntryInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?LDAPEntryInfo $LDAPEntry = NULL;

    /**
     * Constructor method for ModifyLDAPEntryResponse
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
     * Set the LDAPEntryInfo.
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
