<?php
// https://stackoverflow.com/a/42446994
// CC BY-SA 3.0
function clt_date_relative($date)
{
  $diff = time() - date_timestamp_get($date); // changed
  $periods[] = [60, 1, '%s seconds ago', 'a second ago'];
  $periods[] = [60*100, 60, '%s minutes ago', 'one minute ago'];
  $periods[] = [3600*24, 3600, '%s hours ago', 'an hour ago'];
  $periods[] = [3600*24*10, 3600*24, '%s days ago', 'yesterday'];
  $periods[] = [3600*24*30, 3600*24*7, '%s weeks ago', 'one week ago'];
  $periods[] = [3600*24*30*30, 3600*24*30, '%s months ago', 'last month'];
  $periods[] = [INF, 3600*24*265, '%s years ago', 'last year'];
  foreach ($periods as $period) {
    if ($diff > $period[0]) continue;
    $diff = floor($diff / $period[1]);
    return sprintf($diff > 1 ? $period[2] : $period[3], $diff);
  }
}

?>
