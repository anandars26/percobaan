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
//match Genre
preg_match_all('!<a href="\/\/series9.la\/genre.*?" title=".*?">(.*?)<\/a>!is',$result2,$genre);
$movies2['genre'] = $genre[1];
    
//match actor
preg_match_all('!<a href="\/\/series9.la\/actor.*?" title=".*?">(.*?)<\/a>!is',$result2,$actor);
$movies2['actor'] = $actor[1];
    
//match director 
preg_match_all('!<a href="#" title=".*?">(.*?)<\/a>!is',$result2,$director);
$movies2['director'] = $director[1];
    
//country
preg_match_all('!<a href="\/country.*?" title=".*?">(.*?)<\/a>!is',$result2,$country);
$movies2['country'] = $country[1];

//match duration, quality, release, imdbrating 

//match duration
preg_match_all('!<p><strong>Duration:<\/strong>\s(.*?)<\/p>!is',$result2,$duration);
$movies2['duration'] = $duration[1];
    
//match quality
preg_match_all('!<p><strong>Quality:<\/strong> <span class="quality">(.*?)<\/span><\/p>!is',$result2,$quality);
$movies2['quality'] = $quality[1];
        
//match release
preg_match_all('!<p><strong>Release:<\/strong>\s(.*?)<\/p>!is',$result2,$release);
$movies2['release'] = $release[1];
        
//match imdb rating
preg_match_all('!<p><strong>IMDb:<\/strong>\s(.*?)<\/p>!is',$result2,$imdbrating);
$movies2['imdbrating'] = $imdbrating[1];

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
echo $JSON;
