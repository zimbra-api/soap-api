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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\LDAPEntryInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetLDAPEntriesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetLDAPEntriesResponse extends SoapResponse
{
    /**
     * LDAP entries
     * 
     * @var array
     */
    #[Accessor(getter: 'getLDAPEntries', setter: 'setLDAPEntries')]
    #[Type('array<Zimbra\Admin\Struct\LDAPEntryInfo>')]
    #[XmlList(inline: true, entry: 'LDAPEntry', namespace: 'urn:zimbraAdmin')]
    private $LDAPEntries = [];

    /**
     * Constructor
     *
     * @param array $LDAPEntries
     * @return self
     */
    public function __construct(array $LDAPEntries = [])
    {
        $this->setLDAPEntries($LDAPEntries);
    }

    /**
     * Set LDAPEntry informations
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
     * Get LDAPEntry informations
     *
     * @return array
     */
    public function getLDAPEntries(): array
    {
        return $this->LDAPEntries;
    }
}
