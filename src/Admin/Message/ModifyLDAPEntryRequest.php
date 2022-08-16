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
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyLDAPEntryRequest class
 * Modify a LDAP Entry
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyLDAPEntryRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * A valid LDAP DN String (RFC 2253) that identifies the LDAP object
     * 
     * @var string
     */
    #[Accessor(getter: 'getDn', setter: 'setDn')]
    #[SerializedName(name: 'dn')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $dn;

    /**
     * Constructor
     * 
     * @param string $dn
     * @param array  $attrs
     * @return self
     */
    public function __construct(string $dn = '', array $attrs = [])
    {
        $this->setDn($dn)
             ->setAttrs($attrs);
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
        return new ModifyLDAPEntryEnvelope(
            new ModifyLDAPEntryBody($this)
        );
    }
}
