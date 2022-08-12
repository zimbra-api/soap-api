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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\InfoSection;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetInfoRequest class
 * Get information about an account.
 * By default, GetInfo returns all data; to limit the returned data, specify only the sections you want in the "sections" attr.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetInfoRequest extends SoapRequest
{
    /**
     * Comma separated list of sections to return information about.
     * Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     * 
     * @Accessor(getter="getSections", setter="setSections")
     * @SerializedName("sections")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var array
     */
    #[Accessor(getter: 'getSections', setter: 'setSections')]
    #[SerializedName(name: 'sections')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $sections = [];

    /**
     * Comma separated list of rights to return information about.
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var array
     */
    #[Accessor(getter: 'getRights', setter: 'setRights')]
    #[SerializedName(name: 'rights')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $rights = [];

    /**
     * Constructor
     * 
     * @param string $sections
     * @param string $rights
     * @return self
     */
    public function __construct(?string $sections = NULL, ?string $rights = NULL)
    {
        if (NULL !== $sections) {
            $this->setSections($sections);
        }
        if (NULL !== $rights) {
            $this->setRights($rights);
        }
    }

    /**
     * Get the sections.
     *
     * @return string
     */
    public function getSections(): ?string
    {
        return !empty($this->sections) ? implode(',', $this->sections) : NULL;
    }

    /**
     * Set the sections.
     *
     * @param  string $sections
     * @return self
     */
    public function setSections(string $sections): self
    {
        $this->sections = [];
        foreach (explode(',', $sections) as $section) {
            $this->addSections($section);
        }
        return $this;
    }

    /**
     * Add sections.
     *
     * @param  string $sections
     * @return self
     */
    public function addSections(string ...$sections): self
    {
        if (!empty($sections)) {
            foreach ($sections as $section) {
                if (InfoSection::isValid($section) && !in_array($section, $this->sections)) {
                    $this->sections[] = $section;
                }
            }
        }
        return $this;
    }

    /**
     * Get the rights.
     *
     * @return string
     */
    public function getRights(): ?string
    {
        return !empty($this->rights) ? implode(',', $this->rights) : NULL;
    }

    /**
     * Set the rights.
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(string $rights): self
    {
        $this->rights = array_unique(array_map(static fn ($right) => trim($right), explode(',', $rights)));
        return $this;
    }

    /**
     * Add rights.
     *
     * @param  string $rights
     * @return self
     */
    public function addRights(string ...$rights): self
    {
        if (!empty($rights)) {
            foreach ($rights as $right) {
                if (!in_array($right, $this->rights)) {
                    $this->rights[] = $right;
                }
            }
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetInfoEnvelope(
            new GetInfoBody($this)
        );
    }
}
