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
use PhpCollection\Sequence;

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
     * @param  array  $tests
     * @return self
     */
    public function __construct(array $tests = array())
    {
        parent::__construct();
        $this->_tests = new Sequence($tests);
    }

    /**
     * Add a test
     *
     * @param  string $test
     * @return self
     */
    public function addTest($test)
    {
        $test = trim($test);
        if(!empty($test))
        {
            $this->_tests->add($test);
        }
        return $this;
    }

    /**
     * Gets test sequence
     *
     * @return Sequence
     */
    public function tests()
    {
        return $this->_tests;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->normalizeTests();
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
        $this->normalizeTests();
        foreach ($this->_tests as $test)
        {
            $this->xml->addChild('test', $test);
        }
        return parent::toXml();
    }

    private function normalizeTests()
    {
        $this->_tests = $this->_tests->filter(function($test)
        {
            $test = trim($test);
            return !empty($test);
        });
    }
}
