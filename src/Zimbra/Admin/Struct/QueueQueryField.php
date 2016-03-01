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
    private $_matches;

    /**
     * Constructor method for QueueQueryField
     * @param  string $name Field name
     * @param  array $matches Match specifications
     * @return self
     */
    public function __construct($name, array $matches = [])
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        $this->setMatches($matches);

        $this->on('before', function(Base $sender)
        {
            if($sender->getMatches()->count())
            {
                $sender->setChild('match', $sender->getMatches()->all());
            }
        });
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Add a match
     *
     * @param  ValueAttrib $match
     * @return self
     */
    public function addMatch(ValueAttrib $match)
    {
        $this->_matches->add($match);
        return $this;
    }

    /**
     * Sets match sequence
     *
     * @param  array $matches
     * @return self
     */
    public function setMatches(array $matches)
    {
        $this->_matches = new TypedSequence('Zimbra\Admin\Struct\ValueAttrib', $matches);
        return $this;
    }

    /**
     * Gets match sequence
     *
     * @return Sequence
     */
    public function getMatches()
    {
        return $this->_matches;
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
