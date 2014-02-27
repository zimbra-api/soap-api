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

/**
 * QueueQueryField struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class QueueQueryField extends Base
{
    /**
     * Match specifications
     * @var TypedSequence
     */
    private $_match = array();

    /**
     * Constructor method for QueueQueryField
     * @param  string $name Field name
     * @param  array $matches Match specifications
     * @return self
     */
    public function __construct($name, array $matches = array())
    {
        parent::__construct();
        $this->property('name', trim($name));
        $this->_match = new TypedSequence('Zimbra\Admin\Struct\ValueAttrib', $matches);

        $this->on('before', function(Base $sender)
        {
            if($sender->match()->count())
            {
                $sender->child('match', $sender->match()->all());
            }
        });
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Add a match
     *
     * @param  ValueAttrib $match
     * @return self
     */
    public function addMatch(ValueAttrib $match)
    {
        $this->_match->add($match);
        return $this;
    }

    /**
     * Gets match sequence
     *
     * @return Sequence
     */
    public function match()
    {
        return $this->_match;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'field')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'field')
    {
        return parent::toXml($name);
    }
}
