<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;
use Zimbra\Struct\NamedElement;

/**
 * StatsValueWrapper struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class StatsValueWrapper extends Base
{
    /**
     * Stats specification
     * @var TypedSequence
     */
    private $_stat = array();

    /**
     * Constructor method for StatsValueWrapper
     * @param  array $stats
     * @return self
     */
    public function __construct(array $stats = array())
    {
        parent::__construct();
        $this->_stat = new TypedSequence('Zimbra\Struct\NamedElement', $stats);

        $this->addHook(function($sender)
        {
            $sender->child('stat', $sender->stat()->all());
        });
    }

    /**
     * Add a stat
     *
     * @param  NamedElement $stat
     * @return self
     */
    public function addStat(NamedElement $stat)
    {
        $this->_stat->add($stat);
        return $this;
    }

    /**
     * Gets stat equence
     *
     * @return Sequence
     */
    public function stat()
    {
        return $this->_stat;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'values')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'values')
    {
        return parent::toXml($name);
    }
}
