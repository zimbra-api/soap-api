<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

/**
 * RetentionPolicy struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RetentionPolicy
{
    /**
     * Keep Policies
     * @var TypedSequence<Policy>
     */
    private $_keep;

    /**
     * Purge Policies
     * @var TypedSequence<Policy>
     */
    private $_purge;

    /**
     * Constructor method for CalendarAttendee
     * @param array $keep
     * @param array $purge
     * @return self
     */
    public function __construct(
        array $keep = array(),
        array $purge = array()
    )
    {
        $this->_keep = new TypedSequence('Zimbra\Soap\Struct\Policy', $keep);
        $this->_purge = new TypedSequence('Zimbra\Soap\Struct\Policy', $purge);
    }

    /**
     * Add keep policy
     *
     * @param  Policy $keep
     * @return self
     */
    public function addKeep(Policy $keep)
    {
        $this->_keep->add($keep);
        return $this;
    }

    /**
     * Gets keep policy sequence
     *
     * @return Sequence
     */
    public function keep()
    {
        return $this->_keep;
    }

    /**
     * Add purge policy
     *
     * @param  Policy $purge
     * @return self
     */
    public function addPurge(Policy $purge)
    {
        $this->_purge->add($purge);
        return $this;
    }

    /**
     * Gets purge policy sequence
     *
     * @return Sequence
     */
    public function purge()
    {
        return $this->_purge;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'retentionPolicy')
    {
        $name = !empty($name) ? $name : 'retentionPolicy';
        $arr = array(
            'keep' => array(),
            'purge' => array(),
        );
        if(count($this->_keep))
        {
            $arr['keep']['policy'] = array();
            foreach ($this->_keep as $policy)
            {
                $policyArr = $policy->toArray('policy');
                $arr['keep']['policy'][] = $policyArr['policy'];
            }
        }
        if(count($this->_purge))
        {
            $arr['purge']['policy'] = array();
            foreach ($this->_purge as $policy)
            {
                $policyArr = $policy->toArray('policy');
                $arr['purge']['policy'][] = $policyArr['policy'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'retentionPolicy')
    {
        $name = !empty($name) ? $name : 'retentionPolicy';
        $xml = new SimpleXML('<'.$name.' />');
        $keep = $xml->addChild('keep');
        foreach ($this->_keep as $policy)
        {
            $keep->append($policy->toXml('policy'));
        }
        $purge = $xml->addChild('purge');
        foreach ($this->_purge as $policy)
        {
            $purge->append($policy->toXml('policy'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
