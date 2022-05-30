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
     * @Accessor(getter="getLDAPentries", setter="setLDAPentries")
     * @SerializedName("LDAPEntry")
     * @Type("array<Zimbra\Admin\Struct\LDAPEntryInfo>")
     * @XmlList(inline = true, entry = "LDAPEntry")
     */
    private $LDAPentries = [];

    /**
     * Constructor method for GetLDAPEntriesResponse
     *
     * @param array $LDAPentries
     * @return self
     */
    public function __construct(array $LDAPentries = [])
    {
        $this->setLDAPentries($LDAPentries);
    }

    /**
     * Add a LDAPEntry information
     *
     * @param  LDAPEntryInfo $LDAPEntry
     * @return self
     */
    public function addLDAPentry(LDAPEntryInfo $LDAPentry): self
    {
        $this->LDAPentries[] = $LDAPentry;
        return $this;
    }

    /**
     * Sets LDAPEntry informations
     *
     * @param  array $LDAPentries
     * @return self
     */
    public function setLDAPentries(array $LDAPentries): self
    {
        $this->LDAPentries = [];
        foreach ($LDAPentries as $LDAPEntry) {
            if ($LDAPEntry instanceof LDAPEntryInfo) {
                $this->LDAPentries[] = $LDAPEntry;
            }
        }
        return $this;
    }

    /**
     * Gets LDAPEntry informations
     *
     * @return array
     */
    public function getLDAPentries(): array
    {
        return $this->LDAPentries;
    }
}
