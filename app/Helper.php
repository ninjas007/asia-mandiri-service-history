<?php

namespace App;

class Helper {

    /**
     * to get role id by slug
     * 
     * @param string slug role
     * 
     * @return string role id
     */
    public static function roleIdBySlug($slug)
    {
        $list_user =  [
            'teknisi' => 1,
            'client' => 2
        ];

        return $list_user[$slug] ?? null;
    }
}