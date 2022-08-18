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
use Zimbra\Common\Enum\DateComparison;

/**
 * CurrentTimeTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CurrentTimeTest extends FilterTest
{
    /**
     * Date comparison setting - before|after
     * 
     * @var DateComparison
     */
    #[Accessor(getter: 'getDateComparison', setter: 'setDateComparison')]
    #[SerializedName('dateComparison')]
    #[Type('Enum<Zimbra\Common\Enum\DateComparison>')]
    #[XmlAttribute]
    private $dateComparison;

    /**
     * Time in HHmm format
     * 
     * @var string
     */
    #[Accessor(getter: 'getTime', setter: 'setTime')]
    #[SerializedName('time')]
    #[Type('string')]
    #[XmlAttribute]
    private $time;

    /**
     * Constructor
     * 
     * @param int $index
     * @param bool $negative
     * @param DateComparison $dateComparison
     * @param string $time
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?DateComparison $dateComparison = NULL,
        ?string $time = NULL
    )
    {
    	parent::__construct($index, $negative);
        if ($dateComparison instanceof DateComparison) {
            $this->setDateComparison($dateComparison);
        }
        if (NULL !== $time) {
            $this->setTime($time);
        }
    }

    /**
     * Get dateComparison
     *
     * @return DateComparison
     */
    public function getDateComparison(): ?DateComparison
    {
        return $this->dateComparison;
    }

    /**
     * Set dateComparison
     *
     * @param  DateComparison $dateComparison
     * @return self
     */
    public function setDateComparison(DateComparison $dateComparison)
    {
        $this->dateComparison = $dateComparison;
        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * Set time
     *
     * @param  string $time
     * @return self
     */
    public function setTime(string $time)
    {
        $this->time = $time;
        return $this;
    }
}
