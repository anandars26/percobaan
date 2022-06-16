<?php 

/*$curl = curl_init();
$url = "https://series9.la/movie/filter/movie/all/all/all/all/latest/?page=1";

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

$movies = array();

//match movie title, poster, link
preg_match_all('!href="\/film\/(.*?)"!',$result,$match);
$movies['backdrop'] = $match[1];*/
if(isset($_GET['link']))
{
    $link = $_GET['link'];
};

$curl2 = curl_init();

curl_setopt($curl2, CURLOPT_URL, $link);
curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);

$result2 = curl_exec($curl2);

$movies2 = array();

//match title
preg_match_all('!<h3>(.*?)<\/h3>!',$result2, $title);
$movies2['title'] = $title[1];

//match poster
preg_match_all('!style="background-image: url\(\/\/cdn.themovieseries.net\/cover\/(.*?).png\);"!',$result2, $poster);
$movies2['poster'] = $poster[1];

//match plot 
preg_match_all('!<div class="desc">\s(.*?)<\/div>!is',$result2, $plot);
$movies2['plot'] = $plot[1];

//match genre, actor, director, country
preg_match_all('!<div class="mvici-left">(.*?)<\/div>!is',$result2, $match2);

//match genre, actor, director, country individually from above block
for ($i=0;$i<count($match2[1]);$i++){

    //match Genre
    if (preg_match_all('!<a href="\/\/series9.la\/genre.*?" title=".*?">(.*?)<\/a>!is',$match2[1][$i],$genre)){
        $movies2['genre'][$i] = $genre[1];
    }
    else {
        $movies2['info'][$i] = '';

    };
    //match actor
    if (preg_match_all('!<a href="\/\/series9.la\/actor.*?" title=".*?">(.*?)<\/a>!is',$match2[1][$i],$actor)){
        $movies2['actor'][$i] = $actor[1];
    }
    else {
        $movies2['actor'][$i] = '';
    };
    //match director 
    if (preg_match_all('!<a href="#" title=".*?">(.*?)<\/a>!is',$match2[1][$i],$director)){
        $movies2['director'][$i] = $director[1];
    }
    else {
        $movies2['director'][$i] = '';
    };
    //country
    if (preg_match_all('!<a href="\/country.*?" title=".*?">(.*?)<\/a>!is',$match2[1][$i],$country)){
        $movies2['country'][$i] = $country[1];
    }
    else {
        $movies2['country'][$i] = '';
    };
};

//match duration, quality, release, imdbrating 
preg_match_all('!<div class="mvici-right">(.*?)<\/div>!is',$result2, $match2);

//match duration, quality, release, imdbrating individually from above block
for ($i=0;$i<count($match2[1]);$i++){

    //match duration
    if (preg_match_all('!<p><strong>Duration:<\/strong>\s(.*?)<\/p>!is',$match2[1][$i],$duration)){
        $movies2['duration'][$i] = $duration[1];
    }
    else {
        $movies2['duration'][$i] = '';

    };
    //match quality
    if (preg_match_all('!<p><strong>Quality:<\/strong> <span class="quality">(.*?)<\/span><\/p>!is',$match2[1][$i],$quality)){
        $movies2['quality'][$i] = $quality[1];
    }
    else {
        $movies2['quality'][$i] = '';

    };
    //match release
    if (preg_match_all('!<p><strong>Release:<\/strong>\s(.*?)<\/p>!is',$match2[1][$i],$release)){
        $movies2['release'][$i] = $release[1];
    }
    else {
        $movies2['release'][$i] = '';

    };
    //match imdb rating
    if (preg_match_all('!<p><strong>IMDb:<\/strong>\s(.*?)<\/p>!is',$match2[1][$i],$imdbrating)){
        $movies2['imdbrating'][$i] = $imdbrating[1];
    }
    else {
        $movies2['imdbrating'][$i] = '';

    };
};

//match substitle 
preg_match_all('!<a href="(.*?)" target="_blank" class="btn bp-btn-dowload-sub"!',$result2, $substitle);
$movies2['substitle'] = $substitle[1];

//match player
preg_match_all('!<iframe src="(.*?)"!',$result2, $player);
$movies2['player'] = $player[1];

//match server 
preg_match_all('!player-data="(.*?)"!',$result2, $server);
$movies2['server'] = $server[1];

$JSON = json_encode($movies2);
print_r($JSON);
