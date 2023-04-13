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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Mail\Struct\AppointmentIdAndDate;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAppointmentIdsInRangeResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAppointmentIdsInRangeResponse extends SoapResponse
{
    /**
     * Appointment data
     * 
     * @var array
     */
    #[Accessor(getter: 'getAppointmentData', setter: 'setAppointmentData')]
    #[Type('array<Zimbra\Mail\Struct\AppointmentIdAndDate>')]
    #[XmlList(inline: true, entry: 'apptData', namespace: 'urn:zimbraMail')]
    private $appointmentData = [];

    /**
     * Constructor
     *
     * @param  array $appointmentData
     * @return self
     */
    public function __construct(
        array $appointmentData = []
    )
    {
        $this->setAppointmentData($appointmentData);
    }

    /**
     * Set appointmentData
     *
     * @param  array $appointmentData
     * @return self
     */
    public function setAppointmentData(array $appointmentData): self
    {
        $this->appointmentData = array_filter(
            $appointmentData, static fn ($match) => $match instanceof AppointmentIdAndDate
        );
        return $this;
    }

    /**
     * Get appointmentData
     *
     * @return array
     */
    public function getAppointmentData(): array
    {
        return $this->appointmentData;
    }
}
