<?php
include_once "helpers.php";


//////////////// SEARCH //////////////////////
function search($type, $title, $page = 1, $pagelimit  = 10)
{
    if ($type == null) {
        $type = "all";
    }

    $data = call([
        "module" => "Search5",
        "page" => $page,
        "pagelimit" => $pagelimit,
        "type" => $type,
        "keyword" => $title,
    ]);

    echo jsonFormat($data);
}


function top_searchs($type, $pagelimit = 10)
{
    if (!in_array($type, ["movie", "tv"])) {
        $type = "movie";
    }

    $data = call([
        "module" => "Search_hot",
        "type" => $type,
        "pagelimit" => $pagelimit,
    ]);

    echo jsonFormat($data);
}

function autocomplate($title, $pagelimit = 10)
{
    $data = call([
        "module" => "Autocomplate2",
        "keyword" => $title,
        "pagelimit" => $pagelimit,
    ]);

    echo jsonFormat($data);
}

//////////////// HOME //////////////////////

function home_lists($type , $page = 1, $pagelimit = 10)
{
    $type = "continue";
    $data = call([
        "module" => "Home_list_type",
        "uid" => "",
        "type" => $type,
        "private_mode" => 0,
        "page" => $page,
        "pagelimit" => $pagelimit,
    ]);

    echo jsonFormat($data);
}

//////////////// MOVIES //////////////////////
function movie($id)
{
    $data = call([
        "module" => "Movie_detail",
        "mid" => $id,
    ]);

    echo jsonFormat($data);
}

function download_movie($mid)
{
    $data = call([
        "module" => "Movie_downloadurl_v3",
        "mid" => $mid,
    ]);

    echo jsonFormat($data);
}


function movies(
    $year = null,
    $category_id = null,
    $rating = null,
    $quality = null,
    $country = null,
    $imdbRating = null,
    $orderby = null,
    $page = null,
    $pagelimit = null
) {
    $data = call([
        "module" => "Movie_list_v3",
        "year" => $year,
        "cid" => $category_id,
        "rating" => $rating,
        "quality" => $quality,
        "country" => $country,
        "imdbRating" => $imdbRating,
        "orderby" => $orderby,
        "page" => $page,
        "pagelimit" => $pagelimit,
    ]);

    echo jsonFormat($data);
}

function movie_top_lists()
{
    $data = call([
        "module" => "Top_list",
        "box_type" => 1
    ]);

    echo jsonFormat($data);
}

function show_movie_top_list($id, $page = 1, $pagelimit = 10)
{
    $data = call([
        "module" => "Top_list_movie",
        "id" => $id,
        "page" => $page,
        "pagelimit" => $pagelimit,
    ]);

    echo jsonFormat($data);
}

function movie_srts($mid, $fid = null, $uid = null)
{
    $data = call([
        "module" => "Movie_srt_list_v2",
        "mid" => $mid,
        "fid" => $fid ?? "",
        "uid" => $uid ?? 1,
    ]);

    echo jsonFormat($data);
}


//////////////// TV //////////////////////
function tv($id)
{
    $data = call([
        "module" => "TV_detail",
        "tid" => $id,
        "display_all" => "1",
    ]);

    echo jsonFormat($data);
}

function episodes($tid, $season)
{
    $data = call([
        "module" => "TV_episode",
        "tid" => $tid,
        "season" => $season,
    ]);

    echo jsonFormat($data);
}

function download_episode($tid, $season, $episode)
{
    $data = call([
        "module" => "TV_downloadurl_v3",
        "tid" => $tid,
        "season" => $season,
        "episode" => $episode,
    ]);

    echo jsonFormat($data);
}

function tvs(
    $year = null,
    $category_id = null,
    $rating = null,
    $quality = null,
    $country = null,
    $imdbRating = null,
    $orderby = null,
    $page = null,
    $pagelimit = null
) {
    $data = call([
        "module" => "TV_list_v2",
        "year" => $year,
        "cid" => $category_id,
        "rating" => $rating,
        "quality" => $quality,
        "country" => $country,
        "imdbRating" => $imdbRating,
        "orderby" => $orderby,
        "page" => $page,
        "pagelimit" => $pagelimit,
    ]);

    echo jsonFormat($data);
}

function tv_top_lists()
{
    $data = call([
        "module" => "Top_list",
        "box_type" => 2
    ]);

    echo jsonFormat($data);
}

function show_tv_top_list($id, $page = 1, $pagelimit = 10)
{
    $data = call([
        "module" => "Top_list_tv",
        "id" => $id,
        "page" => $page,
        "pagelimit" => $pagelimit,
    ]);

    echo jsonFormat($data);
}


function tv_srts($tid, $season, $episode, $fid  = null, $uid = null)
{
    $data = call([
        "module" => "TV_srt_list_v2",
        "tid" => $tid,
        "fid" => $fid ?? "",
        "season" => $season,
        "episode" => $episode,
        "uid" => $uid ?? 1,
    ]);

    echo jsonFormat($data);
}
