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
 * DeleteLDAPEntryRequest class
 * Delete a LDAP entry
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteLDAPEntryRequest extends Request
{
    /**
     * A valid LDAP DN String (RFC 2253) that describes the DN to delete
     * @Accessor(getter="getDn", setter="setDn")
     * @SerializedName("dn")
     * @Type("string")
     * @XmlAttribute
     */
    private $dn;

    /**
     * Constructor method for DeleteLDAPEntryRequest
     * 
     * @param  string $dn
     * @return self
     */
    public function __construct(string $dn)
    {
        $this->setDn($dn);
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new DeleteLDAPEntryEnvelope(
            new DeleteLDAPEntryBody($this)
        );
    }
}
