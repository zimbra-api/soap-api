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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAvailableCsvFormatsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAvailableCsvFormatsResponse extends SoapResponse
{
    /**
     * Information about csvFormats
     * 
     * @var array
     */
    #[Accessor(getter: 'getCsvFormats', setter: 'setCsvFormats')]
    #[Type(name: 'array<Zimbra\Common\Struct\NamedElement>')]
    #[XmlList(inline: true, entry: 'csv', namespace: 'urn:zimbraAccount')]
    private $csvFormats = [];

    /**
     * Constructor
     *
     * @param array $csvFormats
     * @return self
     */
    public function __construct(array $csvFormats = [])
    {
        $this->setCsvFormats($csvFormats);
    }

    /**
     * Set csvFormats
     *
     * @param  array $formats
     * @return self
     */
    public function setCsvFormats(array $formats): self
    {
        $this->csvFormats = array_filter($formats, static fn ($format) => $format instanceof NamedElement);
        return $this;
    }

    /**
     * Get csvFormats
     *
     * @return array
     */
    public function getCsvFormats(): array
    {
        return $this->csvFormats;
    }
}
