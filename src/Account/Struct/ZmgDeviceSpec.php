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
 * ZmgDeviceSpec struct class
 * Zmg Device specification
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="zmgDevice")
 */
class ZmgDeviceSpec
{
    /**
     * App ID.
     * @Accessor(getter="getAppId", setter="setAppId")
     * @SerializedName("appId")
     * @Type("string")
     * @XmlAttribute
     */
    private $appId;

    /**
     * The registration id of the device for push notifications.
     * @Accessor(getter="getRegistrationId", setter="setRegistrationId")
     * @SerializedName("registrationId")
     * @Type("string")
     * @XmlAttribute
     */
    private $registrationId;

    /**
     * The provider for pushing notifications to the device
     * @Accessor(getter="getPushProvider", setter="setPushProvider")
     * @SerializedName("pushProvider")
     * @Type("string")
     * @XmlAttribute
     */
    private $pushProvider;

    /**
     * The name of the operating system installed on the device. Example - ios, android.
     * @Accessor(getter="getOSName", setter="setOSName")
     * @SerializedName("osName")
     * @Type("string")
     * @XmlAttribute
     */
    private $osName;

    /**
     * The osVersion should be specified in the following formats
     *    a) majorVersion.minorVersion.microVersion
     *    b) majorVersion.minorVersion
     *    Example - iOS having versions like 7.0, 8.0.3, 8.1 etc.
     *    Android has OS version like 2.0, 3.1, 4.4, 5.0 etc
     * @Accessor(getter="getOSVersion", setter="setOSVersion")
     * @SerializedName("osVersion")
     * @Type("string")
     * @XmlAttribute
     */
    private $osVersion;

    /**
     * The maximum number of bytes allowed for the push notification payload
     *    Example - iOS 7.0 default maxPayloadSize is 256 bytes iOS 8.0 onwards default maxPayloadSize is 2048 bytes
     *    Android default maxPayloadSize is 4096 bytes In case, the maxPayloadSize is not specified the default payload size defined in the above examples will be used while sending push notifications.
     * @Accessor(getter="getMaxPayloadSize", setter="setMaxPayloadSize")
     * @SerializedName("maxPayloadSize")
     * @Type("int")
     * @XmlAttribute
     */
    private $maxPayloadSize;

    /**
     * Constructor method for ZmgDeviceSpec
     * @param  string $appId
     * @param  string $registrationId
     * @param  string $pushProvider
     * @param  string $osName
     * @param  string $osVersion
     * @param  int    $maxPayloadSize
     * @return self
     */
    public function __construct(
        string $appId,
        string $registrationId,
        string $pushProvider,
        ?string $osName = NULL,
        ?string $osVersion = NULL,
        ?int $maxPayloadSize = NULL
    )
    {
        $this->setAppId($appId)
            ->setRegistrationId($registrationId)
            ->setPushProvider($pushProvider);
        if (NULL !== $osName) {
            $this->setOSName($osName);
        }
        if (NULL !== $osVersion) {
            $this->setOSVersion($osVersion);
        }
        if (NULL !== $maxPayloadSize) {
            $this->setMaxPayloadSize($maxPayloadSize);
        }
    }

    /**
     * Gets app ID
     *
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * Sets app ID
     *
     * @param  string $appId
     * @return self
     */
    public function setAppId(string $appId): self
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * Gets registration Id
     *
     * @return string
     */
    public function getRegistrationId(): string
    {
        return $this->registrationId;
    }

    /**
     * Sets registration Id
     *
     * @param  string $registrationId
     * @return self
     */
    public function setRegistrationId(string $registrationId): self
    {
        $this->registrationId = $registrationId;
        return $this;
    }

    /**
     * Gets push provider
     *
     * @return string
     */
    public function getPushProvider(): string
    {
        return $this->pushProvider;
    }

    /**
     * Sets push provider
     *
     * @param  string $pushProvider
     * @return self
     */
    public function setPushProvider(string $pushProvider): self
    {
        $this->pushProvider = $pushProvider;
        return $this;
    }

    /**
     * Gets os name
     *
     * @return string
     */
    public function getOsName(): ?string
    {
        return $this->osName;
    }

    /**
     * Sets os name
     *
     * @param  string $osName
     * @return self
     */
    public function setOsName(string $osName): self
    {
        $this->osName = $osName;
        return $this;
    }

    /**
     * Gets os version
     *
     * @return string
     */
    public function getOsVersion(): ?string
    {
        return $this->osVersion;
    }

    /**
     * Sets os version
     *
     * @param  string $osVersion
     * @return self
     */
    public function setOsVersion(string $osVersion): self
    {
        $this->osVersion = $osVersion;
        return $this;
    }

    /**
     * Gets max payload size
     *
     * @return int
     */
    public function getMaxPayloadSize(): ?int
    {
        return $this->maxPayloadSize;
    }

    /**
     * Sets max payload size
     *
     * @param  int $maxPayloadSize
     * @return self
     */
    public function setMaxPayloadSize(int $maxPayloadSize): self
    {
        $this->maxPayloadSize = $maxPayloadSize;
        return $this;
    }
}