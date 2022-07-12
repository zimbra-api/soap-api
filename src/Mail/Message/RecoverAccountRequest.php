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
use Zimbra\Common\Enum\{Channel, RecoverAccountOperation};
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * RecoverAccountRequest class
 * Recover account request
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RecoverAccountRequest extends Request
{
    /**
     * operation
     * 
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Common\Enum\RecoverAccountOperation")
     * @XmlAttribute
     */
    private RecoverAccountOperation $op;

    /**
     * Email
     * 
     * @Accessor(getter="getEmail", setter="setEmail")
     * @SerializedName("email")
     * @Type("string")
     * @XmlAttribute
     */
    private $email;

    /**
     * Channel
     * 
     * @Accessor(getter="getChannel", setter="setChannel")
     * @SerializedName("channel")
     * @Type("Zimbra\Common\Enum\Channel")
     * @XmlAttribute
     */
    private ?Channel $channel = NULL;

    /**
     * Constructor method for RecoverAccountRequest
     *
     * @param  RecoverAccountOperation $op
     * @param  string $email
     * @param  Channel $channel
     * @return self
     */
    public function __construct(
        ?RecoverAccountOperation $op = NULL,
        string $email = '',
        ?Channel $channel = NULL
    )
    {
        $this->setOp($op ?? RecoverAccountOperation::GET_RECOVERY_ACCOUNT())
             ->setEmail($email);
        if ($channel instanceof Channel) {
            $this->setChannel($channel);
        }
    }

    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Sets email
     *
     * @param  string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Gets type
     *
     * @return RecoverAccountOperation
     */
    public function getOp(): ?RecoverAccountOperation
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  RecoverAccountOperation $type
     * @return self
     */
    public function setOp(RecoverAccountOperation $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets channel
     *
     * @return Channel
     */
    public function getChannel(): ?Channel
    {
        return $this->channel;
    }

    /**
     * Sets channel
     *
     * @param  Channel $channel
     * @return self
     */
    public function setChannel(Channel $channel): self
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RecoverAccountEnvelope(
            new RecoverAccountBody($this)
        );
    }
}
