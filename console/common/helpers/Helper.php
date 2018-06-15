<?php

namespace console\common\helpers;

class Helper
{
    public static function sendStreamFile($url, $sendData)
    {
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'content-type:application/x-www-form-urlencoded',
                'content' => $sendData,
            ),
        );

        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
        //echo $response;
        $ret = json_decode($response, true);
        return $ret;
    }

    public static function get_contents($url, $timeout = 4)
    {
        $opts = array('http' => array('method' => 'GET', 'timeout' => $timeout));
        $context = stream_context_create($opts);
        $html = @file_get_contents($url, false, $context);
        if ($html) {
            return $html;
        } else {
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);
            $result = curl_exec($curlHandle);
            curl_close($curlHandle);
            //echo $result;
            return trim($result);
        }
    }

    public static function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function write_logs($file, $logs)
    {
        $handle = fopen($file, "a");
        if ($handle) {
            fwrite($handle, $logs . "\r\n");
            fclose($handle);
        }
    }

    public static function pipei($str, $arr, $key)
    {
        if ($key == "carDrive") {
            $carDriver = array("前驱", "后驱", "四驱");
            foreach ($carDriver as $item) {
                if (strpos($str, $item) !== false) {
                    return $item;
                }
            }
        }
        if (count($arr[$key]) == 1) {
            return $arr[$key][0];
        } else {
            foreach ($arr[$key] as $item) {
                if (strpos($str, $item) !== false) {
                    return $item;
                }
            }
        }
    }

    public static function putImgToLocal($url, $dir, $filename)
    {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $content = file_get_contents($url);
        $fname = $dir . "/" . $filename;
        file_put_contents($fname, $content);
    }

    public static function randstr($leng = 8)
    {
        $str = "abcdefgh0123456789igklmno0123456789pqrstuvwxyzA0123456789BCDEFGHIGK0123456789LMNOPQRSTUVWXYZ0123456789";
        $n = strlen($str);
        $ret = "";
        for ($i = 0; $i < $leng; $i++) {
            $ret .= substr($str, rand(0, $n), 1);
        }
        return $ret;
    }

    public static function findSearch($sear, $str)
    {
        foreach ($sear as $item) {
            if (strpos($str, $item) !== false) {
                return $item;
            }
        }
        return '';
    }

    public static function findDrive($sear, $str)
    {
        foreach ($sear as $item) {
            if (strpos($str, $item) !== false) {
                return $item;
            }
        }
        if (strpos($str, "前驱") !== false) {
            return "两驱";
        }
        if (strpos($str, "后驱") !== false) {
            return "两驱";
        }

        return '';
    }

    public static function sql_str_add($table_name, $arr = array())
    {
        $str = "";
        $filed = $value = array();
        foreach ($arr as $key => $val) {
            $filed[] = "`$key`";
            //$value[]="'".htmlspecialchars($val,ENT_QUOTES).".'";
            $value[] = "'" . str_replace("'", "\'", $val) . "'";
            //$value[]="'".str_replace('"','\"',$val).".'";
        }
        $str = "insert into `$table_name`(" . implode(",", $filed) . ")values(" . implode(",", $value) . ")";
        return $str;
    }

    public static function sql_str_update($table_name, $arr = [], $map = [])
    {
        $does = "UPDATE $table_name SET ";

        $sett = [];
        foreach ($arr as $key => $val) {
            $sett[] = "$key='$val'";
        }
        $setting = implode(",", $sett);

        if (count($map) > 0) {
            foreach ($map as $key => $val) {
                $where[] = "$key='$val'";
            }
            $whereString = " WHERE " . implode(" AND ", $where);
        } else {
            $whereString = "";
        }

        return $does . $setting . $whereString;
    }
}
