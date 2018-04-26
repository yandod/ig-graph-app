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

  public static function genIndex($basic_info, $daily_imps) {
    $body = <div>
      <img src={$basic_info['profile_picture_url']}/>
      <ul>
        <li>{$basic_info['username']}</li>
        <li>followers: {$basic_info['followers_count']}</li>
        <li>follows: {$basic_info['follows_count']}</li>
        <li>media: {$basic_info['media_count']}</li>
      </ul>
    </div>;
    $table = self::genImpTable($daily_imps);
    $body->appendChild($table);
    return self::render($body);
  }

  public static function genImpTable($daily_imps) {
    $table = <table>
      <tr>
        <th>Date</th>
        <th>IMP</th>
        <th>REACH</th>
        <th>PROFILE VIEW</th>
      </tr>
    </table>;

    $data = Map {};


    $daily_arr = $daily_imps->asArray();

    foreach ($daily_arr as $row) {
      $types = ['impressions','reach','profile_views'];
      foreach ($types as $type) {
        if ($row['name'] === $type) {
          foreach ($row['values'] as $value) {
            $date = $value['end_time']->format('Y-m-d');
            if (!$data->contains($date)) {
              $data[$date] = Map{};
            }
            $data[$date][$type] = $value['value'];
          }
        }
      }
    }

    foreach ($data as $endtime => $row) {
      $line = <tr>
        <td>{$endtime}</td>
        <td>{$row['impressions']}</td>
        <td>{$row['reach']}</td>
        <td>{$row['profile_views']}</td>
      </tr>;
      $table->appendChild($line);
    }

    return $table;
  }
}
