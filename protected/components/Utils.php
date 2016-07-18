<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author Dell
 */
class Utils {

    /**
     * 中文字符串截取
     * @param string    $string  需要截取的字符串
     * @param int       $length  截取的长度
     * @param string    $etc     被截取的部分替换的字符串
     * @param bool    $encry     是否需要返回转义后的字符串
     */
    public static function cutString($string, $length, $etc = '...', $charset = 'UTF-8') {
        $trans = array('&nbsp;' => ' ');
        $string = strtr($string, $trans);
        $string = trim(strip_tags($string));
        $string = mb_strimwidth($string, 0, $length * 2, $etc, $charset);
        return $string;
    }

    /**
     * 获取图片链接
     * @param type $img
     * @param type $is_domain
     * @return string
     */
    public static function getImageUrl($img, $is_domain = false) {
        if (!$img) {
            return "";
        }
        if ($is_domain) {
            $domain = Yii::app()->params['host'];
            return $domain . $img;
        }
        return $img;
    }

    /**
     * 判断是否是手机访问
     * @return boolean
     */
    public static function is_mobile_request() {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
            $mobile_browser++;
        if ((isset($_SERVER['HTTP_ACCEPT'])) and ( strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
            $mobile_browser++;
        if (isset($_SERVER['HTTP_PROFILE']))
            $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
        );
        if (in_array($mobile_ua, $mobile_agents))
            $mobile_browser++;
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
            $mobile_browser++;
        // Pre-final check to reset everything if the user is on Windows  
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
            $mobile_browser = 0;
        // But WP7 is also Windows, with a slightly different characteristic  
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
            $mobile_browser++;
        if ($mobile_browser > 0)
            return true;
        else
            return false;
    }

    /**
     * Yii取第一个错误
     * @param type $errors
     * @return type
     */
    public static function getFirstError($errors) {
        $return = "";
        foreach ($errors as $k => $v) {
            $return = $v[0];
        }
        return $return;
    }

    public static function password($password) {
        return md5($password);
    }

    /**
     * 取得“是否”的数组
     * @param type $key
     * @return string
     */
    public static function getTrueOrFalse($key = '') {
        $return = array(
            '1' => '是',
            '0' => '否',
        );
        if (key_exists($key, $return)) {
            return $return[$key];
        }
        return $return;
    }

    /**
     * 取得一个文件的后缀
     * @param type $filename
     * @return type
     */
    public static function fileext($filename) {
        return substr(strrchr($filename, '.'), 1);
    }

    // 循环创建目录
    public static function mk_dir($dir, $mode = 0777) {
        if (is_dir($dir) || @mkdir($dir, $mode))
            return true;
        if (!self::mk_dir(dirname($dir), $mode))
            return false;
        return @mkdir($dir, $mode);
    }

    /**
     * 过滤不完整的utf8编码字符
     * @param string $str
     * @return string
     */
    public static function filterPartialUTF8Char($str) {
        $str = preg_replace("/[\\xC0-\\xDF](?=[\\x00-\\x7F\\xC0-\\xDF\\xE0-\\xEF\\xF0-\\xF7]|$)/", "", $str);
        $str = preg_replace("/[\\xE0-\\xEF][\\x80-\\xBF]{0,1}(?=[\\x00-\\x7F\\xC0-\\xDF\\xE0-\\xEF\\xF0-\\xF7]|$)/", "", $str);
        $str = preg_replace("/[\\xF0-\\xF7][\\x80-\\xBF]{0,2}(?=[\\x00-\\x7F\\xC0-\\xDF\\xE0-\\xEF\\xF0-\\xF7]|$)/", "", $str);
        return $str;
    }

    /**
     * 有[&#]的数据转换成正常数据
     */
    public static function deSlashes($value, $ucfirst = false) {
        if (empty($value)) {
            return $value;
        }
        if (mb_check_encoding($value, 'GBK') !== true) {
            $value = self::filterPartialUTF8Char($value);
        }
        if (mb_check_encoding($value, 'GBK') == false && mb_check_encoding($value, 'UTF-8') == false) {
            return '';
        }
        if (mb_check_encoding($value, 'GBK') == true && mb_check_encoding($value, 'UTF-8') !== true) {
            $value = mb_convert_encoding($value, 'UTF-8', 'GBK');
        }
        if (strpos($value, '&') !== false) {
            $value = htmlspecialchars_decode($value, ENT_QUOTES | ENT_NOQUOTES);
        }
        if (strpos($value, '&#') === false) {
            return $value;
        }

        $filters = array('&' => '&#' . ord('&') . ';', '#' => '&#' . ord('#') . ';', ' ' => '&#' . ord(' ') . ';', '\'' => '&#' . ord('\'') . ';', '>' => '&#' . ord('>') . ';',
            '<' => '&#' . ord('<') . ';', '=' => '&#' . ord('=') . ';', '!' => '&#' . ord('!') . ';', '^' => '&#' . ord('^') . ';', '+' => '&#' . ord('+') . ';',
            '-' => '&#' . ord('-') . ';', '*' => '&#' . ord('*') . ';', '/' => '&#' . ord('/') . ';', '%' => '&#' . ord('%') . ';', '|' => '&#' . ord('|') . ';',
            '~' => '&#' . ord('~') . ';', '@' => '&#' . ord('@') . ';', '"' => '&#' . ord('"') . ';', ';' => '&#' . ord(';') . ';');
        $value = strtr($value, array_flip($filters));
        if ($ucfirst === true) {
            $value = strtolower($value);
        }
        return $value;
    }

    /**
     * 数据转换成有[&#]
     */
    public static function enSlashes($value, $ucfirst = false) {
        if (empty($value)) {
            return $value;
        }
        //过滤不完整的utf8字符
        if (mb_check_encoding($value, 'GBK') !== true) {
            $value = self::filterPartialUTF8Char($value);
        }
        if (mb_check_encoding($value, 'GBK') == false && mb_check_encoding($value, 'UTF-8') == false) {
            return '';
        }
        if (mb_check_encoding($value, 'GBK') == true && mb_check_encoding($value, 'UTF-8') !== true) {
            $value = mb_convert_encoding($value, 'UTF-8', 'GBK');
        }
        if (strpos($value, '&') !== false) {
            $value = htmlspecialchars_decode($value, ENT_QUOTES | ENT_NOQUOTES);
        }
        $filters = array('&' => '&#' . ord('&') . ';', '#' => '&#' . ord('#') . ';', ' ' => '&#' . ord(' ') . ';', '\'' => '&#' . ord('\'') . ';', '>' => '&#' . ord('>') . ';',
            '<' => '&#' . ord('<') . ';', '=' => '&#' . ord('=') . ';', '!' => '&#' . ord('!') . ';', '^' => '&#' . ord('^') . ';', '+' => '&#' . ord('+') . ';',
            '-' => '&#' . ord('-') . ';', '*' => '&#' . ord('*') . ';', '/' => '&#' . ord('/') . ';', '%' => '&#' . ord('%') . ';', '|' => '&#' . ord('|') . ';',
            '~' => '&#' . ord('~') . ';', '@' => '&#' . ord('@') . ';', '"' => '&#' . ord('"') . ';', ';' => '&#' . ord(';') . ';');
        $value = strtr($value, $filters);
        if (strpos($value, '&#38;&#35;') !== false) {//如果本身就含转义字符
            $value = str_replace('&#38;&#35;', '&#', $value);
        }
        if ($ucfirst === true) {
            $value = strtolower($value);
        }
        return $value;
    }

    /**
     * 获取文件列表(所有子目录文件)     *
     * @param string $path 目录
     * @param array $file_list 存放所有子文件的数组
     * @param array $ignore_dir 需要忽略的目录或文件
     * @return array 数据格式的返回结果
     */
    public static function readFileList($path, &$file_list, $ignore_dir = array()) {
        $path = rtrim($path, '/');
        if (is_dir($path)) {
            $handle = @opendir($path);
            if ($handle) {
                while (false !== ($dir = readdir($handle))) {
                    if ($dir != '.' && $dir != '..') {
                        if (!in_array($dir, $ignore_dir)) {
                            if (is_file($path . '/' . $dir)) {
                                $file_list[] = $path . '/' . $dir;
                            } elseif (is_dir($path . '/' . $dir)) {
                                readFileList($path . '/' . $dir, $file_list, $ignore_dir);
                            }
                        }
                    }
                }
                @closedir($handle);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 获取网站访问者信息
     */
    public static function getNapsBot() {
        $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (strpos($useragent, 'googlebot') !== false) {
            return 'google';
        }
        if (strpos($useragent, 'baiduspider') !== false) {
            return 'baidu';
        }
        if (strpos($useragent, 'msnbot') !== false) {
            return 'bing';
        }
        if (strpos($useragent, 'slurp') !== false) {
            return 'yahoo';
        }
        if (strpos($useragent, 'sosospider') !== false) {
            return 'soso';
        }
        if (strpos($useragent, 'sogou spider') !== false) {
            return 'sogou';
        }
        if (strpos($useragent, 'yodaobot') !== false) {
            return 'yodao';
        }
        return NULL;
    }

    /**
     * 将gb2312转换成utf-8格式之后，每个中文的字节数从2个增加到3个之后导致了反序列化的时候判断字符长度出现了问题，所以需要使用正则表达式将序列化的数组中的表示字符长度的值重新计算一遍
     * @param type $serial_str
     * @return type
     */
    public static function mb_unserialize($serial_str) {
        $serial_str = preg_replace_callback('!s:(\d+):"(.*?)";!s', create_function('$math', "return 's:'.strlen(\$math[2]).':\"'.\$math[2].'\";';"), $serial_str);
        return unserialize($serial_str);
    }

    /**
     * @desc 发送邮件
     * @param string $to 收件人
     * @param string $title 邮件标题
     * @param string $content 邮件内容
     * @return boolean $return
     * @author wg
     */
    public static function sendMail($to, $title, $content) {
        //发邮件
        $email = new Email();
        $email_params = Yii::app()->params['email'];
        $email->set('email_server', $email_params['email_server']);
        $email->set('email_port', $email_params['email_port']);
        $email->set('email_user', $email_params['email_user']);
        $email->set('email_password', $email_params['email_password']);
        $email->set('email_from', $email_params['email_from']);
        $email->set('site_name', $email_params['site_name']);
        $rs = $email->send($to, $title, $content);
        $msg = $email->getErrMsg();
        return Utils::formatReturn($rs, $msg);
    }

    //格式化返回的数据
    public static function formatReturn($status, $message, $isJson = false) {
        $return = array('status' => $status, 'message' => $message);
        if ($isJson) {
            return CJSON::encode($return);
        }
        return $return;
    }
		public static function getImageNameNotExt($img) {
        if (!$img)
            return "";
        $img = substr($img, 0, strrpos($img, '.'));
        $img = substr($img, strrpos($img, '/') + 1);
        return $img;
    }

    public static function printr($data, $is_exit = true) {
        header("Content-type:text/html;charset=utf-8");
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $is_exit && exit;
    }

    // 远程请求（不获取内容）函数
    public static function sock_request($url) {
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $port = $port ? $port : 80;
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query)
            $path .= '?' . $query;
        if ($scheme == 'https') {
            $host = 'ssl://' . $host;
        }
        $error_code = 0;
        $error_msg = "";
        $fp = fsockopen($host, $port, $error_code, $error_msg, 1);
        if (!$fp) {
            $error_code = 1;
            $error_msg = "远程错误";
            return array('error_code' => $error_code, 'error_msg' => $error_msg);
        } else {
            stream_set_blocking($fp, true); //开启了手册上说的非阻塞模式
            stream_set_timeout($fp, 1); //设置超时
            $header = "GET $path HTTP/1.1\r\n";
            $header.="Host: $host\r\n";
            $header.="Connection: close\r\n\r\n"; //长连接关闭
            fwrite($fp, $header);
            usleep(1000); // 这一句也是关键，如果没有这延时，可能在nginx服务器上就无法执行成功
            fclose($fp);
            return array('error_code' => 0);
        }
    }

    /**
     * 将二维数组的某个值如id的值作为上级数组的key
     * @param type $items
     * @param type $key
     * @return type
     */
    public static function getSubColumnValueToParentKey($items, $key) {
        return array_combine(array_column($items, $key), $items);
    }

    /**
     * 取无限级
     */
    public static function getSubUnlimit($model) {
        $items = self::getSubColumnValueToParentKey(self::object2array($model), 'id');
        $tree = array();
        foreach ($items as $item) {
            if (isset($items[$item['pid']])) {
                $items[$item['pid']]['sub'][$item['id']] = &$items[$item['id']];
            } else {
                $tree[$item['id']] = &$items[$item['id']];
            }
        }
        return $tree;
    }

}
