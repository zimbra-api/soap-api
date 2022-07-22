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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * SetPasswordRequest class
 * Set Password
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SetPasswordRequest extends Request
{
    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * New password
     * @Accessor(getter="getNewPassword", setter="setNewPassword")
     * @SerializedName("newPassword")
     * @Type("string")
     * @XmlAttribute
     */
    private $newPassword;

    /**
     * Constructor method for SetPasswordRequest
     * 
     * @param string $id
     * @param string $newPassword
     * @return self
     */
    public function __construct(string $id = '', string $newPassword = '')
    {
        $this->setId($id)
             ->setNewPassword($newPassword);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets newPassword
     *
     * @return string
     */
    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    /**
     * Sets newPassword
     *
     * @param  string $newPassword
     * @return self
     */
    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new SetPasswordEnvelope(
            new SetPasswordBody($this)
        );
    }
}
