<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function pager($url , $limit)
{
        $config["base_url"] = site_url($url);
        $config["per_page"] = $limit;
        $config["uri_segment"] = 3;
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href=''>" ;
        $config["cur_tag_close"] = "</a></li>";
        $config["next_tag_open"] = "<li>";
        $config["next_tag_close"] = "</li>";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";

        return $config;
}
