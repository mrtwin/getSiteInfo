<?php
require_once 'Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '402283017180563',
  'app_secret' => 'yyy',
  'default_graph_version' => 'v3.2',
  ]);

// Since all the requests will be sent on behalf of the same user,
// we'll set the default fallback access token here.
$fb->setDefaultAccessToken('xxx');

/**
 * Generate some requests and then send them in a batch request.
 */

// Get the name of the logged in user
$requestUserName = $fb->request('GET', '/me?fields=id,name');
// echo '<pre>' . var_dump($requestUserName) . '</pre>';
// Get user likes
$requestUserLikes = $fb->request('GET', '/me/likes?fields=id,name&amp;limit=1');

// Get user events
$requestUserEvents = $fb->request('GET', '/me/events?fields=id,name&amp;limit=2');

// Post a status update with reference to the user's name
$message = 'My name is {result=user-profile:$.name}.' . "\n\n";
$message .= 'I like this page: {result=user-likes:$.data.0.name}.' . "\n\n";
$message .= 'My next 2 events are {result=user-events:$.data.*.name}.';
$statusUpdate = ['message' => $message];
$requestPostToFeed = $fb->request('POST', '/me/feed', $statusUpdate);

// Get user photos
$requestUserPhotos = $fb->request('GET', '/me/photos?fields=id,source,name&amp;limit=2');

$batch = [
    'user-profile' => $requestUserName,
    'user-likes' => $requestUserLikes,
    'user-events' => $requestUserEvents,
    'post-to-feed' => $requestPostToFeed,
    'user-photos' => $requestUserPhotos,
    ];

echo '<h1>Make a batch request</h1>' . "\n\n";

try {
  echo "its try<br>";
  //$url = 'https://facebook.com/groups/124718804372908';
  $responses = $fb->sendRequest('GET', '/me?fields=id,name');
  // $responses = $fb->sendRequest('GET', '/groups/124718804372908');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
echo "before Foreach<br>";
foreach ($responses as $key => $response) {
  echo "its Foreach<br>";
  if ($response->isError()) {
    $e = $response->getThrownException();
    echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
    echo '<p>Graph Said: ' . "\n\n";
    var_dump($e->getResponse());
  } else {
    // echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
    // echo "Response: " . $response->getBody() . "</p>\n\n";
    echo "its OK<hr />\n\n";
  }
}
?>