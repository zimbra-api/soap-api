<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct\Header;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\RequestFormat;

/**
 * FormatInfo struct class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FormatInfo
{
    /**
     * Desired response format. Valid values "xml" (default) and "js"
     * 
     * @var RequestFormat
     */
    #[Accessor(getter: 'getFormat', setter: 'setFormat')]
    #[SerializedName('type')]
    #[Type('Enum<Zimbra\Common\Enum\RequestFormat>')]
    #[XmlAttribute]
    private RequestFormat $format;

    /**
     * Constructor
     * 
     * @param RequestFormat $format
     * @return self
     */
    public function __construct(?RequestFormat $format = NULL)
    {
        $this->setFormat($format ?? RequestFormat::XML);
    }

    /**
     * Get desired response format.
     *
     * @return RequestFormat
     */
    public function getFormat(): RequestFormat
    {
        return $this->format;
    }

    /**
     * Set desired response format.
     *
     * @param  RequestFormat $format
     * @return self
     */
    public function setFormat(RequestFormat $format): self
    {
        $this->format = $format;
        return $this;
    }
}
