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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * RenameLDAPEntryRequest class
 * Rename LDAP Entry
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RenameLDAPEntryRequest extends Request
{
    /**
     * A valid LDAP DN String (RFC 2253) that identifies the LDAP object
     * @Accessor(getter="getDn", setter="setDn")
     * @SerializedName("dn")
     * @Type("string")
     * @XmlAttribute
     */
    private $dn;

    /**
     * New DN - a valid LDAP DN String (RFC 2253) that describes the new DN to be given to the LDAP object
     * @Accessor(getter="getNewDn", setter="setNewDn")
     * @SerializedName("new_dn")
     * @Type("string")
     * @XmlAttribute
     */
    private $newDn;

    /**
     * Constructor method for RenameLDAPEntryRequest
     * 
     * @param string $dn
     * @param string $newDn
     * @return self
     */
    public function __construct(string $dn, string $newDn)
    {
        $this->setDn($dn)
             ->setNewDn($newDn);
    }

    /**
     * Gets dn
     *
     * @return string
     */
    public function getDn(): string
    {
        return $this->dn;
    }

    /**
     * Sets dn
     *
     * @param  string $dn
     * @return self
     */
    public function setDn(string $dn): self
    {
        $this->dn = $dn;
        return $this;
    }

    /**
     * Gets newDn
     *
     * @return string
     */
    public function getNewDn(): ?string
    {
        return $this->newDn;
    }

    /**
     * Sets newDn
     *
     * @param  string $newDn
     * @return self
     */
    public function setNewDn(string $newDn): self
    {
        $this->newDn = $newDn;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RenameLDAPEntryEnvelope(
            new RenameLDAPEntryBody($this)
        );
    }
}
