<?php
$id = intval($_GET['id']);
$musicurl = "http://music.baidu.com/data/music/fmlink?songIds=".$id;
$songinfo = json_decode(file_get_contents($musicurl), true);
exec("wget -O /tmp/baidufm.lrc http://music.baidu.com".escapeshellarg($songinfo['data']['songList'][0]['lrcLink']));
$flacurl = exec("/home/nabice/src/baiduflac ".$id." -u");
pclose(popen("/bin/ps -ef|/bin/grep baidulrc| /bin/grep -v grep|awk '{print $2}'|xargs -I % super kill %;DISPLAY=:0 /home/nabice/src/baidulrc &", "r"));
if($flacurl){
    header("Location: $flacurl");
}
?>
