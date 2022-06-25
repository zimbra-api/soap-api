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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};

/**
 * FilterVariables struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FilterVariables extends FilterAction
{
    /**
     * Filter variables
     * @Accessor(getter="getVariables", setter="setVariables")
     * @SerializedName("filterVariable")
     * @Type("array<Zimbra\Mail\Struct\FilterVariable>")
     * @XmlList(inline=true, entry="filterVariable")
     */
    private $variables = [];

    /**
     * Constructor method for FilterVariables
     * 
     * @param int $index
     * @param array $variables
     * @return self
     */
    public function __construct(?int $index = NULL, array $variables = [])
    {
    	parent::__construct($index);
        $this->setVariables($variables);
    }

    /**
     * Gets variables
     *
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * Sets variables
     *
     * @param  array $variables
     * @return self
     */
    public function setVariables(array $variables)
    {
        $this->variables = array_filter($variables, static fn ($variable) => $variable instanceof FilterVariable);
        return $this;
    }

    /**
     * Add variable
     *
     * @param  FilterVariable $variable
     * @return self
     */
    public function addVariable(FilterVariable $variable): self
    {
        $this->variables[] = $variable;
        return $this;
    }
}
