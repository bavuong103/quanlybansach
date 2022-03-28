<?php

    class Session{

        // session_start()
        public static function init()
        {
            session_start();
        }

        // $_SESSION['user'] = value
        // Session::set('key','value')
        public static function set($key, $value)
        {
            $_SESSION[$key] = $value;
        }

        //$cart = $_SESSION['cart]
        public static function get($key)
        {
            if(isset($_SESSION[$key]))
            return $_SESSION[$key] ;
        }

        //unset_session (delete 1 session)
        public static function delete($key)
        {
            if(isset($_SESSION[$key]))
             unset($_SESSION[$key]) ;
        }

        //destroy_session
        public static function destroy()
        {
            session_destroy();
        }


    }


?>