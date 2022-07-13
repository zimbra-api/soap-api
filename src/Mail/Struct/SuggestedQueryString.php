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

use JMS\Serializer\Annotation\{Accessor, Type, XmlValue};

/**
 * SuggestedQueryString struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SuggestedQueryString
{
    /**
     * @Accessor(getter="getSuggestedQueryString", setter="setSuggestedQueryString")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $suggestedQueryString;

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(string $suggestedQueryString = '')
    {
        $this->setSuggestedQueryString($suggestedQueryString);
    }

    /**
     * Gets suggestedQueryString
     *
     * @return string
     */
    public function getSuggestedQueryString(): string
    {
        return $this->suggestedQueryString;
    }

    /**
     * Sets suggestedQueryString
     *
     * @param  string $suggestedQueryString
     * @return self
     */
    public function setSuggestedQueryString(string $suggestedQueryString): self
    {
        $this->suggestedQueryString = $suggestedQueryString;
        return $this;
    }
}
