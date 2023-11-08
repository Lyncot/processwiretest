<?php

// Markdown converter
include_once("parsedown.php");
$Parsedown = new Parsedown();

// Richtext converter
include_once("richtext/src/Resolver.php");
$richtext = new Resolver();

class storyblok {
  // Headers Array
  public $sbHeaders = [];

   // Get Headers from request
  private function curlHeaders($curl, $header_line) {
    $explodeArray = explode(': ', $header_line);

    // If Key Add to Array
    if(array_key_exists("1", $explodeArray)) {
      $this->sbHeaders[strtolower($explodeArray[0])] = $explodeArray[1];
    }

    return strlen($header_line);
  }

  // Get the content from the Storyblok API
  private function storyblok_curl($url, $headersMode = false) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(),
    ));

    // Output headers if required
    if ($headersMode == true) {
      curl_setopt($curl, CURLOPT_HEADERFUNCTION, array($this, 'curlHeaders'));
    }    

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
       // Output headers if required
      if ($headersMode == true) {
        $response = rtrim($response, "}");
        $response .= ",\"headers\": " . json_encode($this->sbHeaders) . "}";
      }

      return $response;
    }
  }

  // Get the current cache version
  private function cacheControl() {
      $response = $this->storyblok_curl("https://api.storyblok.com/v1/cdn/spaces/me?token=" . $GLOBALS['sb_token']);
      $object = json_decode($response, true);
      $cv = $object['space']['version'];
      return $cv;
  }

  // Get single story for page
  public function single($url, $mode = "story") {
      // Get cache version and append to API URL
      $cv = $this->cacheControl();
      $url = $url . "&cv=" . $cv;

      // Get content from Storyblok API
      $response = $this->storyblok_curl($url);

      $story = json_decode($response, true);

      // Break for no record
      if (isset($story['stories'][0])) {
        if ($story['stories'][0] == "This record could not be found") {
          return null;
        }
      } else {
        if ($story['story']['published_at'] == null) {
          return "new-page";
        }
      }

      $cms = $story["story"];
      $content = $cms["content"];

      if ($mode == "top") {
        return $cms;
      } else {
        return $content;
      } 
  }


  // Get multiple stories for views
  public function view($url, $headersMode = false) {
      // Get cache version and append to API URL
      $cv = $this->cacheControl();
      $url = $url . "&cv=" . $cv;

      // Get content from Storyblok API
      $response = $this->storyblok_curl($url, $headersMode);
      $stories = json_decode($response, true);
      $content = $stories["stories"];

      if ($headersMode) {
        return $stories;
      } else {
        return $content;
      }
  }

  // Get links
  public function links($url) {
      // Get cache version and append to API URL
      $cv = $this->cacheControl();
      $url = $url . "&cv=" . $cv;

      // Get content from Storyblok API
      $response = $this->storyblok_curl($url);
      $stories = json_decode($response, true);
      $content = $stories['links'];

      return $content;
  }

  // Get draft content for visual composer
  public function draftEdit($url) {
      // Get content from Storyblok API
      $response = $this->storyblok_curl($url);
      $story = json_decode($response, true);

      return $story;
  }
}

// Helper function to utilise Storybloks image resizer
function resizeImg($image, $option) {
  $imageService = '//img2.storyblok.com/';
  $path = str_replace('https://a.storyblok.com', '', $image);
  return $imageService . $option . $path;
}

// Helper function to convert the storyblok date format into a PHP date
function storyDate($date) {
  $time = strtotime($date);
  $convert = date('jS F Y', $time);

  return $convert;
}

// Helper function to strip layout tags
function detag($object) {
  $Parsedown = new Parsedown();

  $markdown = $Parsedown->text($object);
  $output = strip_tags($markdown, '<strong>');
  return $output;
}

// Helper function to remove just paragraph tags
function premover($object) {
  $html = preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '', $object);

  $object = str_ireplace('<p>' ,'', $object);
  $html = str_ireplace('</p>' ,'', $object);   

  return $html;
}

// Convert textarea into array of bullet points
function bulletiser($bullets) {
    $bulletsArray = explode("\n", $bullets);
    return $bulletsArray;
}

// Default mode (changes to draft for editing)
$mode = "published";

// Edit Mode Test
if (isset($_GET['_storyblok_tk'])) {
  $querytoken = $_GET['_storyblok_tk'];
}

if (!empty($querytoken)) {
    $pre_token = $querytoken['space_id'] . ':' . $sb_token . ':' . $querytoken['timestamp'];
    $token = sha1($pre_token);

    if ($token == $querytoken['token'] && (int)$querytoken['timestamp'] > strtotime('now') - 3600) {
        $sb_edit = true;
        $mode = "draft";
    }
}

$storyblok = new storyblok();

// Override to draft mode
$mode = "draft";
?>