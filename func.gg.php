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
function cltojs( $ontid, $wllx, $clqz, $xzgg, $lhcl, $lhjg, $sjeorne, $sjsz, $xzmrcs, $mrcs, $xzfkcs, $fkcs, $oseorne, $os, $fbleorne, $fbl, $llqeorne, $llq, $yuyeorne, $yuy, $lyeorne, $vly, $urleorne, $url, $diyueorne, $diyu, $jreorne, $jr ) {
	$js = 'var wllx='.$wllx.',clqz='.$clqz.',ifout=1,clout="",atyh=0;'."\r\n";
	/////////////////////
	if( $sjsz ){
		$sjeornejsq = $sjeorne ? '(!' : '';
		$sjeornejsh = $sjeorne ? ')' : '';
		$sjszjs = 'var NowDate = new Date();';
		$sjj = 6;
		$sjdjdarr = array('','','','','');
		$arraysj = explode('. ', $sjsz);
		$size = count( $arraysj ) - 1;
		for ($i=0; $i<$size; $i++){
			$sjd = $arraysj[$i];
			if( $sjd ){
				$arraysjjb = explode(', ', $sjd);
				$arraysjqs = explode('-', $arraysjjb[1]);
				if((int)$arraysjqs[0] > (int)$arraysjqs[1]){ $ls = $arraysjqs[0]; $arraysjqs[0] = $arraysjqs[1]; $arraysjqs[1] = $ls; }
				switch ( $arraysjjb[0] ){
					case 'nianfen':
					$bjsj = 'NowDate.getFullYear()'; $dqjb = 5;
					break;
					case 'yuefen':
					$bjsj = '(NowDate.getMonth()+1)'; $dqjb = 4;
					break;
					case 'riqi':
					$bjsj = 'NowDate.getDate()'; $dqjb = 3;
					break;
					case 'xingqi':
					$bjsj = '(NowDate.getDay()?NowDate.getDay():7)'; $dqjb = 2;
					break;
					case 'xiaoshi':
					$bjsj = 'NowDate.getHours()'; $dqjb = 1;
					break;
					default:
				}
				$d = '('.$bjsj.'>='.$arraysjqs[0].' && '.$bjsj.'<='.$arraysjqs[1].')';
				$sjdjdarr[$dqjb-1] = $d.' && ';
				if( $i == 0 ){
					$sjoutq = 'if'.$sjeornejsq.'('.$d;
				} else {
					if( $dqjb < $sjj ){
						$sjoutq = $sjoutq.' && '.$d;
					} else {
						$sjgao = '';
						for ($j=5; $j>$dqjb; $j--){ $sjgao = $sjgao.$sjdjdarr[$j-1]; }
						$sjoutq = $sjoutq.')'.$sjeornejsh.'{}else if'.$sjeornejsq.'('.$sjgao.$d;
					}
				}
				$sjj = $dqjb;
			}
		}
		$js = $js.$sjszjs.$sjoutq.')'.$sjeornejsh.'{}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $os ){
		$oseornejsq = $oseorne ? '!(' : '';
		$oseornejsh = $oseorne ? ')' : '';
		$jsos = 'var ua=navigator.userAgent.toLowerCase(),sys="";if(ua.indexOf("nt 6.1")>-1){sys="Windows 7"}else if(ua.indexOf("nt 6.2")>-1){sys="Windows 8"}else if(ua.indexOf("nt 6.0")>-1){sys="Windows vista"}else if(ua.indexOf("nt 5.2")>-1){sys="Windows 2003"}else if(ua.indexOf("nt 5.1")>-1){sys="Windows xp"}else if(ua.indexOf("nt 5.0")>-1){sys="Windows 2000"}else if(ua.indexOf("nt 4.0")>-1){sys="Windows NT 4.0"}else if(ua.indexOf("nt")>-1){sys="Windows NT"}else if((ua.indexOf("win")>-1)&&(ua.indexOf("98")>-1)){sys="Windows 98"}else if((ua.indexOf("win")>-1)&&(ua.indexOf("95")>-1)){sys="Windows 95"}else if(ua.indexOf("android")>-1){sys="Android"}else if(ua.indexOf("iphone")>-1){sys="iphone"}else if(ua.indexOf("ipad")>-1){sys="ipad"}else if(ua.indexOf("ipod")>-1){sys="ipod"}else if(ua.indexOf("ios")>-1){sys="iOS"}else if(ua.indexOf("macintosh")!=-1||ua.indexOf("mac os x")!=-1){sys="Macintosh"}else if(ua.indexOf("linux")>-1){sys="Linux"}else{sys="other"}if(';
		$arrayos = explode(', ', $os);
		$size = count( $arrayos );
		for ($i=0; $i<$size; $i++){
			if( $arrayos[$i] ){
				if( $i == 0 ){
					$jsos = $jsos.$oseornejsq.'sys=="'.$arrayos[$i].'"';
				} else {
					$jsos = $jsos.' || '.'sys=="'.$arrayos[$i].'"';
				}
			}
		}
		$js=$js.$jsos.$oseornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $fbl ){
		$fbleornejsq = $fbleorne ? '!(' : '';
		$fbleornejsh = $fbleorne ? ')' : '';
		$jsfbl = 'var fbl=screen.width+"*"+screen.height;if(';
		$arrayfbl = explode(', ', $fbl);
		$size = count( $arrayfbl );
		for ($i=0; $i<$size; $i++){
			if( $arrayfbl[$i] ){
				if( $i == 0 ){
					$jsfbl = $jsfbl.$fbleornejsq.'fbl=="'.$arrayfbl[$i].'"';
				} else {
					$jsfbl = $jsfbl.' || '.'fbl=="'.$arrayfbl[$i].'"';
				}
			}
		}
		$js = $js.$jsfbl.$fbleornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $llq ){
		$llqeornejsq = $llqeorne ? '!(' : '';
		$llqeornejsh = $llqeorne ? ')' : '';
		$jsllq = 'var ua=navigator.userAgent.toLowerCase(),llq="";if(ua.indexOf("msie 9")>-1){llq="Internet Explorer 9"}else if(ua.indexOf("msie 10")>-1){llq="Internet Explorer 10"}else if(ua.indexOf("msie 8")>-1){llq="Internet Explorer 8"}else if(ua.indexOf("msie 7")>-1){llq="Internet Explorer 7"}else if(ua.indexOf("msie 6")>-1){llq="Internet Explorer 6"}else if(ua.indexOf("msie 5")>-1){llq="Internet Explorer 5"}else if(ua.indexOf("chrome")>-1){llq="Chrome"}else if(ua.indexOf("firefox")>-1){llq="Firefox"}else if(ua.indexOf("opera")>-1){llq="Opera"}else if(ua.indexOf("safari")>-1){llq="Safari"}else if(ua.indexOf("mozilla")>-1){llq="Mozilla"}else{llq="other"}if(';
		$arrayllq = explode(', ', $llq);
		$size = count( $arrayllq );
		for ($i=0; $i<$size; $i++){
			if( $arrayllq[$i] ){
				if( $i == 0 ){
					$jsllq = $jsllq.$llqeornejsq.'llq=="'.$arrayllq[$i].'"';
				} else {
					$jsllq = $jsllq.' || '.'llq=="'.$arrayllq[$i].'"';
				}
			}
		}
		$js = $js.$jsllq.$llqeornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $yuy ){
		$yuyeornejsq = $yuyeorne ? '!(' : '';
		$yuyeornejsh = $yuyeorne ? ')' : '';
		$jsyuy = 'var lang=(navigator.language || navigator.browserLanguage || "other").toLowerCase();if(';
		$arrayyuy = explode(', ', $yuy);
		$size = count( $arrayyuy );
		for ($i=0; $i<$size; $i++){
			if( $arrayyuy[$i] ){
				if( $i == 0 ){
					$jsyuy = $jsyuy.$yuyeornejsq.'lang=="'.$arrayyuy[$i].'"';
				} else {
					$jsyuy = $jsyuy.' || '.'lang=="'.$arrayyuy[$i].'"';
				}
			}
		}
		$js = $js.$jsyuy.$yuyeornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $vly ){
		$vlyeornejsq = $lyeorne ? '!(' : '';
		$vlyeornejsh = $lyeorne ? ')' : '';
		$jsvly = 'var vly=document.referrer?document.referrer:"direct";if(';
		$arrayvly = explode("\n", strtr(unescape($vly), '"', "'"));
		$size = count( $arrayvly );
		$k = 0;
		for ($i=0; $i<$size; $i++){
			if( $arrayvly[$i] ){
				$arrayvly[$i] = strtr($arrayvly[$i], "\r", '');
				if( $k == 0 ){
					$jsvly = $jsvly.$vlyeornejsq.'vly.indexOf("'.$arrayvly[$i].'")>-1';
				} else {
					$jsvly = $jsvly.' || '.'vly.indexOf("'.$arrayvly[$i].'")>-1';
				}
				$k++;
			}
		}
		$js = $js.$jsvly.$vlyeornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $url ){
		$urleornejsq = $urleorne ? '!(' : '';
		$urleornejsh = $urleorne ? ')' : '';
		$jsurl = 'var vurl=document.URL?document.URL:location.href;if(';
		$arrayurl = explode("\n", strtr(unescape($url), '"', "'"));
		$size = count($arrayurl);
		$k = 0;
		for ($i=0; $i<$size; $i++){
			if( $arrayurl[$i] ){
				$arrayurl[$i] = strtr($arrayurl[$i], "\r", '');
				if( $k == 0 ){
					$jsurl = $jsurl.$urleornejsq.'vurl.indexOf("'.$arrayurl[$i].'")>-1';
				} else {
					$jsurl = $jsurl.' || '.'vurl.indexOf("'.$arrayurl[$i].'")>-1';
				}
				$k++;
			}
		}
		$js = $js.$jsurl.$urleornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $diyu ){
		global $amsurl;
		global $iplookup;
		$diyueornejsq = $diyueorne ? '!(' : '';
		$diyueornejsh = $diyueorne ? ')' : '';
		$jsdiyu = 'var xmlHttp=null;try{xmlHttp=new XMLHttpRequest()}catch(e){try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")}};xmlHttp.open("GET","'.$amsurl.'agent.php",false);xmlHttp.send();diyu=xmlHttp.responseText;if(';
		$arraydiyu = explode("\n", strtr(unescape($diyu), '"', "'"));
		$size = count( $arraydiyu );
		$k = 0;
		for ($i=0; $i<$size; $i++){
			if( $arraydiyu[$i] ){
				$arraydiyu[$i] = strtr($arraydiyu[$i], "\r", '');
				if( $k == 0 ){
					$jsdiyu = $jsdiyu.$diyueornejsq.'diyu.indexOf("'.$arraydiyu[$i].'")>-1';
				} else {
					$jsdiyu = $jsdiyu.' || '.'diyu.indexOf("'.$arraydiyu[$i].'")>-1';
				}
			$k++;
			}
		}
		$js = $js.$jsdiyu.$diyueornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if( $jr ){
		global $amsurl;
		global $iplookup;
		$jreornejsq = $jreorne ? '!(' : '';
		$jreornejsh = $jreorne ? ')' : '';
		$jsjr = 'var xmlHttp=null;try{xmlHttp=new XMLHttpRequest()}catch(e){try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")}};xmlHttp.open("GET","'.$amsurl.'agent.php",false);xmlHttp.send();jr=xmlHttp.responseText;if(';
		$arrayjr = explode(', ', $jr);
		$size = count( $arrayjr );
		for ($i=0; $i<$size; $i++){
			if( $arrayjr[$i] ){
				switch ( $arrayjr[$i] ){
					case 'dx':
					$arrayjr[$i] = '电信';
					break;
					case 'lt':
					$arrayjr[$i] = '联通';
					break;
					case 'jyw':
					$arrayjr[$i] = '教育网';
					break;
					case 'tt':
					$arrayjr[$i] = '铁通';
					break;
					case 'wt':
					$arrayjr[$i] = '网通';
					break;
					default:
					$arrayjr[$i] = '其他';
				}
				if( $i == 0 ){
					$jsjr = $jsjr.$jreornejsq.'jr.indexOf("'.$arrayjr[$i].'")>-1';
				} else {
					$jsjr = $jsjr.' || '.'jr.indexOf("'.$arrayjr[$i].'")>-1';
				}
			}
		}
		$js = $js.$jsjr.$jreornejsh.'){}else{ifout=0;}'."\r\n";
	}
	////////////////////
	if($xzmrcs && $mrcs){
		global $amsurl;
		$ggid = explode(', ', $xzgg);
		$jsmrcs = 'var xmlHttp=null;try{xmlHttp=new XMLHttpRequest()}catch(e){try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")}};xmlHttp.open("GET","'.$amsurl.'counter.php?ac=query&gid='.$ggid[0].'&sorc='.$xzmrcs.'",false);xmlHttp.send();mrcs=xmlHttp.responseText;if(mrcs>='.$mrcs.'){ifout=0;}'."\r\n";
		$js = $js.$jsmrcs;
	}
	////////////////////
	if($xzfkcs && $fkcs){
		switch ( $xzfkcs ){
			case 1:
			$xztime = 24*60*60;
			break;
			case 2:
			$xztime = 60*60;
			break;
			case 3:
			$xztime = 30*60;
			break;
			case 4:
			$xztime = 10*60;
			break;
			case 5:
			$xztime = 60;
			break;
		}
		$jsfkcs='if((wllx==2 && ifout)||(wllx==1 && ifout && clqz<qz)){var a="'.$ontid.'",b='.$xztime.',c=0;if(document.cookie.length>0){var c_start=document.cookie.indexOf(a+"=");if(c_start!=-1){c_start=c_start+a.length+1;var c_end=document.cookie.indexOf(";",c_start);if(c_end==-1){c_end=document.cookie.length}c=unescape(document.cookie.substring(c_start,c_end))}};if(parseInt(c)>='.$fkcs.'){ifout=0;}else{var d=new Date;d.setSeconds(d.getSeconds()+b);document.cookie=a+"="+escape(parseInt(c)+1)+";expires="+d.toGMTString()+";path=/";}}'."\r\n";
		$js = $js.$jsfkcs;
	}
	////////////////////
	if( $xzgg ){
		global $amsurl;
		global $datadir;
		global $thread;
		$arraygg = explode('. ', $xzgg);
		$size = count( $arraygg );
		for ($i=0; $i<$size; $i++){
			if( $arraygg[$i] ){
				$arraygid = explode(', ', $arraygg[$i]);
				if( $wllx == 2 ){
					$jsgg = $jsgg.'\'+amsurl+datadir+\''.$arraygid[0].'.js"></script>';
				} else {
					if( $size < 3 ){
						$jsgg = '\'+amsurl+datadir+\''.$arraygid[0].'.js"></script>';
					} else {
						switch( $lhcl ){
							case 1:
							if( $i == 0 ){
								$ggcl = 'var sjs=Math.floor(Math.random()*'.($size-1).');if(sjs=='.$i.'){clout=amsurl+datadir+\''.$arraygid[0].'.js"></script>\';}';
							} else {
								$ggcl = $ggcl.'else if(sjs=='.$i.'){clout=amsurl+datadir+\''.$arraygid[0].'.js"></script>\';}';
							}
							break;
							case 2:
							$ggbl = $ggbl + $arraygid[1];
							$ggk = 'var sjs=Math.ceil(Math.random()*'.$ggbl.');';
							if( $i == 0 ){
								$ggcl = 'if(sjs<='.$ggbl.'){clout=amsurl+datadir+\''.$arraygid[0].'.js"></script>\';}';
							} else {
								$ggcl = $ggcl.'else if(sjs<='.$ggbl.'){clout=amsurl+datadir+\''.$arraygid[0].'.js"></script>\';}';
							}
							break;
							case 3:
							if( $i == 0 ){
								$ggk = "clout='<iframe class=\"".$ontid."\" name=\"".$ontid."\" frameborder=\"0\" scrolling=\"no\" height=\"100%\" width=\"100%\" src=\"'+amsdir+'thread.htm?gid=".$arraygid[0]."&ggwid='+ggwid+'&atyh='+atyh+'\"></iframe><script charset=\"utf-8\" language=\"JavaScript\" type=\"text/javascript\">(function(){var myggs=[];myggs[".$i."]=\"".$arraygid[0]."\";";
								$ggcl = "var iii=0,atyh=0,dir=amsdir,ggwID=ggwid,int=window.setInterval(function(){if(iii<myggs.length-1){iii=iii+1;}else{iii=0;};var iframes=document.getElementsByTagName(\"iframe\");for(var ii=0;ii<iframes.length;ii++){if(iframes[ii].className==\"".$ontid."\"){iframes[ii].src=dir+\"thread.htm?gid=\"+myggs[iii]+\"&ggwid=\"+ggwID+\"&atyh=\"+atyh+\"&sid=\"+Math.random();}}},".$lhjg."000);})();</script>'";
							} else {
								$ggk = $ggk.'myggs['.$i.']="'.$arraygid[0].'";';
							}
							break;
						}
					}
				}
			}
		}
		$js = $js."if(ifout){clout='".$jsgg."';if(clout){}else{".$ggk.$ggcl."}}"."\r\n";
	}
	////////////////////
	$js = $js."if(clout){if(wllx==2){opfz=opfz+clout;}else{if(!opz){opz=clout;qz=clqz;}else{if(clqz<qz){opz=clout;qz=clqz;}}}}";
	return $js;
}
/////////////////////
function ggwtojs( $gid, $xzggcl, $ggwwidth, $ggwheight, $bjgg, $ggwclass ){
	global $amsurl;
	global $datadir;
	$js = "var opz=\"\",opfz=\"\",qz=11,ggwid=\"{$gid}\",atyh=0,amsdir=\"{$amsurl}\",datadir=\"{$datadir}/\",amsurl='<script charset=\"utf-8\" language=\"JavaScript\" type=\"text/javascript\" src=\"'+amsdir;\r\n";
	$ggwwidthjs = is_numeric( $ggwwidth ) ? 'fdiv.style.width="'.$ggwwidth.'px";' : '';
	$ggwheightjs = is_numeric( $ggwheight ) ? 'fdiv.style.height="'.$ggwheight.'px";':'';
	if((is_numeric($ggwwidth) || is_numeric($ggwheight)) && $ggwclass == '1'){
		$js = $js.'var fdiv=document.scripts[document.scripts.length-1].parentNode;if(fdiv.className.indexOf(ggwid)>-1){'.$ggwwidthjs.''.$ggwheightjs.'fdiv.style.overflow="hidden";}'."\r\n";
	}
	$arrayggcl = explode('. ', $xzggcl);
	$size = count( $arrayggcl ) - 1;
	for ($i=0; $i<$size; $i++){
		if( $arrayggcl[$i] ){
			$ggcljs = insou1(file_get_contents($datadir.'/'.$arrayggcl[$i].'.js'));
			$js = $js.'/*begin '.$arrayggcl[$i].'*/'."\r\n".$ggcljs."\r\n".'/*end '.$arrayggcl[$i].'*/'."\r\n";
		}
	}
	$js = $js.'/*end ggcl*//*begin bjgg*/'."\r\n";
	if( $bjgg && $ggwclass == '1' ){
		$bjggjs = insou1(file_get_contents($datadir.'/'.$bjgg.'.js'));
		$js = $js.'if(!opz){'."\r\n".'/*begin '.$bjgg.'*/'."\r\n".$bjggjs."\r\n".'/*end '.$bjgg.'*/'."\r\n".'}document.write(opz+opfz);';
	} elseif ( $bjgg && $ggwclass == '2' ){
		$bjggjs = insou1(file_get_contents($datadir.'/'.$bjgg.'.js'));
		$js = $js.'if(!opfz){'."\r\n".'/*begin '.$bjgg.'*/'."\r\n".$bjggjs."\r\n".'/*end '.$bjgg.'*/'."\r\n".'}document.write(opz+opfz);';
	} else {
		$js = $js.'document.write(opz+opfz);';
	}
	return $js;
}