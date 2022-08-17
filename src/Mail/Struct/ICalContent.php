<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * ICalContent struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ICalContent
{
    /**
     * Item ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * ICAL
     * 
     * @var string
     */
    #[Accessor(getter: 'getIcal', setter: 'setIcal')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $ical;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $ical
     * @return self
     */
    public function __construct(?string $id = NULL, ?string $ical = NULL)
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $ical) {
            $this->setIcal($ical);
        }
    }

    /**
     * Get ical
     *
     * @return string
     */
    public function getIcal(): ?string
    {
        return $this->ical;
    }

    /**
     * Set ical
     *
     * @param  string $ical
     * @return self
     */
    public function setIcal(string $ical): self
    {
        $this->ical = $ical;
        return $this;
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}
