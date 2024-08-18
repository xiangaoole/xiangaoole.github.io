<?php
// Output the XML header
header('Content-Type: application/rss+xml; charset=UTF-8');

// Begin the RSS XML structure
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss version="2.0">
  <channel>
    <title>南懷瑾先生, 金剛經說什麼</title>
    <link>https://www.buda.idv.tw/db.asp?node=548&amp;keyword=&amp;PageNo_form=&amp;SortBy_form=LocalFileName</link>
    <description>金剛經說什麼 - 佛學多媒體資料庫 https://www.buda.idv.tw/db.asp?node=548&amp;keyword=&amp;PageNo_form=&amp;SortBy_form=LocalFileName</description>
    <language>zh-tw</language>
    <author>南懷瑾</author>
    <category>Religion &amp; Spirituality</category>
    <image>
      <url>https://s3proxy.cdn-zlib.se/covers400/collections/userbooks/37d2b65f918058d7a19f71c7edd49db709dd10d23e72d0ec741bbb7b75e7dde0.jpg</url>
      <title>南懷瑾先生, 金剛經說什麼</title>
      <link>https://www.buda.idv.tw/db.asp?node=548&amp;keyword=&amp;PageNo_form=&amp;SortBy_form=LocalFileName</link>
    </image>

    <!-- Episodes -->
    <?php
    for ($i = 1; $i <= 21; $i++) {
        $episodeNumber = sprintf("%02d", $i);
        $mp3Url = "https://download.buda.idv.tw/lecture/NHJ_JGJ" . $episodeNumber . ".mp3";
        echo "
    <item>
      <title>南懷瑾-金剛經 $episodeNumber</title>
      <description>Episode $episodeNumber</description>
      <enclosure url=\"$mp3Url\" type=\"audio/mpeg\"/>
      <guid>$mp3Url</guid>
      <pubDate>" . date('r', strtotime("2024-08-$i")) . "</pubDate>
    </item>";
    }
    ?>
  </channel>
</rss>
