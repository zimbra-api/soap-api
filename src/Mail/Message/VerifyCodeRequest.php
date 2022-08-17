<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * VerifyCodeRequest class
 * Validate the verification code sent to a device. After successful validation the
 * server sets the device email address as the value of zimbraCalendarReminderDeviceEmail account attribute.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VerifyCodeRequest extends SoapRequest
{
    /**
     * Device email address
     * 
     * @var string
     */
    #[Accessor(getter: 'getAddress', setter: 'setAddress')]
    #[SerializedName(name: 'a')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $address;

    /**
     * recovery account verification code
     * 
     * @var string
     */
    #[Accessor(getter: 'getVerificationCode', setter: 'setVerificationCode')]
    #[SerializedName(name: 'code')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $verificationCode;

    /**
     * Constructor
     *
     * @param  string $address
     * @param  string $verificationCode
     * @return self
     */
    public function __construct(
        ?string $address = NULL, ?string $verificationCode = NULL
    )
    {
        if (NULL !== $address) {
            $this->setAddress($address);
        }
        if (NULL !== $verificationCode) {
            $this->setVerificationCode($verificationCode);
        }
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get verificationCode
     *
     * @return string
     */
    public function getVerificationCode(): ?string
    {
        return $this->verificationCode;
    }

    /**
     * Set verificationCode
     *
     * @param  string $verificationCode
     * @return self
     */
    public function setVerificationCode(string $verificationCode): self
    {
        $this->verificationCode = $verificationCode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new VerifyCodeEnvelope(
            new VerifyCodeBody($this)
        );
    }
}
