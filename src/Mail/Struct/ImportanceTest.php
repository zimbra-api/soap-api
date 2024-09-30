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
use Zimbra\Common\Enum\Importance;

/**
 * ImportanceTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ImportanceTest extends FilterTest
{
    /**
     * Importance - high|normal|low
     *
     * @Accessor(getter="getImportance", setter="setImportance")
     * @SerializedName("imp")
     * @Type("Enum<Zimbra\Common\Enum\Importance>")
     * @XmlAttribute
     *
     * @var Importance
     */
    #[Accessor(getter: "getImportance", setter: "setImportance")]
    #[SerializedName("imp")]
    #[Type("Enum<Zimbra\Common\Enum\Importance>")]
    #[XmlAttribute]
    private ?Importance $importance;

    /**
     * Constructor
     *
     * @param int $index
     * @param bool $negative
     * @param Importance $importance
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?bool $negative = null,
        ?Importance $importance = null
    ) {
        parent::__construct($index, $negative);
        $this->importance = $importance;
    }

    /**
     * Get importance
     *
     * @return Importance
     */
    public function getImportance(): ?Importance
    {
        return $this->importance;
    }

    /**
     * Set importance
     *
     * @param  Importance $importance
     * @return self
     */
    public function setImportance(Importance $importance)
    {
        $this->importance = $importance;
        return $this;
    }
}
