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
 * SendVerificationCodeRequest class
 * SendVerificationCodeRequest results in a random verification code being generated and sent to a device.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SendVerificationCodeRequest extends SoapRequest
{
    /**
     * Device email address
     * 
     * @Accessor(getter="getAddress", setter="setAddress")
     * @SerializedName("a")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAddress', setter: 'setAddress')]
    #[SerializedName('a')]
    #[Type('string')]
    #[XmlAttribute]
    private $address;

    /**
     * Constructor
     *
     * @param  string $address
     * @return self
     */
    public function __construct(?string $address = NULL)
    {
        if (NULL !== $address) {
            $this->setAddress($address);
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SendVerificationCodeEnvelope(
            new SendVerificationCodeBody($this)
        );
    }
}
