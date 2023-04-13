<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\DistributionListBy;

/**
 * DistributionListSelector class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListSelector
{
    /**
     * Distribution list by
     * 
     * @var DistributionListBy
     */
    #[Accessor(getter: 'getBy', setter: 'setBy')]
    #[SerializedName('by')]
    #[Type('Enum<Zimbra\Common\Enum\DistributionListBy>')]
    #[XmlAttribute]
    private DistributionListBy $by;

    /**
     * Value
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
     * @param  DistributionListBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?DistributionListBy $by = NULL, ?string $value = NULL)
    {
        $this->setBy($by ?? DistributionListBy::NAME);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by selector
     *
     * @return DistributionListBy
     */
    public function getBy(): DistributionListBy
    {
        return $this->by;
    }

    /**
     * Set by selector
     *
     * @param  DistributionListBy $by
     * @return self
     */
    public function setBy(DistributionListBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
