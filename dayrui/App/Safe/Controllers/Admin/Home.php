<?php namespace Phpcmf\Controllers\Admin;

class Home extends \Phpcmf\App
{
    private $phpfile = [];

    public function __construct(...$params)
    {
        parent::__construct($params);
        \Phpcmf\Service::V()->assign([
            'menu' => \Phpcmf\Service::M('auth')->_admin_menu(
                [
                    '安全检测' => ['safe/home/index', 'fa fa-shield'],
                    '木马文件扫描' => ['safe/home/muma_index', 'fa fa-bug'],
                    '后台单独域名设置' => ['safe/home/admin_index', 'fa fa-user'],
                    '文件差异对比' => ['cloud/bf', 'fa fa-code'],
                ]
            ),
        ]);
    }

    public function index() {

        \Phpcmf\Service::V()->assign([
            'list' => [

                '1' => '后台入口名称',
                '2' => '数据缓存cache目录',
                '3' => '核心程序dayrui目录',
                '4' => '前端模板template目录',
                '5' => '文件上传存储目录',
                '6' => '用户头像上传目录',
                '7' => 'web目录权限',
                '8' => '跨站提交验证',
                '9' => '后台单独域名管理',

            ],
        ]);

        \Phpcmf\Service::V()->display('safe.html');
    }

    public function admin_index() {

        \Phpcmf\Service::V()->assign([
            'list' => \Phpcmf\Service::M()->table('site')->order_by('id asc')->getAll(),
            'data' => \Phpcmf\Service::M('app')->get_config(APP_DIR),
        ]);

        \Phpcmf\Service::V()->display('admin.html');
    }

    public function admin_add() {

        $id = (int)$_GET['id'];
        $path = trim($_GET['path']);
        if (!$id) {
            $this->_json(0, '站点id异常');
        } elseif (!$path) {
            $this->_json(0, '目录未填写');
        } elseif (!is_dir($path)) {
            $this->_json(0, '目录不存在，请创建');
        } elseif (is_file($path.'/index.php')) {
            $this->_json(0, '目录中存在index.php文件，无法生成');
        }

        $rt = file_put_contents($path.'/index.php', '<?php
define(\'SITE_ID\', '.$id.');
require "'.WEBPATH.'index.php";
');
        if (!$rt) {
            $this->_json(0, '目录['.$path.']无法创建文件');
        }
        $rt = file_put_contents($path.'/'.SELF, '<?php
define(\'IS_ADMIN\', TRUE); // 项目标识
define(\'SELF\', pathinfo(__FILE__, PATHINFO_BASENAME)); // 该文件的名称
require(\'index.php\'); // 引入主文件
');
        if (!$rt) {
            $this->_json(0, '目录['.$path.']无法创建文件');
        }

        $data = \Phpcmf\Service::M('app')->get_config(APP_DIR);
        $data[$id] = $path;
        \Phpcmf\Service::M('app')->save_config(APP_DIR, $data);

        $this->_json(1, '生成文件成功');
    }

    public function do_index() {

        $id = trim($_GET['id']);

        switch ($id) {

            case '1':

                if (SELF == 'admin.php') {
                    $this->_json(0, '修改根目录admin.php的文件名，可以有效的防止被猜疑破解');
                }
                break;


            case '2':
                if (strpos(WRITEPATH, WEBPATH) !== false) {
                    $this->_json(0, '将/cache/目录转移到Web目录之外的目录，可以防止缓存数据不被Web读取');
                }

                break;


            case '3':
                if (strpos(FCPATH, WEBPATH) !== false) {
                    $this->_json(0, '将/dayrui/目录转移到Web目录之外的目录，可以防止核心程序不被Web读取');
                }

                break;


            case '4':
                if (strpos(TPLPATH, WEBPATH) !== false) {
                    $this->_json(0, '将/template/目录转移到Web目录之外的目录，可以防止模板文件不被下载');
                }

                break;


            case '5':
                if (strpos(SYS_UPLOAD_PATH, WEBPATH) !== false) {
                    $this->_json(0, '将/uploadfile/目录转移到Web目录之外的目录，可以防止非法上传恶意文件');
                }

                if (!file_put_contents(SYS_UPLOAD_PATH.'test.php', '<?php echo "php7";')) {
                    $this->_json(0,'目录['.SYS_UPLOAD_PATH.']无法写入文件');
                }

                $url = SYS_UPLOAD_URL.'test.php';
                if (!function_exists('stream_context_create')) {
                    $this->_json(0, '函数没有被启用：stream_context_create');
                }
                $context = stream_context_create(array(
                    'http' => array(
                        'timeout' => 5 //超时时间，单位为秒
                    )
                ));
                $code = file_get_contents($url, 0, $context);
                if ($code == '<?php echo "php7";') {
                    $this->_json(1, '安全');
                } elseif ($code == 'php7') {
                    $this->_json(0, '必须将附件域名使用纯静态网站');
                } else {
                    $this->_json(1, '域名绑定异常，无法访问：'.$url.'，可以尝试手动访问此地址，<br>如果提示<？php echo "php7";就表示成功', 0);
                }

                break;


            case '6':

                list($cache_path, $cache_url) = dr_avatar_path();
                if (strpos($cache_path, WEBPATH) !== false) {
                    $this->_json(0, '将头像目录转移到Web目录之外的目录，可以防止非法上传恶意文件');
                }

                if (!file_put_contents($cache_path.'test.php', '<?php echo "php7";')) {
                    $this->_json(0,'目录['.$cache_path.']无法写入文件');
                }

                $url = $cache_url.'test.php';
                if (!function_exists('stream_context_create')) {
                    $this->_json(0, '函数没有被启用：stream_context_create');
                }
                $context = stream_context_create(array(
                    'http' => array(
                        'timeout' => 5 //超时时间，单位为秒
                    )
                ));
                $code = file_get_contents($url, 0, $context);
                if ($code == '<?php echo "php7";') {
                    $this->_json(1, '安全');
                } elseif ($code == 'php7') {
                    $this->_json(0, '必须将头像域名使用纯静态网站');
                } else {
                    $this->_json(1, '域名绑定异常，无法访问：'.$url.'，可以尝试手动访问此地址，<br>如果提示<？php echo "php7";就表示成功', 0);
                }

                break;


            case '7':

                if (IS_EDIT_TPL) {
                    $this->_json(0, '系统开启了在线编辑模板权限，建议关闭此权限');
                }
                if (file_put_contents(WEBPATH.'test_phpcmf.php', '<?php echo "test_phpcmf";')) {
                    unlink(WEBPATH.'test_phpcmf.php');
                    $this->_json(1,'目录['.WEBPATH.']建议赋予只读权限，Linux555权限');
                }
                break;


            case '8':

                if (defined('SYS_CSRF') && !SYS_CSRF) {
                    $this->_json(0, '系统没有开启跨站验证，建议开启');
                }
                break;


            case '9':

                if (!defined('IS_MY_ADMIN')) {
                    $this->_json(1, '后台没有设置单独访问域名');
                }

                break;

        }

        $this->_json(1,'合格');
    }

    public function book_index() {
        \Phpcmf\Service::V()->display('book_'.intval($_GET['id']).'.html');exit;
    }



    public function muma_index() {
        \Phpcmf\Service::V()->display('muma.html');
    }

    // php文件个数
    public function php_count_index() {

        // 读取文件到缓存
        $this->_file_map(WEBPATH);

        $cache = [];
        $count = $this->phpfile ? count($this->phpfile) : 0;
        if ($count > 100) {
            $pagesize = ceil($count/100);
            for ($i = 1; $i <= 100; $i ++) {
                $cache[$i] = array_slice($this->phpfile, ($i - 1) * $pagesize, $pagesize);
            }
        } else {
            for ($i = 1; $i <= $count; $i ++) {
                $cache[$i] = array_slice($this->phpfile, ($i - 1), 1);
            }
        }

        // 存储文件
        \Phpcmf\Service::L('cache')->set_data('check-index', $cache, 3600);

        $this->_json($cache ? count($cache) : 0, 'ok');
    }

    public function php_check_index() {

        $page = max(1, intval($_GET['page']));
        $cache = \Phpcmf\Service::L('cache')->get_data('check-index');
        !$cache && $this->_json(0, '数据缓存不存在');

        $data = $cache[$page];
        if ($data) {
            $html = '';
            foreach ($data as $filename) {

                // 避免自杀
                if (strpos($filename, 'Safe/Controllers/Admin/Home.php') !== false) {
                    continue;
                } elseif (strpos($filename, 'Safe\Controllers\Admin\Home.php') !== false) {
                    continue;
                }

                $contents = file_get_contents ( $filename );

                $ok = "<span class='ok'>正常</span>";
                $class = '';
                if ($this->_is_bom($contents)) {
                    $ok = "<span class='error'>存在Bom字符</span>";
                    $class = ' p_error';
                } elseif ($this->_is_muma($contents)) {
                    $ok = "<span class='error'>存在问题</span>";
                    $class = ' p_error';
                }

                $html.= '<p class="'.$class.'"><label class="rleft">'.dr_safe_replace_path($filename).'</label><label class="rright">'.$ok.'</label></p>';
                if ($class) {
                    $html.= '<p class="rbf" style="display: none"><label class="rleft">'.$filename.'</label><label class="rright">'.$ok.'</label></p>';
                }
            }
            $this->_json($page + 1, $html);
        }

        // 完成
        \Phpcmf\Service::L('cache')->clear('check-index');
        $this->_json(100, '');
    }

    private function _is_muma($contents) {
        if (stripos($contents, 'eval($_POST') !== false) {
            return 1;
        } elseif (stripos($contents, 'eval($_GET') !== false) {
            return 1;
        } elseif (stripos($contents, 'eval($_REQUEST') !== false) {
            return 1;
        }
        return 0;
    }

    private function _is_bom($contents) {
        $charset [1] = substr ( $contents, 0, 1 );
        $charset [2] = substr ( $contents, 1, 1 );
        $charset [3] = substr ( $contents, 2, 1 );
        if (ord ( $charset [1] ) == 239 && ord ( $charset [2] ) == 187 && ord ( $charset [3] ) == 191) {
            return 1;
        }
        return 0;
    }

    private function _file_map($source_dir, $exit = 0) {
        if ($fp = @opendir($source_dir)) {
            $source_dir	= rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
            while (false !== ($file = readdir($fp))) {
                // Remove '.', '..', and hidden files [optional]
                if ($file === '.' || $file === '..') {
                    continue;
                }
                is_dir($source_dir.$file) && $file .= DIRECTORY_SEPARATOR;
                if (is_dir($source_dir.$file) && !$exit) {
                    $this->_file_map($source_dir.$file, $exit);
                } else {
                    trim(strtolower(strrchr($file, '.')), '.') == 'php' && $this->phpfile[] = $source_dir.$file;
                }
            }
            closedir($fp);
        }
    }
}
