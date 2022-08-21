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
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CheckExchangeAuthRequest request class
 * Check Exchange Authorisation
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckExchangeAuthRequest extends SoapRequest
{
    /**
     * Exchange auth details
     * 
     * @Accessor(getter="getAuth", setter="setAuth")
     * @SerializedName("auth")
     * @Type("Zimbra\Admin\Struct\ExchangeAuthSpec")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var ExchangeAuthSpec
     */
    #[Accessor(getter: 'getAuth', setter: 'setAuth')]
    #[SerializedName('auth')]
    #[Type(ExchangeAuthSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?ExchangeAuthSpec $auth;

    /**
     * Constructor
     * 
     * @param  ExchangeAuthSpec  $auth
     * @return self
     */
    public function __construct(?ExchangeAuthSpec $auth = NULL)
    {
        $this->auth = $auth;
    }

    /**
     * Set Exchange Auth
     *
     * @param  ExchangeAuthSpec $auth
     * @return self
     */
    public function setAuth(ExchangeAuthSpec $auth): self
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * Get Exchange Auth
     *
     * @return ExchangeAuthSpec
     */
    public function getAuth(): ?ExchangeAuthSpec
    {
        return $this->auth;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckExchangeAuthEnvelope(
            new CheckExchangeAuthBody($this)
        );
    }
}
