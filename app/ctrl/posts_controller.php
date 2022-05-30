<?php


class posts_controller {


    function list(){
        $result = db::get()->select("select * from entries");
        res::render("admin/posts.html",[]);
    }

}