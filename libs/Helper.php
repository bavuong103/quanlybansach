<?php

    class Helper
    {

        // Create Button
        public static function cmsButton($name,$id, $link, $icon, $type= 'new')
        {
            //Nhame: name button
            //id: dinh dang Css cua button
            //link : path
            //icon: imange of button
            $xtml = '<li class="button" id="'.$id.'">';
            if($type == 'new')
            {
                // type neu la tao ra 1 trang new
                $xtml .= '<a href="'.$link.'"><span class="'.$icon.'"></span>'.$name.'</a>';
            }else if($type == 'submit')
            {
                // type submit la o lai trang index
                $xtml .= '<a href="#" onclick= "javascript:submitForm(\''.$link.'\');"><span class="'.$icon.'"></span>'.$name.'</a>';
            }                        
                $xtml .=  '</li>';

            return $xtml;
        }

        
        //Create Icon Status
        // link = index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0
        public static function cmsStatus($statusValue,$link, $id){
            // valueStatus = 0 or 1
            //link : path to controller have function ajax
            // id: id of row change status
            $strStatus = ($statusValue == 0) ? 'unpublish' : 'publish';
    
            // the <span> la icon
            $xhtml		= '<a class="jgrid" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\');">
                                <span class="state '.$strStatus.'"></span>
                            </a>';
            return $xhtml;
        }

        //Create Icon Group_acp
        // link = index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0
        public static function cmsGroupACP($groupAcpValue, $link, $id){
            // valueStatus = 0 or 1
            //link : path to controller have function ajax
            // id: id of row change status
            $strGroupACP = ($groupAcpValue == 0) ? 'unpublish' : 'publish';
    
            // the <span> la icon
            $xhtml		= '<a class="jgrid" id="group-acp-'.$id.'" href="javascript:changeACP(\''.$link.'\');">
                                <span class="state '.$strGroupACP.'"></span>
                            </a>';
            return $xhtml;
        }


         //Create Icon Special
        // link = index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0
        public static function cmsSpecial($specialValue, $link, $id){
            // valueStatus = 0 or 1
            //link : path to controller have function ajax
            // id: id of row change status
            $strSpecial = ($specialValue == 0) ? 'unpublish' : 'publish';
    
            // the <span> la icon
            $xhtml		= '<a class="jgrid" id="special-'.$id.'" href="javascript:changeSpecial(\''.$link.'\');">
                                <span class="state '.$strSpecial.'"></span>
                            </a>';
            return $xhtml;
        }

        //Create SelectBox
        public static function cmsSelectbox($name, $class, $arrValue, $keySelect = 'default', $style=null){
        // $xhtml = '<select name="filter_state" class="inputbox" >
        //             <option value="2">- Select Status -</option>
        //             <option value="1">- Publish -</option>
        //             <option value="0">- UnPublish -</option>
        //         </select>';
            $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" >';
            foreach($arrValue as $key => $value)
            {
                if($key == $keySelect && is_numeric($keySelect))
                {
                    $xhtml .= ' <option selected="selected" value="'.$key.'">'.$value.'</option>';

                }
                else
                {
                    $xhtml .= ' <option value="'.$key.'">'.$value.'</option>';

                }
            }
            
            $xhtml .= '</select>';
            return $xhtml;
        }


        //Create Input
        public static function cmsInput($type, $name, $id, $value, $class=null, $size=null){
        // <input type="text" name="form[name]" id="name" value="" class="inputbox required" size="40">
            
            $strSize = ($size==null) ? '' : "size='$size'";

            $xhtml = "<input type='$type' name='$name' id='$id' value='$value' class='$class' $strSize'>";
                
            return $xhtml;
        }

        //Create Row - Admin
        public static function cmsRowForm($labelName, $input, $require = false){
            //  <li>
			// 	    <label>Name<span class="star">&nbsp;*</span></label>
			// 	    <input type="text" name="form[name]" id="name" value="" class="inputbox required" size="40">
			// </li>

            $strRequired = '';    
            // Trong truong` hop la truong` bat buoc
            if($require==true)
            {
                $strRequired = '<span class="star">&nbsp;*</span>';
            }

            $xhtml = '<li>
                        <label>'.$labelName. $strRequired.'</label>
                        '.$input.'
                    </li>';
                    
            return $xhtml;
        }


        //Create Row - public
        public static function cmsRow($labelName, $input, $submit=false){
            // <div class="form_row">
            //     <label class="contact"><strong>Username:</strong></label>
            //      <input type="text" class="contact_input" />
            // </div> 

            if($submit==false)
            {
                $xhtml = '<div class="form_row">
                            <label class="contact"><strong>'.$labelName.'</strong></label>
                            '.$input.'
                            </div> ';
            }
            else
            {
                // case type = submit (ko co label)
                $xhtml = '<div class="form_row">
                            '.$input.'
                            </div> ';
            }
            
                    
            return $xhtml;
        }


        // Create Message
        public static function cmsMessage($message){
            $xhtml = '';
            if(!empty($message))
            {
                $xhtml = '<dl id= "system-message">
                                    <dt class="'.$message['class'].'">'.ucfirst($message['class']).'</dt>
                                    <dd class="'.$message['class'].' message">
                                        <ul>
                                            <li>'.$message['content'].'</li>
                                        </ul>
                                    </dd> 
                                </dl>';
            }
            return $xhtml;
        }


        // Format Date
        public static function formatDate($format, $value)
        {
            $result = '';

            if(!empty($value) && $value != '0000-00-00')
            {
                $result = date($format, strtotime($value));
            }
           return $result;
        }





    }



?>