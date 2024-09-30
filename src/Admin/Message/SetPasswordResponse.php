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
use Zimbra\Common\Struct\SoapResponse;

/**
 * SetPasswordResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SetPasswordResponse extends SoapResponse
{
    /**
     * If the password had violated any policy, it is returned in this> element,
     * and the password is still set successfully.
     *
     * @var string
     */
    #[Accessor(getter: "getMessage", setter: "setMessage")]
    #[SerializedName("message")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $message;

    /**
     * Constructor
     *
     * @param string $message
     * @return self
     */
    public function __construct(?string $message = null)
    {
        if (null !== $message) {
            $this->setMessage($message);
        }
    }

    /**
     * Get the message.
     *
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set the message.
     *
     * @param  string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
