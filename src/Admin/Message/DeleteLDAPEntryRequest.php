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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DeleteLDAPEntryRequest class
 * Delete a LDAP entry
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeleteLDAPEntryRequest extends SoapRequest
{
    /**
     * A valid LDAP DN String (RFC 2253) that describes the DN to delete
     * 
     * @var string
     */
    #[Accessor(getter: 'getDn', setter: 'setDn')]
    #[SerializedName('dn')]
    #[Type('string')]
    #[XmlAttribute]
    private $dn;

    /**
     * Constructor
     * 
     * @param  string $dn
     * @return self
     */
    public function __construct(string $dn = '')
    {
        $this->setDn($dn);
    }

    /**
     * Get dn
     *
     * @return string
     */
    public function getDn(): string
    {
        return $this->dn;
    }

    /**
     * Set dn
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DeleteLDAPEntryEnvelope(
            new DeleteLDAPEntryBody($this)
        );
    }
}
