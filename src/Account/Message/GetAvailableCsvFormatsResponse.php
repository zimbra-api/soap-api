<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAvailableCsvFormatsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAvailableCsvFormatsResponse implements ResponseInterface
{
    /**
     * Information about csvFormats
     * 
     * @Accessor(getter="getCsvFormats", setter="setCsvFormats")
     * @SerializedName("csv")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "csv")
     */
    private $csvFormats = [];

    /**
     * Constructor method for GetAvailableCsvFormatsResponse
     *
     * @param array $csvFormats
     * @return self
     */
    public function __construct(array $csvFormats = [])
    {
        $this->setCsvFormats($csvFormats);
    }

    /**
     * Add csvFormat
     *
     * @param  NamedElement $csvFormat
     * @return self
     */
    public function addCsvFormat(NamedElement $csvFormat): self
    {
        $this->csvFormats[] = $csvFormat;
        return $this;
    }

    /**
     * Sets csvFormats
     *
     * @param  array $formats
     * @return self
     */
    public function setCsvFormats(array $formats): self
    {
        $this->csvFormats = array_filter($formats, static fn($format) => $format instanceof NamedElement);
        return $this;
    }

    /**
     * Gets csvFormats
     *
     * @return array
     */
    public function getCsvFormats(): array
    {
        return $this->csvFormats;
    }
}
