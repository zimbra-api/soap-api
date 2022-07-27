<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ResetPasswordRequest class
 * Reset Password
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ResetPasswordRequest extends SoapRequest
{
    /**
     * New Password to assign
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $password;

    /**
     * Constructor method for ResetPasswordRequest
     * 
     * @param string $password
     * @return self
     */
    public function __construct(string $password = '')
    {
        $this->setPassword($password);
    }

    /**
     * Gets the password.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets the password.
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ResetPasswordEnvelope(
            new ResetPasswordBody($this)
        );
    }
}
