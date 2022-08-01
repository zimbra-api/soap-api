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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlValue};

/**
 * RejectAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RejectAction extends FilterAction
{
    /**
     * Content name
     * @Accessor(getter="getContent", setter="setContent")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $content;

    /**
     * Constructor method for RejectAction
     * 
     * @param int $index
     * @param string $content
     * @return self
     */
    public function __construct(?int $index = NULL, ?string $content = NULL)
    {
    	parent::__construct($index);
        if (NULL !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }
}
