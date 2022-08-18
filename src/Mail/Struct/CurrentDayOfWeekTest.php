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

/**
 * CurrentDayOfWeekTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CurrentDayOfWeekTest extends FilterTest
{
    /**
     * Comma separated day of week indices
     * 
     * @Accessor(getter="getValues", setter="setValues")
     * @SerializedName("value")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getValues', setter: 'setValues')]
    #[SerializedName('value')]
    #[Type('string')]
    #[XmlAttribute]
    private $values;

    /**
     * Constructor
     * 
     * @param int $index
     * @param bool $negative
     * @param string $values
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?string $values = NULL
    )
    {
    	parent::__construct($index, $negative);
        if (NULL !== $values) {
            $this->setValues($values);
        }
    }

    /**
     * Get values
     *
     * @return string
     */
    public function getValues(): ?string
    {
        return $this->values;
    }

    /**
     * Set values
     *
     * @param  string $values
     * @return self
     */
    public function setValues(string $values)
    {
        $this->values = $values;
        return $this;
    }
}
