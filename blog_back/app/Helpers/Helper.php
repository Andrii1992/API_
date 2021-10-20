<?php

use BaconQrCode\Common\Mode;
use App\Models\Posts;
use App\Repositories\PostRepository;

if (!function_exists('create_posts')){
    function create_posts(int $params = 3){
        return Posts::factory($params)->create();
    }
}
