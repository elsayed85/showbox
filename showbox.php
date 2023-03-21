<?php
error_reporting(E_ERROR);
ini_set('display_errors', 1);

include "config.php";
include_once "functions.php";

$request = $_GET['request']; // search , top_searchs , autocomplate , download_movie , download_episode
$type = $_GET['type']; // movie , tv , all
$title = $_GET['title']; // title

$page = $_GET['page'] ?? $default['page'];
$pagelimit = $_GET['pagelimit'] ?? $default['pagelimit'];

$id = $_GET['id']; // movie_id , serie_id , list_id 
$fid = $_GET['fid']; // video_id
$uid = $_GET['uid']; // ignore it


$season = $_GET['s']; // season
$episode = $_GET['e']; // episode


$year = $_GET['year'];
$category_id = $_GET['category_id'];
$rating = $_GET['rating'];
$quality = $_GET['quality'];
$country = $_GET['country'];
$imdbRating = $_GET['imdbRating'];
$orderby = $_GET['orderby'];

switch ($request) {
    case "search":
        search($type, $title, $page, $pagelimit);
        break;

    case "top_searchs":
        top_searchs($type, $pagelimit);
        break;

    case "autocomplate":
        autocomplate($title, $pagelimit);
        break;

    case "download_movie":
        download_movie($id);
        break;

    case "download_episode":
        download_episode($id, $season, $episode);
        break;

    case "movie":
        movie($id);
        break;

    case "movie_srts":
        movie_srts($id, $fid, $uid);
        break;

    case "movies":
        movies(
            $year,
            $category_id,
            $rating,
            $quality,
            $country,
            $imdbRating,
            $orderby,
            $page,
            $pagelimit
        );
        break;

    case "tv":
        tv($id);
        break;

    case "tv_srts":
        tv_srts($id, $season, $episode, $fid, $uid);
        break;

    case "tvs":
        tvs(
            $year,
            $category_id,
            $rating,
            $quality,
            $country,
            $imdbRating,
            $orderby,
            $page,
            $pagelimit
        );
        break;

    case "episodes":
        episodes($id, $season);
        break;

    case "movie_top_lists":
        movie_top_lists($type, $page, $pagelimit);
        break;

    case "show_movie_top_list":
        show_movie_top_list($id, $page, $pagelimit);
        break;

    case "tv_top_lists":
        tv_top_lists($type, $page, $pagelimit);
        break;

    case "show_tv_top_list":
        show_tv_top_list($id, $page, $pagelimit);
        break;

    case "home_lists":
        home_lists(
            $type,
            $page,
            $pagelimit
        );
        break;

    default:
        echo json_encode([
            "code" => 0,
            "msg" => "Invalid request",
        ]);
        break;
}
