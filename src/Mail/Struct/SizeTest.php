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
use Zimbra\Common\Enum\NumberComparison;

/**
 * SizeTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SizeTest extends FilterTest
{
    /**
     * Number comparison setting - over|under
     *
     * @var NumberComparison
     */
    #[Accessor(getter: "getNumberComparison", setter: "setNumberComparison")]
    #[SerializedName("numberComparison")]
    #[XmlAttribute]
    private ?NumberComparison $numberComparison;

    /**
     * Size value. Value can be specified in bytes (no suffix), kilobytes (50K), megabytes (50M) or gigabytes (2G)
     *
     * @var string
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $size = null;

    /**
     * Constructor
     *
     * @param int $index
     * @param bool $negative
     * @param NumberComparison $numberComparison
     * @param string $size
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?bool $negative = null,
        ?NumberComparison $numberComparison = null,
        ?string $size = null
    ) {
        parent::__construct($index, $negative);
        $this->numberComparison = $numberComparison;
        if (null !== $size) {
            $this->setSize($size);
        }
    }

    /**
     * Get numberComparison
     *
     * @return NumberComparison
     */
    public function getNumberComparison(): ?NumberComparison
    {
        return $this->numberComparison;
    }

    /**
     * Set numberComparison
     *
     * @param  NumberComparison $numberComparison
     * @return self
     */
    public function setNumberComparison(NumberComparison $numberComparison)
    {
        $this->numberComparison = $numberComparison;
        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param  string $size
     * @return self
     */
    public function setSize(string $size)
    {
        $this->size = $size;
        return $this;
    }
}
