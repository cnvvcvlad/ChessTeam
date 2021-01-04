<?php header("Content-type: application/rss+xml"); ?>
<rss version="2.0">
<?php if (!empty($lastArticles)) : ?>
<channel>
 <title>TeamNogent.org</title>
 <description>This is an example of an RSS feed</description>
 <link>https://www.teamnogent.org</link>
 <copyright>2021 TeamNogent.org All rights reserved</copyright>
 <?php if (!empty($lastArticle_one)) : ?>
 <lastBuildDate><?php date(DATE_RSS, strtotime($lastArticle_one[0]->getArt_date_creation())) ?></lastBuildDate>
 <?php endif; ?>
 <pubDate>Sun, 06 Sep 2009 16:20:00 +0000</pubDate>
 <ttl>1800</ttl>
<?php foreach ($lastArticles as $key => $values) : ?>
 <item>
  <title><?= utf8_decode($values->getArt_title()) ?></title>
  <description><?= utf8_decode(substr($values->getArt_description(), 0, 200)).'...' ?></description>
  <link>https://www.teamnogent.org</link>
  <pubDate><?= date(DATE_RSS, strtotime($values->getArt_date_creation())) ?>
  </pubDate>
  <image>
    <url>https://www.teamnogent.org/miniatures/foto.jpg</url>
    <link>https://www.teamnogent.org/article.php</link>
  </image>
 </item>
 <?php endforeach; ?>
</channel>
<?php endif; ?>
</rss>