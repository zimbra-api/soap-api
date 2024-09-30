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
use Zimbra\Common\Struct\NumAttrInterface;

/**
 * NumAttr class
 * Number attribute
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NumAttr implements NumAttrInterface
{
    /**
     * Number
     *
     * @var int
     */
    #[Accessor(getter: "getNum", setter: "setNum")]
    #[SerializedName("num")]
    #[Type("int")]
    #[XmlAttribute]
    private $num;

    /**
     * Constructor
     *
     * @param  int $num
     * @return self
     */
    public function __construct(int $num = 0)
    {
        $this->setNum($num);
    }

    /**
     * Get num
     *
     * @return int
     */
    public function getNum(): int
    {
        return $this->num;
    }

    /**
     * Set num
     *
     * @param  int $num
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }
}
