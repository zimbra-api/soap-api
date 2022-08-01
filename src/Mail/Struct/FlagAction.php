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
 * FlagAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FlagAction extends FilterAction
{
    /**
     * Flag name - flagged|read|priority
     * @Accessor(getter="getFlag", setter="setFlag")
     * @SerializedName("flagName")
     * @Type("string")
     * @XmlAttribute
     */
    private $flag;

    /**
     * Constructor method for FlagAction
     * 
     * @param int $index
     * @param string $flag
     * @return self
     */
    public function __construct(?int $index = NULL, ?string $flag = NULL)
    {
    	parent::__construct($index);
        if (NULL !== $flag) {
            $this->setFlag($flag);
        }
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }

    /**
     * Set flag
     *
     * @param  string $flag
     * @return self
     */
    public function setFlag(string $flag)
    {
        $this->flag = $flag;
        return $this;
    }
}
