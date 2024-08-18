<?php
// Output the XML header
header('Content-Type: application/rss+xml; charset=UTF-8');

// Begin the RSS XML structure
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss version="2.0">
  <channel>
    <title>南懷瑾先生, 金剛經說什麼</title>
    <link>https://www.buda.idv.tw/db.asp?node=548</link>
    <description>金剛經說什麼 - 佛學多媒體資料庫 https://www.buda.idv.tw/db.asp?node=548</description>
    <language>zh-tw</language>
    <author>南懷瑾</author>
    <category>Religion &amp; Spirituality</category>
    <image>
      <url>https://s3proxy.cdn-zlib.se/covers400/collections/userbooks/37d2b65f918058d7a19f71c7edd49db709dd10d23e72d0ec741bbb7b75e7dde0.jpg</url>
      <title>南懷瑾先生, 金剛經說什麼</title>
      <link>https://www.buda.idv.tw/db.asp?node=548</link>
    </image>

    <!-- Episodes -->
    <?php
    require_once getenv('HOME') . '/.composer/vendor/autoload.php';
    function getMp3Duration($url) {
      // Temporary file path
      $tempFile = tempnam(sys_get_temp_dir(), 'mp3');
  
      // Download the file to the temporary location
      file_put_contents($tempFile, file_get_contents($url));
  
      // Initialize the getID3 engine
      $getID3 = new getID3;
  
      // Analyze the MP3 file
      $fileInfo = $getID3->analyze($tempFile);
  
      // Delete the temporary file after analysis
      unlink($tempFile);
  
      // Check if 'playtime_seconds' exists and return it, otherwise return null
      if (isset($fileInfo['playtime_seconds'])) {
          return $fileInfo['playtime_seconds'];
      } else {
          // Handle the case where the duration could not be determined
          if (isset($fileInfo['error'])) {
              echo 'Error: ' . implode(', ', $fileInfo['error']) . PHP_EOL;
          }
          return null;
      }
    }
    $getID3 = new getID3;
    for ($i = 1; $i <= 21; $i++) {
        $episodeNumber = sprintf("%02d", $i);
        $mp3Url = "https://download.buda.idv.tw/lecture/NHJ_JGJ" . $episodeNumber . ".mp3";
        // Analyze the MP3 file
        $durationSeconds = getMp3Duration($mp3Url);
    
        // Convert duration to the format HH:MM:SS
        $duration = gmdate("H:i:s", (int)$durationSeconds);
        echo "
    <item>
      <title>南懷瑾-金剛經 $episodeNumber</title>
      <description>Episode $episodeNumber</description>
      <enclosure url=\"$mp3Url\" type=\"audio/mpeg\"/>
      <guid>$mp3Url</guid>
      <pubDate>" . date('r', strtotime("2005-12-$i")) . "</pubDate>
      <itunes:duration>$duration</itunes:duration>
    </item>";
    }
    ?>
  </channel>
</rss>
