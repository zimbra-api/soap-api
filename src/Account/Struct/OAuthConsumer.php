<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * OAuthConsumer struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="OAuthConsumer")
 */
class OAuthConsumer
{
    /**
     * @Accessor(getter="getAccessToken", setter="setAccessToken")
     * @SerializedName("accessToken")
     * @Type("string")
     * @XmlAttribute
     */
    private $accessToken;

    /**
     * @Accessor(getter="getApprovedOn", setter="setApprovedOn")
     * @SerializedName("approvedOn")
     * @Type("string")
     * @XmlAttribute
     */
    private $approvedOn;

    /**
     * @Accessor(getter="getApplicationName", setter="setApplicationName")
     * @SerializedName("appName")
     * @Type("string")
     * @XmlAttribute
     */
    private $applicationName;

    /**
     * @Accessor(getter="getDevice", setter="setDevice")
     * @SerializedName("device")
     * @Type("string")
     * @XmlAttribute
     */
    private $device;

    /**
     * Constructor method for OAuthConsumer
     *
     * @param string $accessToken
     * @param string $approvedOn
     * @param string $applicationName
     * @param string $device
     * @return self
     */
    public function __construct(
        ?string $accessToken = NULL, ?string $approvedOn = NULL, ?string $applicationName = NULL, ?string $device = NULL
    )
    {
        if (NULL !== $accessToken) {
            $this->setAccessToken($accessToken);
        }
        if (NULL !== $approvedOn) {
            $this->setApprovedOn($approvedOn);
        }
        if (NULL !== $applicationName) {
            $this->setApplicationName($applicationName);
        }
        if (NULL !== $device) {
            $this->setDevice($device);
        }
    }

    /**
     * Gets accessToken
     *
     * @return string
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * Sets accessToken
     *
     * @param  string $accessToken
     * @return self
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * Gets approvedOn
     *
     * @return string
     */
    public function getApprovedOn(): ?string
    {
        return $this->approvedOn;
    }

    /**
     * Sets approvedOn
     *
     * @param  string $approvedOn
     * @return self
     */
    public function setApprovedOn(string $approvedOn): self
    {
        $this->approvedOn = $approvedOn;
        return $this;
    }

    /**
     * Gets applicationName
     *
     * @return string
     */
    public function getApplicationName(): ?string
    {
        return $this->applicationName;
    }

    /**
     * Sets applicationName
     *
     * @param  string $applicationName
     * @return self
     */
    public function setApplicationName(string $applicationName): self
    {
        $this->applicationName = $applicationName;
        return $this;
    }

    /**
     * Gets device
     *
     * @return string
     */
    public function getDevice(): ?string
    {
        return $this->device;
    }

    /**
     * Sets device
     *
     * @param  string $device
     * @return self
     */
    public function setDevice(string $device): self
    {
        $this->device = $device;
        return $this;
    }
}
