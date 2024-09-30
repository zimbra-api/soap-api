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
 * SetPasswordRequest class
 * Set Password
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SetPasswordRequest extends SoapRequest
{
    /**
     * Zimbra ID
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * New password
     *
     * @Accessor(getter="getNewPassword", setter="setNewPassword")
     * @SerializedName("newPassword")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getNewPassword", setter: "setNewPassword")]
    #[SerializedName("newPassword")]
    #[Type("string")]
    #[XmlAttribute]
    private $newPassword;

    /**
     * dry run
     *
     * @Accessor(getter="isDryRun", setter="setDryRun")
     * @SerializedName("dryRun")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isDryRun", setter: "setDryRun")]
    #[SerializedName("dryRun")]
    #[Type("bool")]
    #[XmlAttribute]
    private $dryRun;

    /**
     * Constructor
     *
     * @param string $id
     * @param string $newPassword
     * @param bool $dryRun
     * @return self
     */
    public function __construct(
        string $id = "",
        string $newPassword = "",
        ?bool $dryRun = false
    ) {
        $this->setId($id)->setNewPassword($newPassword);
        if (null !== $dryRun) {
            $this->setDryRun($dryRun);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get newPassword
     *
     * @return string
     */
    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    /**
     * Set newPassword
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
     * Get dryRun
     *
     * @return bool
     */
    public function isDryRun(): ?bool
    {
        return $this->dryRun;
    }

    /**
     * Set dryRun
     *
     * @param  bool $dryRun
     * @return self
     */
    public function setDryRun(bool $dryRun): self
    {
        $this->dryRun = $dryRun;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SetPasswordEnvelope(new SetPasswordBody($this));
    }
}
