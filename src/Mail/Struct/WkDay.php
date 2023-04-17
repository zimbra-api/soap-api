<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\WeekDay;
use Zimbra\Common\Struct\WkDayInterface;

/**
 * WkDay class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WkDay implements WkDayInterface
{
    /**
     * Weekday -  SU|MO|TU|WE|TH|FR|SA
     * 
     * @var WeekDay
     */
    #[Accessor(getter: 'getDay', setter: 'setDay')]
    #[SerializedName('day')]
    #[XmlAttribute]
    private WeekDay $day;

    /**
     * Week number.  [[+]|-]num: 1 to 53
     * 
     * @var int
     */
    #[Accessor(getter: 'getOrdWk', setter: 'setOrdWk')]
    #[SerializedName('ordwk')]
    #[Type('int')]
    #[XmlAttribute]
    private $ordWk;

    /**
     * Constructor
     *
     * @param  WeekDay $day
     * @param  int $ordWk
     * @return self
     */
    public function __construct(?WeekDay $day = NULL, ?int $ordWk = NULL)
    {
        $this->setDay($day ?? WeekDay::SUNDAY);
        if (NULL !== $ordWk) {
            $this->setOrdWk($ordWk);
        }
    }

    /**
     * Get day
     *
     * @return WeekDay
     */
    public function getDay(): WeekDay
    {
        return $this->day;
    }

    /**
     * Set day
     *
     * @param  WeekDay $day
     * @return self
     */
    public function setDay(WeekDay $day): self
    {
        $this->day = $day;
        return $this;
    }

    /**
     * Get ordWk
     *
     * @return int
     */
    public function getOrdWk(): ?int
    {
        return $this->ordWk;
    }

    /**
     * Set ordWk
     *
     * @param  int $ordWk
     * @return self
     */
    public function setOrdWk(int $ordWk): self
    {
        if($ordWk != 0 && abs($ordWk) < 54) {
            $this->ordWk = $ordWk;
        }
        return $this;
    }
}
