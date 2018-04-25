<?hh

class View {
  public static function render($body) {
    return
    <x:doctype>
      <html>
        <head>
          <meta http-equiv="Cache-control" content="no-cache" />
          <meta http-equiv="Expires" content="-1" />
          <meta charset="UTF-8" />
          <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
          />
          <title>IG Graph</title>
          <link
            rel="icon"
            type="image/png"
            href="static/img/favicon.png"
          />
          <link rel="stylesheet" href="static/css/ig-graph.css" />
        </head>
        <body>
        {$body}
        </body>
      </html>
      </x:doctype>;
  }

  public static function genIndex($basic_info) {
    $body = <div>
      <img src={$basic_info['profile_picture_url']}/>
      <ul>
        <li>{$basic_info['username']}</li>
        <li>followers: {$basic_info['followers_count']}</li>
        <li>follows: {$basic_info['follows_count']}</li>
        <li>media: {$basic_info['media_count']}</li>
      </ul>
    </div>;

    return self::render($body);
  }
}
