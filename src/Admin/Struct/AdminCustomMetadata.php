<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\CustomMetadataInterface;

/**
 * AdminCustomMetadata struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminCustomMetadata extends AdminKeyValuePairs implements CustomMetadataInterface
{
    /**
     * Metadata section key.
     * 
     * @Accessor(getter="getSection", setter="setSection")
     * @SerializedName("section")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSection', setter: 'setSection')]
    #[SerializedName(name: 'section')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $section;

    /**
     * Constructor
     * 
     * @param string $section
     * @param array  $keyValuePairs
     * @return self
     */
    public function __construct(?string $section = NULL, array $keyValuePairs = [])
    {
    	parent::__construct($keyValuePairs);
        if (NULL !== $section) {
            $this->setSection($section);
        }
    }

    /**
     * Get metadata section key
     *
     * @return string
     */
    public function getSection(): ?string
    {
        return $this->section;
    }

    /**
     * Set metadata section key
     *
     * @param  string $section
     * @return self
     */
    public function setSection(string $section): self
    {
        $this->section = $section;
        return $this;
    }
}
