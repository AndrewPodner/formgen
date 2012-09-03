<?php
/*
 *  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

  Copyright (C) 2012  Andrew Podner
  

 * 
 * NO FITLERING OR ESCAPING IS BUILT INTO THIS CODE
 * YOU MUST TAKE CARE OF THAT YOURSELF
 * 
 
 * FORM ELEMENTS NOT IMPLEMENTED (probably not an exhaustive list...)
 *      OPTGROUP  optional & event parameters
 *      NEW HTML INPUT TYPES 
 *          browser support still not great for these
 *          so I am leaving in a method for custom input
 *          tags called, oddly enough.... input
 * 
 */

class SimpleForm {       
        // @name: constructor
        // @params: idName - the form's id and name (string)
        //          action - target file for form's action, default is SELF (string)
        //          method - POST or GET, default is post
        //          addtlParam - additional parameters for the tag where key is the tag property (array)
        // @returns: HTML CODE (<form> tag)
        // @descr: 
        /*
         */
	function __construct($name, $action='', $method='post', $arrAddtlParam=NULL) {		
		$string =  '<form id="'.$name.'" name="'.$name.'" method="'.$method.'" action="'.$action.'"';
                $string .= $this->_additionalParameters($arrAddtlParam);
                $string .= '>';
                echo $string;
	}
	
	/* @name: fend
         * @param: none
         * @returns: html string
         * @descr: generate the closing form tag
         *
         */
	function fend() {
            echo '</form>
            ';
	}
        

        /* @name: button
         * @param: name=string, val=string, onlick=string
         * @returns: html string
         * @descr: generates the html for a form button
         *
         */
        function button($id,$buttonLabel,$onClick,$arrAddtlParam=NULL) {
            $string = '<input type="button" id="'.$id.'" value="'.$buttonLabel.'" onclick="'.$onClick.'"';  
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= '/>
                ';
            echo $string;
        }

        // @name: checkbox
        // @params: name=string, val=string, chk=int
        // @returns: html string
        // @descr: returns a check box form tag
        /*         use a 1 in the chk parameter for a
         *         checked value
         */
	function checkbox($name, $value, $checked=0, $arrAddtlParam=NULL) {
            $string = '<input type="checkbox" id="'.$name.'" name="'.$name.'" value="'.$value.'"';
            if($checked == 1) {
                    $string .=  'checked="yes"';
            }
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= ' >
                ';

            echo $string;
	}
        
        // @name: datalist
        // @params: inputListValue = the input list attribute value the list is associated with
        //          arrOptions = array for the options $arrOptions[0]=Value1
        // @returns: html string
        // @descr:  HTML5 element for autocompleting input tags
        /*
         * <input type="text" list="myDataList" name="myName" />
         * <datalist id="myDataList>
         *      <option value="myvalue1">
         *      <option value="myvalue2">
         * </datalist>
         */
        function datalist($inputListValue,$arrOptions,$arrAddtlParam=NULL) {
            $string = '<datalist id="'.$inputListValue.'"'; 
            $string .= $this->_additionalParameters($arrAddtlParam);   
            $string .= '>
                ';
            foreach($arrOptions as $key => $optionValue) {
                $string .= '<option value="'.$optionValue.'">
                    ';
            }
            $string .= '</string>
                ';
            echo $string;
        }
        
        
        // @name: fieldsetOpen
        // @params: legendCaption = string
        // @returns: html string
        // @descr: begins a fieldset
        /*
         */
        function fieldsetOpen($legendCaption) {
            $string = '<fieldset>
                            <legend>'.$legendCaption.'</legend>
                ';
            echo $string;
        }
        
        // @name: fieldsetClose
        // @params: none
        // @returns: html string
        // @descr: closes a fieldset
        /*
         */
        function fieldsetClose() {
            echo '</fieldset>
                ';
        }
        
        /* @name: file
         * @param: name=string, accept=string
         * @returns: html string
         * @descr: generates a file input tag
         *
         */
	function file($name, $accept, $arrAddtlParam=NULL) {
            $string = '<input type="file" accept="'.$accept.'" name="'.$name.'" id="'.$name.'"';
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= '/>
                ';
            echo $string;
	}
            
        /* @name: hidden
         * @param: name=string, val=string
         * @returns: html string
         * @descr: generates a hidden input tag
         *
         */
	function hidden($name, $val="", $arrAddtlParam=NULL) {
            $string = '<input type="hidden" name="'.$name.'" value="'.$val.'" id="'.$name.'"';
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= '/>
                ';
            echo $string;
	}
        
        /* @name: image
         * @param: name=string, src=string
         * @returns: html string
         * @descr: generates a image input tag
         *
         */
	function image($name, $src="", $arrAddtlParam=NULL) {
            $string = '<input type="image" name="'.$name.'" src="'.$src.'" id="'.$name.'"';
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= '/>
                ';
            echo $string;
	}
        
        // @name: input
        // @params: type=string, name=string, val=string
        // @returns: html string
        // @descr: 
        /*  This is a catch all for custom input tags,
         *  such as new HTML5 elements if you want to 
         *  try putting them in
         * 
         */
         function input($type, $name, $val="", $arrAddtlParam=NULL) {
            $string = '<input type="'.$type.'" name="'.$name.'" value="'.$val.'" id="'.$name.'"';
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= '/>
                ';
            echo $string;
	}  
        
        
        // @name: keygen
        // @params: name=string
        // @returns: keygen html form element
        // @descr: HTML5 key generator )
        /*
         * this is not implemented in IE.
         * Safari: only implemented in mac versions
         */
        function keygen($name, $arrAddtlParam=NULL) {
           $string =  '<keygen name="'.$name.'"'; 
           $string .= $this->_additionalParameters($arrAddtlParam);    
           $string .= '/>
                ';
           echo $string;
        }
        
        // @name: label
        // @params: for=string, val=string
        // @returns: html string
        // @descr: generates a label tag
        /*
         */       
        function label($for, $description) {
            $string = '<label for="' . $for . '">'.$description.'</label>
                ';
            echo $string;
        }
        
        // @name: output
        // @params: name=string, for=string
        // @returns: html string
        // @descr: HTML5 form element for output
        /*
         * not implemented in IE
         */
        function output($name, $for, $arrAddtlParam=NULL) {
            $string = '<output name="'.$name.'" id="'.$name.'" for="'.$for.'"'; 
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= ' />
                ';
            echo $string;
        }
        
        /* @name: password
         * @param: name=string, size=int
         * @returns: html string
         * @descr: generates a password input tag
         *
         */
	function password($name, $size=30, $arrAddtlParam=NULL) {
            $string = '<input type="password" size="'.$size.'" name="'.$name.'" id="'.$name.'"';
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= ' />
                ';
            echo $string;
	}
        	
        // @name: radioButton
        // @params: name=string, vals=array
        // @returns: html string
        // @descr: returns a series of radio button form tags
        /*          the array element value is the value part 
         *          of the tag
         */
        function radioButton($name, $vals, $arrAddtlParam=NULL) {
            foreach($vals as $key => $data) {
                $string = '<input type="radio" name="'.$name.'" value="'.$data.'"';
                $string .= $this->_additionalParameters($arrAddtlParam);
                $string .= ' />
                    ';
            }
        }
        
        /* @name: reset
         * @param: none
         * @returns: html string
         * @descr: generates a hidden input tag
         *
         */
	function reset($buttonLabel="Reset") {
		$string = '<input type="reset" value="'.$buttonLabel.'"/>
                    ';
		echo $string;
	}
        
	/* @name: select
         * @param: name=string, arrOptions=array, selectedValue=string
         * @returns: html string
         * @descr: generates a select tag with options
         *          the $opts array should have the
         *          structure where the array key is
         *          in the value part of the option tag
         *          and the array element value is what the
         *          option tag will display
         *          put a string in sel paramter to denote
         *          which value if any is selected on load
         */
	function select($name, $arrOptions='1', $selectedValue='', $arrAddtlParam=NULL) {
		//default is a simple Yes/No
		if($arrOptions == '1') {
                    $arrOptions = array(
                        'Y' => 'Yes',
                        'N' => 'No');
		}
		
		$string = '<select name="'.$name.'" id="'.$name.'"';
		$string .= $this->_additionalParameters($arrAddtlParam);
                $string .= '>
                    ';
		$string .= $this->_selectOptions($arrOptions,$selectedValue);
		$string .='</select>
		';
		echo $string;
	}
        
        /* @name: selectWithGroups
         * @param: name=string, arrOptions= multidim array, selectedValue=string
         * @returns: html string
         * @descr: generates a select tag with options (and option groups)
         *          the $opts array should have the
         *          structure where the array key is
         *          in the value part of the option tag
         *          and the array element value is what the
         *          option tag will display
         *          put a string in sel paramter to denote
         *          which value if any is selected on load
         * 
         *          options array:  $arrOptions['Group Name']['option value'] = Option Description
         */
	function selectWithGroups($name, $arrOptions, $selectedValue='', $arrAddtlParam=NULL) {		
		$string = '<select name="'.$name.'" id="'.$name.'"';
		$string .= $this->_additionalParameters($arrAddtlParam);
                $string .= '>
                    ';
               
                reset($arrOptions);
                $currentKey = key($arrOptions);
                $string .= '<optgroup label="'.$currentKey.'">
                    ';
                foreach ($arrOptions as $groupName => $arrOpts) {
                    if(strcmp($groupName, $currentKey) != 0) {
                        $string .= '</optgroup>
                            ';
                        $currentKey = $groupName;
                        $string .= '<optgroup label="'.$currentKey.'">
                    ';
                    }                  
                    $string .= $this->_selectOptions($arrOpts,$selectedValue);
                }
		$string .='</optgroup>
                       </select>
		';
		echo $string;
	}
        
        
        /* @name: submit
         * @param: name=string, val=string
         * @returns: html string
         * @descr: generates a submit button input tag
         *
         */
	function submit($val="Submit",$name="Submit",$arrAddtlParam=NULL) {
		$string = '<input type="submit" name="'.$name.'" value="'.$val.'" id="'.$name.'"';
                $string .= $this->_additionalParameters($arrAddtlParam);
                $string .= '/>
                    ';
		echo $string;
	}
	
	/* @name: text
         * @param: name=string, val=string, size=int
         * @returns: html string
         * @descr: generates a text box input tag
         *
         */
	function text($name, $val="", $size=30, $arrAddtlParam=NULL) {
            $string = '<input type="text" size="'.$size.'" name="'.$name.'" value="'.$val.'" id="'.$name.'"';
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .= ' />
                ';
            echo $string;
	}
        
	/* @name: textarea
         * @params: name=string, val=string, attribs=string
         * @returns: html string
         * @descr: generates a textarea tag
         *         use attribs parameter to specify additional
         *         information like width and cols
         */
	function textarea($name, $val='', $arrAddtlParam=NULL) {	
            $string = '<textarea id="'.$name.'" name="'.$name.'"';
            $string .= $this->_additionalParameters($arrAddtlParam);
            $string .='>
                    ';
            $string .= $val.'</textarea>
            ';
            echo $string;
	}
	
	      
        // @name: _additional (protected)
        // @params: arrAddtlParams (associative array)
        // @returns: string
        // @descr: builds the string of any additional parameters for
        //         the form element that is being created.   
        /*
         *      example for textarea:
         *          $arrAddtlParam['rows'] = 8;
         *          $arrAddtlParam['cols']= 50;
         */
        protected function _additionalParameters($arrAddtlParam) {
            $string=NULL;
            if($arrAddtlParam !== NULL and is_array($arrAddtlParam)) {
                foreach($arrAddtlParam as $key => $value) {
                    $string .= ' ' . $key . '="' . $value . '" ';
                }
            }
            else {
                $string = '';
            }
            return $string;
        }
        
        // @name: _selectOptions (protected)
        // @params: arrOpts=array, $selectedValue=string
        // @returns: html string 
        // @descr: generates the list of options for a select box
        /*
         */
        protected function _selectOptions($arrOpts,$selectedValue) {
            foreach ($arrOpts as $optionValue => $optionDescription) {		
                $string .= '<option value="'.$optionValue.'"';
                if($optionValue == $selectedValue) {
                    $string .= ' selected="selected"';
                }
                $string .= '>'.$optionDescription.'</option>
                    ';
            }
            return $string;
        }
}
?>