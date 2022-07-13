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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * WildcardExpansionQueryInfo class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class WildcardExpansionQueryInfo
{
    /**
     * Wildcard expansion string
     * 
     * @Accessor(getter="getStr", setter="setStr")
     * @SerializedName("str")
     * @Type("string")
     * @XmlAttribute
     */
    private $str;

    /**
     * If value is 1 (true), then the wildcard was expanded and the
     * matches are included in the search.  If value is <b>0 (false)</b> then the wildcard was not specific enough and
     * therefore no wildcard matches are included (exact-match *is* included in results).
     * 
     * @Accessor(getter="getExpanded", setter="setExpanded")
     * @SerializedName("expanded")
     * @Type("bool")
     * @XmlAttribute
     */
    private $expanded;

    /**
     * Number expanded
     * 
     * @Accessor(getter="getNumExpanded", setter="setNumExpanded")
     * @SerializedName("numExpanded")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numExpanded;

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        string $str = '',
        bool $expanded = FALSE,
        int $numExpanded = 0
    )
    {
        $this->setStr($str)
             ->setExpanded($expanded)
             ->setNumExpanded($numExpanded);
    }

    /**
     * Gets str
     *
     * @return string
     */
    public function getStr(): string
    {
        return $this->str;
    }

    /**
     * Sets str
     *
     * @param  string $str
     * @return self
     */
    public function setStr(string $str): self
    {
        $this->str = $str;
        return $this;
    }

    /**
     * Gets expanded
     *
     * @return bool
     */
    public function getExpanded(): bool
    {
        return $this->expanded;
    }

    /**
     * Sets expanded
     *
     * @param  bool $expanded
     * @return self
     */
    public function setExpanded(bool $expanded): self
    {
        $this->expanded = $expanded;
        return $this;
    }

    /**
     * Gets numExpanded
     *
     * @return int
     */
    public function getNumExpanded(): int
    {
        return $this->numExpanded;
    }

    /**
     * Sets numExpanded
     *
     * @param  int $numExpanded
     * @return self
     */
    public function setNumExpanded(int $numExpanded): self
    {
        $this->numExpanded = $numExpanded;
        return $this;
    }
}
