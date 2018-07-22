<?php
/**
 * User: PZT
 * Date: 2018/6/18
 * Time: 19:06
 */
if( !function_exists('__field') ){
    function __field( $data, $extras = [] )
    {
        $field  =   [
            "_token" , "_method"
        ];

        foreach ( $field as $item ){
            if( isset($data[$item]) ){
                unset($data[$item]);
            }
        }

        foreach ( $extras as $item ){
            if( isset($data[$item]) ){
                unset($data[$item]);
            }
        }

        return $data;
    }
}

if(!function_exists('flash')){

    function flash($title, $message, $level, $key = 'flash_message')
    {
        session()->flash($key, [
            'title'     => $title,
            'message'   => $message,
            'level'     => $level
        ]);

    }
}

if(!function_exists('__ajax')){
    function __ajax($type, $code='')
    {
        if($type == 'success')
            return ['err'=>'ok'];
        else
            return ['err'=>'fail', 'code'=>$code];
    }
}