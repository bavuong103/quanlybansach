<?php 

    $message = '';
    switch($this->arrParam['type'])
    {
        case 'register-success':
            $message = 'Tài khoản của bạn đã được đăng ký thành công!';
            break;
        case 'not-permission':
            $message = 'Bạn không có quyền truy cập vào chức năng Admin Manager!';
            break;  
        case 'not-url':
            $message = 'Đường dẫn không hợp lệ';
            break;  
    }

?>

<div class="notice"><?php echo $message; ?></div>