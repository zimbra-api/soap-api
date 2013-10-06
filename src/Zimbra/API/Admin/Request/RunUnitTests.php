<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;

/**
 * RunUnitTests class
 * Runs the server-side unit test suite.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RunUnitTests extends Request
{
    /**
     * Test Names
     * @var array
     */
    private $_tests = array();

    /**
     * Constructor method for RunUnitTests
     * @param  array  $dlms
     * @return self
     */
    public function __construct(array $tests = array())
    {
        parent::__construct();
        $this->_id = trim($id);
        foreach ($tests as $test)
        {
            $test = trim($test);
            if(!empty($test))
            {
                $this->_tests[] = $test;
            }
        }
    }

    /**
     * Gets or sets tests
     *
     * @param  array $tests
     * @return array|self
     */
    public function tests(array $tests = null)
    {
        if(null === $tests)
        {
            return $this->_tests;
        }
        $this->_tests = array();
        foreach ($tests as $test)
        {
            $test = trim($test);
            if(!empty($test))
            {
                $this->_tests[] = $test;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_tests))
        {
            $this->array['test'] = array();
            foreach ($this->_tests as $test)
            {
                $this->array['test'][] = $test;
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        foreach ($this->_tests as $test)
        {
            $this->xml->addChild('test', $test);
        }
        return parent::toXml();
    }
}
