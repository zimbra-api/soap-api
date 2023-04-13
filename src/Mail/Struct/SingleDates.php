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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\{DtValInterface, SingleDatesInterface};

/**
 * SingleDates class
 * Single dates information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SingleDates implements RecurRuleBase, SingleDatesInterface
{
    /**
     * TZID
     * 
     * @var string
     */
    #[Accessor(getter: 'getTimezone', setter: 'setTimezone')]
    #[SerializedName('tz')]
    #[Type('string')]
    #[XmlAttribute]
    private $timezone;

    /**
     * Information on start date/time and end date/time or duration
     * 
     * @var array
     */
    #[Accessor(getter: 'getDtVals', setter: 'setDtVals')]
    #[Type('array<Zimbra\Mail\Struct\DtVal>')]
    #[XmlList(inline: true, entry: 'dtval', namespace: 'urn:zimbraMail')]
    private $dtVals = [];

    /**
     * Constructor
     *
     * @param  string $timezone
     * @param  array $dtVals
     * @return self
     */
    public function __construct(?string $timezone = NULL, array $dtVals = [])
    {
        $this->setDtVals($dtVals);
        if (NULL !== $timezone) {
            $this->setTimezone($timezone);
        }
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * Set timezone
     *
     * @param  string $timezone
     * @return self
     */
    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Add dtVal
     *
     * @param  DtValInterface $dtVal
     * @return self
     */
    public function addDtVal(DtValInterface $dtVal): self
    {
        $this->dtVals[] = $dtVal;
        return $this;
    }

    /**
     * Set dtVals
     *
     * @param  array $dtVals
     * @return self
     */
    public function setDtVals(array $dtVals): self
    {
        $this->dtVals = array_filter(
            $dtVals, static fn ($dtVal) => $dtVal instanceof DtValInterface
        );
        return $this;
    }

    /**
     * Get dtVals
     *
     * @return array
     */
    public function getDtVals(): array
    {
        return $this->dtVals;
    }
}
