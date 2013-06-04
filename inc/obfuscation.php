<?php
/**
 * Text obfuscation encoder.
 *
 * @since Gutspot Theme 1.0
 */


/**
 * Return the obfuscation code for the given text.
 *
 * @since Gutspot Theme 1.0
 */
function get_text_obfuscation($text) {
  $rand = rand(0, 255);
  $obfu = ($rand < 16 ? '0' : '') . dechex($rand);

  $arr = str_split($text);
  foreach ($arr as $char) {
    $temp = ord($char) ^ $rand;
    $obfu .= ($temp < 16 ? '0' : '') . dechex($temp);
  }

  return $obfu;
}

/**
 * Print the obfuscation code for the given text.
 *
 *
 */
function text_obfuscation($text) {
  echo get_text_obfuscation($text);
}
?>