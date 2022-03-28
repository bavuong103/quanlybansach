<?php
    class URL{


        public static function createLink($module, $controller, $action, $params = null)
        {
            $linkParams = '';
            // params dung` cho phan` change Status
            if(!empty($params))
            {
                // echo '<pre>';
                // print_r($params);
                // echo '</pre>';
                foreach($params as $key=>$value)
                {
                    // id=2&status=0
                    $linkParams .= "&$key=$value";
                }

            }

            // url: index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0;
            $url= 'index.php?module='.$module.'&controller='.$controller.'&action='.$action. $linkParams;
            //echo $url;

            return $url;

        }

        // public static function redirect($link)
        // {
        //     header('location: '. $link);
        //     exit();
        // }

        public static function redirect($module, $controller, $action, $params = null)
        {
            $link = self::createLink($module, $controller, $action, $params);
            header('location: '. $link);
            exit();
        }

        public static function checkRefreshPage($value, $module, $controller, $action, $params = null)
        {
            // (Session::get('token') == $this->_arrParams['form']['token']
            if(Session::get('token') == $value)
            {
                Session::delete('token');
                // nhan F5 sau khi save se tro ve` trang Register
                URL::redirect($module, $controller, $action, $params);
            }
            else
            {
                // Khi user save lan` 1
                Session::set('token',$value);
            }
        }
    }

?>