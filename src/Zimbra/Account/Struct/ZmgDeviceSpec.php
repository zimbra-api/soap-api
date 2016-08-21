<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Struct\Base;

/**
 * ZmgDeviceSpec struct class
 * Zmg Device specification
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZmgDeviceSpec extends Base
{
    /**
     * Constructor method for ZmgDeviceSpec
     * @param  string $appId App ID.
     * @param  string $registrationId The registration id of the device for push notifications.
     * @param  string $pushProvider The provider for pushing notifications to the device
     * @param  string $osName osName The name of the operating system installed on the device. Example - ios, android.
     * @param  string $osVersion The osVersion should be specified in the following formats
     *    a) majorVersion.minorVersion.microVersion
     *    b) majorVersion.minorVersion
     *    Example - iOS having versions like 7.0, 8.0.3, 8.1 etc.
     *    Android has OS version like 2.0, 3.1, 4.4, 5.0 etc
     * @param  int    $maxPayloadSize The maximum number of bytes allowed for the push notification payload
     *    Example - iOS 7.0 default maxPayloadSize is 256 bytes iOS 8.0 onwards default maxPayloadSize is 2048 bytes
     *    Android default maxPayloadSize is 4096 bytes In case, the maxPayloadSize is not specified the default payload size defined in the above examples will be used while sending push notifications.
     * @return self
     */
    public function __construct(
        $appId,
        $registrationId,
        $pushProvider,
        $osName = null,
        $osVersion = null,
        $maxPayloadSize = null
    )
    {
        parent::__construct();
        $this->setProperty('appId', trim($appId));
        $this->setProperty('registrationId', trim($registrationId));
        $this->setProperty('pushProvider', trim($pushProvider));
        if(null !== $osName)
        {
            $this->setProperty('osName', trim($osName));
        }
        if(null !== $osVersion)
        {
            $this->setProperty('osVersion', trim($osVersion));
        }
        if(null !== $maxPayloadSize)
        {
            $this->setProperty('maxPayloadSize', (int) $maxPayloadSize);
        }
    }

    /**
     * Gets app ID
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->getProperty('appId');
    }

    /**
     * Sets app ID
     *
     * @param  string $appId
     * @return self
     */
    public function setAppId($appId)
    {
        return $this->setProperty('appId', trim($appId));
    }

    /**
     * Gets registration Id
     *
     * @return string
     */
    public function getRegistrationId()
    {
        return $this->getProperty('registrationId');
    }

    /**
     * Sets registration Id
     *
     * @param  string $registrationId
     * @return self
     */
    public function setRegistrationId($registrationId)
    {
        return $this->setProperty('registrationId', trim($registrationId));
    }

    /**
     * Gets push provider
     *
     * @return string
     */
    public function getPushProvider()
    {
        return $this->getProperty('pushProvider');
    }

    /**
     * Sets push provider
     *
     * @param  string $pushProvider
     * @return self
     */
    public function setPushProvider($pushProvider)
    {
        return $this->setProperty('pushProvider', trim($pushProvider));
    }

    /**
     * Gets os name
     *
     * @return string
     */
    public function getOsName()
    {
        return $this->getProperty('osName');
    }

    /**
     * Sets os name
     *
     * @param  string $osName
     * @return self
     */
    public function setOsName($osName)
    {
        return $this->setProperty('osName', trim($osName));
    }

    /**
     * Gets os version
     *
     * @return string
     */
    public function getOsVersion()
    {
        return $this->getProperty('osVersion');
    }

    /**
     * Sets os version
     *
     * @param  string $osVersion
     * @return self
     */
    public function setOsVersion($osVersion)
    {
        return $this->setProperty('osVersion', trim($osVersion));
    }

    /**
     * Gets max payload size
     *
     * @return int
     */
    public function getMaxPayloadSize()
    {
        return $this->getProperty('maxPayloadSize');
    }

    /**
     * Sets max payload size
     *
     * @param  int $maxPayloadSize
     * @return self
     */
    public function setMaxPayloadSize($maxPayloadSize)
    {
        return $this->setProperty('maxPayloadSize', (int) $maxPayloadSize);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'zmgDevice')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'zmgDevice')
    {
        return parent::toXml($name);
    }
}
