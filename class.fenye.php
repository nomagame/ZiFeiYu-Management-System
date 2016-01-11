<?php
/* ---------------------------------------------------- */
/* 程序名称: 牛叉广告管理优化大师(NiuXams)
/* 程序功能: 快速低成本建立自己网站的广告管理、智能投放系统！
/* 程序开发: 牛叉软件(NiuXSoft.Com)
/* 版权所有: [NiuXams] (C)2013-2099 NiuXSoft.Com
/* 官方网站: niuxsoft.com  Email: niuxsoft@163.com
/* ---------------------------------------------------- */
/* 使用条款:
/* 1.该软件个人非商业用途免费使用.
/* 2.免费使用禁止修改版权信息和官方推广链接.
/* 3.禁止任何衍生版本.
/* ---------------------------------------------------- */
defined('IN_NIUXAMS') or exit('Access Denied.');
class fenye
{
    private $nums;
    //总条目数
    private $each_disNums;
    //每页显示的条目数
    private $current_page;
    //当前被选中的页
    private $sub_pages;
    //每次显示的页数
    private $pageNums;
    //总页数
    private $page_array = array();
    //用来构造分页的数组
    private $subPage_link;
    //每个分页的链接
    private $subPage_type;
    //显示分页的类型
	public $jieguo;
	//输出结果
    /*
    __construct是fenye的构造函数，用来在创建类的时候自动运行.
    @nums            总条目数
    @$each_disNums   每页显示的条目数
    @current_page    当前被选中的页
    @sub_pages       每次显示的页数
    @subPage_link    每个分页的链接
    @subPage_type    显示分页的类型
     
    当@subPage_type=1的时候为普通分页模式
          example：   共4523条记录 每页显示10条 当前第1/453页 [首页] [上页] [下页] [尾页]
    当@subPage_type=2的时候为经典分页样式
          example：   当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
    当@subPage_type=3的时候为经典长分页样式
          example：   共4523条记录 每页显示10条 当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页] 直接跳到第[ ]页
    */
    public function __construct($nums, $each_disNums, $current_page, $sub_pages, $subPage_link, $subPage_type)
    {
        $this->nums = intval($nums);
        $this->each_disNums = intval($each_disNums);
        $this->pageNums = ceil($this->nums / $this->each_disNums);
		$this->current_page = (is_numeric(intval($current_page)) && (intval($current_page) > 1)) ? intval($current_page) : 1;
		$this->current_page = ($this->current_page > $this->pageNums) ? $this->pageNums : $this->current_page;
        $this->sub_pages = intval($sub_pages);
        $this->subPage_link = $subPage_link;
        $this->show_SubPages($subPage_type);
    }
    /* 
     __destruct析构函数，当类不在使用的时候调用，该函数用来释放资源。 
    */
    public function __destruct()
    {
        unset($nums);
        unset($each_disNums);
        unset($current_page);
        unset($sub_pages);
        unset($pageNums);
        unset($page_array);
        unset($subPage_link);
        unset($subPage_type);
        unset($jieguo);
    }
    /* 
     show_SubPages函数用在构造函数里面。而且用来判断显示什么样子的分页   
    */
    public function show_SubPages($subPage_type)
    {
        if ($subPage_type == 1) {
            $this->subPageCss1();
        } elseif ($subPage_type == 2) {
            $this->subPageCss2();
        } elseif ($subPage_type == 3) {
            $this->subPageCss3();
        } elseif ($subPage_type == 4) {
            $this->subPageCss4();
        }
    }
    /* 
     用来给建立分页的数组初始化的函数。 
    */
    public function initArray()
    {
        for ($i = 0; $i < $this->sub_pages; $i++) {
            $this->page_array[$i] = $i;
        }
        return $this->page_array;
    }
    /* 
     construct_num_Page该函数使用来构造显示的条目 
     即使：[1][2][3][4][5][6][7][8][9][10] 
    */
    public function construct_num_Page()
    {
        if ($this->pageNums < $this->sub_pages) {
            $current_array = array();
            for ($i = 0; $i < $this->pageNums; $i++) {
                $current_array[$i] = $i + 1;
            }
        } else {
            $current_array = $this->initArray();
            if ($this->current_page <= ceil($this->sub_pages/2)) {
                for ($i = 0; $i < count($current_array); $i++) {
                    $current_array[$i] = $i + 1;
                }
            } elseif ($this->current_page <= $this->pageNums && $this->current_page > ($this->pageNums - $this->sub_pages) + 1) {
                for ($i = 0; $i < count($current_array); $i++) {
                    $current_array[$i] = (($this->pageNums - $this->sub_pages) + 1) + $i;
                }
            } else {
                for ($i = 0; $i < count($current_array); $i++) {
                    $current_array[$i] = ($this->current_page - ceil($this->sub_pages/2) +1) + $i;
                }
            }
        }
        return $current_array;
    }
    /* 
     construct_num_Page该函数使用来构造显示的条目 
     即使：[1][2][3][4][5][6][7][8][9][10] 
    */
    public function construct_num_Page1()
    {
        if ($this->pageNums < $this->sub_pages) {
            $current_array = array();
            for ($i = 0; $i < $this->pageNums; $i++) {
                $current_array[$i] = $i + 1;
            }
        } else {
            $current_array = $this->initArray();
            if ($this->current_page <= $this->sub_pages) {
                for ($i = 0; $i < count($current_array); $i++) {
                    $current_array[$i] = $i + 1;
                }
            } else {
                for ($i = 0; $i < count($current_array); $i++) {
                    $current_array[$i] = ($this->current_page - $this->sub_pages) + $i + 1;
                }
            }
        }
        return $current_array;
    }
    /* 
    构造经典长模式的分页 
    共 4523 条记录 每页显示[ 30 ]条 当前第[ 1 ]/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]  
    */
    public function subPageCss1()
    {
        $subPageCss1Str = ' 共 ' . $this->nums . ' 条记录 ';
        $subPageCss1Str .= '每页显示<input class="limit ui-widget-content" name="limit" type="text" title="输入每页显示数，按回车或失去焦点" value="' . $this->each_disNums . '" />条 ';
        $subPageCss1Str .= '当前第<input class="page ui-widget-content" name="page" type="text" title="输入页码，按回车或失去焦点快速跳转" value="' . $this->current_page . '" />/' . $this->pageNums . '页 ';
        if ($this->current_page > 1) {
            $firstPageUrl = $this->subPage_link . '1';
            $prewPageUrl = $this->subPage_link . ($this->current_page - 1);
			if ($this->pageNums > $this->sub_pages && $this->current_page > ceil($this->sub_pages/2)) {
				$qslh = '...';
			}
            $subPageCss1Str .= "[<a href='{$firstPageUrl}'>首页</a>] ";
            $subPageCss1Str .= "[<a href='{$prewPageUrl}'>上页</a>] ".$qslh;
        } else {
            $subPageCss1Str .= '[首页] ';
            $subPageCss1Str .= '[上页] ';
        }
        $a = $this->construct_num_Page();
        for ($i = 0; $i < count($a); $i++) {
            $s = $a[$i];
            if ($s == $this->current_page) {
                $subPageCss1Str .= '[<span style=\'color:red;font-weight:bold;\'>' . $s . '</span>]';
            } else {
                $url = $this->subPage_link . $s;
                $subPageCss1Str .= "[<a href='{$url}'>" . $s . '</a>]';
            }
        }
        if ($this->current_page < $this->pageNums) {
            $lastPageUrl = $this->subPage_link . $this->pageNums;
            $nextPageUrl = $this->subPage_link . ($this->current_page + 1);
			if ($this->pageNums > $this->sub_pages && ($this->current_page <= ceil($this->sub_pages/2) || $this->current_page <= ($this->pageNums - $this->sub_pages) + 1)) {
				$hslh = '...';
			}
            $subPageCss1Str .= $hslh." [<a href='{$nextPageUrl}'>下页</a>]";
            $subPageCss1Str .= " [<a href='{$lastPageUrl}'>尾页</a>]";
        } else {
            $subPageCss1Str .= ' [下页]';
            $subPageCss1Str .= ' [尾页]';
        }
        $this->jieguo = $subPageCss1Str;
    }
    /* 
    构造经典模式的分页 
    [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页] 
    */
    public function subPageCss2()
    {
        global $wzfileext;
		$subPageCss2Str = '<div class="niuxcms_fenye">';
        if ($this->current_page > 1) {
            $firstPageUrl = $this->subPage_link . '.' . $wzfileext;
            $prewPageUrl = $this->subPage_link . (($this->current_page==2)?'':'_'.($this->current_page-1)) . '.' . $wzfileext;
			if ($this->pageNums > $this->sub_pages && $this->current_page > ceil($this->sub_pages/2)) {
				$qslh = '...';
			}
            $subPageCss2Str .= '<a class="niuxcms_begin_page" href="'.$firstPageUrl.'">首页</a>';
            $subPageCss2Str .= '<a class="niuxcms_prepage" href="'.$prewPageUrl.'">上页</a>'.$qslh;
        } else {
            $subPageCss2Str .= '<span class="niuxcms_begin_page">首页</span>';
            $subPageCss2Str .= '<span class="niuxcms_prepage">上页</span>';
        }
        $a = $this->construct_num_Page();
        for ($i = 0; $i < count($a); $i++) {
            $s = $a[$i];
            if ($s == $this->current_page) {
                $subPageCss2Str .= '<span class="niuxcms_num niuxcms_current_page">' . $s . '</span>';
            } else {
                $url = $this->subPage_link . ($s==1?'':'_'.$s) . '.' . $wzfileext;
                $subPageCss2Str .= '<a class="niuxcms_num niuxcms_page" href="'.$url.'">' . $s . '</a>';
            }
        }
        if ($this->current_page < $this->pageNums) {
            $lastPageUrl = $this->subPage_link . '_' . $this->pageNums . '.' . $wzfileext;
            $nextPageUrl = $this->subPage_link . '_' . ($this->current_page + 1) . '.' . $wzfileext;
			if ($this->pageNums > $this->sub_pages && ($this->current_page <= ceil($this->sub_pages/2) || $this->current_page <= ($this->pageNums - $this->sub_pages) + 1)) {
				$hslh = '...';
			}
            $subPageCss2Str .= $hslh.'<a class="niuxcms_nextpage" href="'.$nextPageUrl.'">下页</a>';
            $subPageCss2Str .= '<a class="niuxcms_end_page" href="'.$lastPageUrl.'">尾页</a>';
        } else {
            $subPageCss2Str .= '<span class="niuxcms_nextpage">下页</span>';
            $subPageCss2Str .= '<span class="niuxcms_end_page">尾页</span>';
        }
		$subPageCss2Str .= '</div>';
        $this->jieguo = $subPageCss2Str;
    }
    /* 
    构造经典模式的分页 
    [首页] [上页] 10 9 8 7 6 5 4 3 2 1 [下页] [尾页] 
    */
    public function subPageCss3()
    {
        global $wzfileext;
		$subPageCss3Str = '<div class="niuxcms_fenye">';
        if ($this->current_page < $this->pageNums) {
            $lastPageUrl = $this->subPage_link . 'index' . '.' . $wzfileext;
            $nextPageUrl = $this->subPage_link .($this->current_page+1==$this->pageNums?'index':'list.'.($this->current_page + 1)). '.' . $wzfileext;
			if ($this->pageNums > $this->sub_pages && $this->current_page < $this->pageNums) {
				$hslh = '...';
			}
            $subPageCss3Str .= '<a class="niuxcms_end_page" href="'.$lastPageUrl.'">首页</a>';
            $subPageCss3Str .= '<a class="niuxcms_nextpage" href="'.$nextPageUrl.'">上页</a>'.$hslh;
        } else {
            $subPageCss3Str .= '<span class="niuxcms_end_page">首页</span>';
            $subPageCss3Str .= '<span class="niuxcms_nextpage">上页</span>';
        }
        $a = $this->construct_num_Page1();
		rsort($a);
        for ($i = 0; $i < count($a); $i++) {
            $s = $a[$i];
            if ($s == $this->current_page) {
                $subPageCss3Str .= '<span class="niuxcms_num niuxcms_current_page">' . $s . '</span>';
            } else {
                $url = $this->subPage_link . ($s==$this->pageNums?'index':'list.'.$s) . '.' . $wzfileext;
                $subPageCss3Str .= '<a class="niuxcms_num niuxcms_page" href="'.$url.'">' . $s . '</a>';
            }
        }
        if ($this->current_page > 1) {
            $firstPageUrl = $this->subPage_link . 'list.1.' . $wzfileext;
            $prewPageUrl = $this->subPage_link . 'list.'.($this->current_page-1) . '.' . $wzfileext;
			if ($this->current_page > $this->sub_pages) {
				$qslh = '...';
			}
            $subPageCss3Str .= $qslh.'<a class="niuxcms_prepage" href="'.$prewPageUrl.'">下页</a>';
            $subPageCss3Str .= '<a class="niuxcms_begin_page" href="'.$firstPageUrl.'">尾页</a>';
        } else {
            $subPageCss3Str .= '<span class="niuxcms_prepage">下页</span>';
            $subPageCss3Str .= '<span class="niuxcms_begin_page">尾页</span>';
        }
		$subPageCss3Str .= '</div>';
        $this->jieguo = $subPageCss3Str;
    }
    /* 
    构造经典模式的分页 
    [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页] 
    */
    public function subPageCss4()
    {
		$subPageCss4Str = '<div class="niuxcms_fenye">';
        if ($this->current_page > 1) {
            $firstPageUrl = $this->subPage_link . '1';
            $prewPageUrl = $this->subPage_link . ($this->current_page-1);
			if ($this->pageNums > $this->sub_pages && $this->current_page > ceil($this->sub_pages/2)) {
				$qslh = '...';
			}
            $subPageCss4Str .= '<a class="niuxcms_begin_page" href="'.$firstPageUrl.'">首页</a>';
            $subPageCss4Str .= '<a class="niuxcms_prepage" href="'.$prewPageUrl.'">上页</a>'.$qslh;
        } else {
            $subPageCss4Str .= '<span class="niuxcms_begin_page">首页</span>';
            $subPageCss4Str .= '<span class="niuxcms_prepage">上页</span>';
        }
        $a = $this->construct_num_Page();
        for ($i = 0; $i < count($a); $i++) {
            $s = $a[$i];
            if ($s == $this->current_page) {
                $subPageCss4Str .= '<span class="niuxcms_num niuxcms_current_page">' . $s . '</span>';
            } else {
                $url = $this->subPage_link . $s;
                $subPageCss4Str .= '<a class="niuxcms_num niuxcms_page" href="'.$url.'">' . $s . '</a>';
            }
        }
        if ($this->current_page < $this->pageNums) {
            $lastPageUrl = $this->subPage_link . $this->pageNums;
            $nextPageUrl = $this->subPage_link . ($this->current_page + 1);
			if ($this->pageNums > $this->sub_pages && ($this->current_page <= ceil($this->sub_pages/2) || $this->current_page <= ($this->pageNums - $this->sub_pages) + 1)) {
				$hslh = '...';
			}
            $subPageCss4Str .= $hslh.'<a class="niuxcms_nextpage" href="'.$nextPageUrl.'">下页</a>';
            $subPageCss4Str .= '<a class="niuxcms_end_page" href="'.$lastPageUrl.'">尾页</a>';
        } else {
            $subPageCss4Str .= '<span class="niuxcms_nextpage">下页</span>';
            $subPageCss4Str .= '<span class="niuxcms_end_page">尾页</span>';
        }
		$subPageCss4Str .= '</div>';
        $this->jieguo = $subPageCss4Str;
    }
}