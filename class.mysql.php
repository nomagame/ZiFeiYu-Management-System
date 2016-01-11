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
class mysql{
	private $host = 'localhost';			//服务器地址
	private $name = 'root';					//登录账号
	private $pwd = 'root';					//登录密码
	private $dBase = 'niuxams';	    		//数据库名称
	private $Pre = '';			    		//表前缀
	private $charset = 'utf8';	        	//数据库字符集
	private $conn = '';						//数据库链接资源
	private $result = '';					//结果集
	private $msg = '';						//返回结果
	private $fields;						//返回字段
	private $fieldsNum = 0;					//返回字段数
	private $rowsNum = 0;					//返回结果数
	private $oneRow = '';					//返回单条记录
	private $rowsArray = array();			//返回结果数组
	//初始化类
	function __construct(){
		global $SqlServer,$SqlUserName,$SqlPassword,$SqlDataBase,$Pre;
		if($SqlServer)
			$this->host = $SqlServer;
		if($SqlUserName)
			$this->name = $SqlUserName;
		if($SqlPassword)
			$this->pwd = $SqlPassword;
		if($SqlDataBase)
			$this->dBase = $SqlDataBase;
		if($Pre)
			$this->Pre = $Pre;
		$this->init_conn();
	}
	//链接数据库
	function init_conn(){
		$this->conn = @mysql_connect($this->host, $this->name, $this->pwd);
		@mysql_select_db($this->dBase, $this->conn);
		mysql_query("set names ".$this->charset);
	}
	//查询结果
	function query($sql){
		if($this->conn == ''){
			$this->init_conn();
		}
		$this->result = @mysql_query($sql, $this->conn);
		return $this->result;
	}
	//取得字段数 
	function getFieldsNum($sql){
		$this->query($sql);
		if(mysql_errno() == 0){
			$this->fieldsNum = @mysql_num_fields($this->result);
			return $this->fieldsNum;
		}else{
			return '';
		}
	}
	//取得查询结果数
	function getRowsNum($sql){
		$this->query($sql);
		if(mysql_errno() == 0){
			$this->rowsNum = @mysql_num_rows($this->result);
			return $this->rowsNum;
		}else{
			return '';
		}
	}
	//取得select记录（单条记录）
	function getOneRow($sql){
		$this->query($sql);
		if(mysql_errno() == 0){
			$this->oneRow = mysql_fetch_array($this->result,MYSQL_ASSOC);
			return $this->oneRow;
		}else{
			return '';
		}
	}
	//取得select记录数组（多条记录）
	function getRowsArray($sql){
		$this->query($sql);
		if(mysql_errno() == 0){
			while($row = mysql_fetch_array($this->result,MYSQL_ASSOC)) {
				$this->rowsArray[] = $row;
			}
			return $this->rowsArray;
		}else{
			return '';
		}
	}
	//取得更新、删除、添加记录数
	function uidRst($sql){
		$this->query($sql);
		$this->rowsNum = @mysql_affected_rows();
		if(mysql_errno() == 0){
			return $this->rowsNum;
		}else{
			return '';
		}
	}
	//获取对应的字段值
	function getFieldsVal($sql,$fields){
		$this->query($sql);
		if(mysql_errno() == 0){
			if(mysql_num_rows($this->result) > 0){
				$tmpfld = @mysql_fetch_array($this->result);
				$this->fields = $tmpfld[$fields];
			}
			return $this->fields;
		}else{
			return '';
		}
	}
	//错误信息
	function msg_error(){
		if(mysql_errno() != 0) {
			$this->msg = mysql_error();
		}
		return $this->msg;
	}
	//释放结果集
	function close_rst(){
		mysql_free_result($this->result);
		$this->msg = '';
		$this->fieldsNum = 0;
		$this->fields ='';
		$this->rowsNum = 0;
		$this->oneRow = '';
		$this->rowsArray = '';
	}
	//关闭数据库
	function close_conn(){
		$this->close_rst();
		mysql_close($this->conn);
		$this->conn = '';
	}
	//-----扩展功能函数开始-----//
	
	//插入操作记录
	function inoplog($caozuo, $caozuofile, $state, $user){
		$caozuo = insql2(substr($caozuo,0,200));
		$caozuofile = insql2(substr($caozuofile,0,200));
		$user = $user ? $user : '未知';
		$user = htmlspecialchars(insql2(substr($user,0,200)));
		$time = gnt();
		$gethost = insql2(substr(gethost(),0,20));
		$getlang = insql2(substr(getlang(),0,12));
		$getip = insql2(substr(getip(),0,15));
		$getport = insql2(substr(getport(),0,5));
		$getos = insql2(substr(getos(),0,20));
		$getb = getb();
		$getbn = insql2(substr($getb[0],0,20));
		$bversion = insql2(substr($getb[1],0,12));
		$agent = insql2(substr($_SERVER['HTTP_USER_AGENT'],0,255));
		$referer = insql2(substr(getreferer(),0,255));
		$sql = "INSERT INTO {$this->Pre}niux_ams_oplog (username,caozuo,state,caozuofile,time,ip,port,os,browse,version,host,lang,referer,agent) VALUES ('$user','$caozuo','$state','$caozuofile','$time','$getip','$getport','$getos','$getbn','$bversion','$gethost','$getlang','$referer','$agent')";
		$this->uidRst($sql) or exit(mysql_error());
	}
}