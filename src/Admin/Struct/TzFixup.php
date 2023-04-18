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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * TzFixup struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TzFixup
{
    /**
     * @Accessor(getter="getFixupRules", setter="setFixupRules")
     * @Type("array<Zimbra\Admin\Struct\TzFixupRule>")
     * @XmlList(inline=true, entry="fixupRule", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getFixupRules', setter: 'setFixupRules')]
    #[Type('array<Zimbra\Admin\Struct\TzFixupRule>')]
    #[XmlList(inline: true, entry: 'fixupRule', namespace: 'urn:zimbraAdmin')]
    private $fixupRules = [];

    /**
     * Constructor
     * 
     * @param array $fixupRules
     * @return self
     */
    public function __construct(array $fixupRules = [])
    {
        $this->setFixupRules($fixupRules);
    }

    /**
     * Add fixup rule
     *
     * @param  TzFixupRule $fixupRule
     * @return self
     */
    public function addFixupRule(TzFixupRule $fixupRule): self
    {
        $this->fixupRules[] = $fixupRule;
        return $this;
    }

    /**
     * Set fixup rule sequence
     *
     * @param array $fixupRules
     * @return self
     */
    public function setFixupRules(array $fixupRules): self
    {
        $this->fixupRules = array_filter(
            $fixupRules, static fn ($fixupRule) => $fixupRule instanceof TzFixupRule
        );
        return $this;
    }

    /**
     * Get fixup rule sequence
     *
     * @return array
     */
    public function getFixupRules(): array
    {
        return $this->fixupRules;
    }
}
