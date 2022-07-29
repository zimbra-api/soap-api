<?php declare(strict_types=1);
/**
 * This file is nextAlarm of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * UpdatedAlarmInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class UpdatedAlarmInfo
{
    /**
     * Calendar item ID
     * @Accessor(getter="getCalItemId", setter="setCalItemId")
     * @SerializedName("calItemId")
     * @Type("string")
     * @XmlAttribute
     */
    private $calItemId;

    /**
     * Updated alarm information
     * @Accessor(getter="getAlarmData", setter="setAlarmData")
     * @SerializedName("alarmData")
     * @Type("Zimbra\Mail\Struct\AlarmDataInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?AlarmDataInfo $alarmData = NULL;

    /**
     * Constructor method
     * 
     * @param string $calItemId
     * @param AlarmDataInfo $alarmData
     * @return self
     */
    public function __construct(
        string $calItemId = '',
        ?AlarmDataInfo $alarmData = NULL
    )
    {
        $this->setCalItemId($calItemId);
        if ($alarmData instanceof AlarmDataInfo) {
            $this->setAlarmData($alarmData);
        }
    }

    /**
     * Get calItemId
     *
     * @return string
     */
    public function getCalItemId(): string
    {
        return $this->calItemId;
    }

    /**
     * Set calItemId
     *
     * @param  string $calItemId
     * @return self
     */
    public function setCalItemId(string $calItemId): self
    {
        $this->calItemId = $calItemId;
        return $this;
    }

    /**
     * Get alarmData
     *
     * @return AlarmDataInfo
     */
    public function getAlarmData(): ?AlarmDataInfo
    {
        return $this->alarmData;
    }

    /**
     * Set alarmData
     *
     * @param  AlarmDataInfo $alarmData
     * @return self
     */
    public function setAlarmData(AlarmDataInfo $alarmData): self
    {
        $this->alarmData = $alarmData;
        return $this;
    }
}
