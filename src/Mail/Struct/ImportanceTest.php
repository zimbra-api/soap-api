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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\Importance;

/**
 * ImportanceTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="importanceTest")
 */
class ImportanceTest extends FilterTest
{
    /**
     * Importance - high|normal|low
     * @Accessor(getter="getImportance", setter="setImportance")
     * @SerializedName("imp")
     * @Type("Zimbra\Enum\Importance")
     * @XmlAttribute
     */
    private $importance;

    /**
     * Constructor method for ImportanceTest
     * 
     * @param int $index
     * @param bool $negative
     * @param Importance $importance
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $negative = NULL,
        ?Importance $importance = NULL
    )
    {
    	parent::__construct($index, $negative);
        if ($importance instanceof Importance) {
            $this->setImportance($importance);
        }
    }

    /**
     * Gets importance
     *
     * @return Importance
     */
    public function getImportance(): ?Importance
    {
        return $this->importance;
    }

    /**
     * Sets importance
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