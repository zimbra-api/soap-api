<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Fault;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * Fault reason class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Reason
{
    /**
     * @Accessor(getter="getText", setter="setText")
     * @SerializedName("Text")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="http://www.w3.org/2003/05/soap-envelope")
     * @var string
     */
    private $text;

    /**
     * Constructor
     * 
     * @param string $text
     * @return self
     */
    public function __construct(?string $text = NULL)
    {
        if (NULL !== $text) {
            $this->setText($text);
        }
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param  string $text
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }
}
