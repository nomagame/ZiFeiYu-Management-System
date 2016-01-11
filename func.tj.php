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
function tj(){
	global $statistics,$Pre;
	$myDate1 = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m",time()), date("d",time()), date("Y",time())));
	$myDate2 = date("Y-m-d H:i:s", mktime(0, 5, 0, date("m",time()), date("d",time()), date("Y",time())));
	$nowtime = gnt();
	if(($nowtime>$myDate1 && $nowtime<$myDate2) || $statistics=='statistics'){//
		$conn = new mysql();
		$zuotime = date("Y-m-d", mktime(0, 0, 0, date("m",time()), date("d",time())-1, date("Y",time())));
		$today = date("Y-m-d", time());
		$sql = "SELECT id FROM ${Pre}niux_ams_statistics_01 WHERE DATE(time)='$zuotime'";
		$result = mysql_query($sql,$conn);
		if( $conn->getRowsNum($sql) == 0 ){//
			$sql = "SELECT DISTINCT DATE(time) FROM ${Pre}niux_ams_counter";
			$result = $conn->query($sql);
			while( $row = mysql_fetch_array($result) ){
				if( $row['DATE(time)'] != $today ){
					$datarow = $row['DATE(time)'];
					for ($hi=0; $hi<=23; $hi++){
						
						$sql1 = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfV,COUNT(DISTINCT ip) AS NumberOfIp FROM ${Pre}niux_ams_counter WHERE DATE(time)='$datarow' and EXTRACT(HOUR FROM time)=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						$NumberOfV = $row1['NumberOfV'];
						$NumberOfIp = $row1['NumberOfIp'];
						
						$sql1 = "SELECT COUNT(*) AS NumberOfS,COUNT(DISTINCT time) AS NumberOfPv FROM ${Pre}niux_ams_counter WHERE ac=1 and DATE(time)='$datarow' and EXTRACT(HOUR FROM time)=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						$NumberOfS = $row1['NumberOfS'];
						$NumberOfPv = $row1['NumberOfPv'];
						
						$sql1 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfC FROM ${Pre}niux_ams_counter WHERE ac=2 and DATE(time)='$datarow' and EXTRACT(HOUR FROM time)=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						$NumberOfC = $row1['NumberOfC'];
						
						$sql1 = "SELECT COUNT(*) AS NumberOfSny FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=0 and DATE(time)='$datarow' and EXTRACT(HOUR FROM time)=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						$NumberOfSny = $row1['NumberOfSny'];
						
						$sql1 = "SELECT COUNT(*) AS NumberOfSy FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=1 and DATE(time)='$datarow' and EXTRACT(HOUR FROM time)=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						$NumberOfSy = $row1['NumberOfSy'];
						
						$sql1 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCny FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=0 and DATE(time)='$datarow' and EXTRACT(HOUR FROM time)=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						$NumberOfCny = $row1['NumberOfCny'];
						
						$sql1 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCy FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=1 and DATE(time)='$datarow' and EXTRACT(HOUR FROM time)=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						$NumberOfCy = $row1['NumberOfCy'];
						///////////////////////
						$sql1 = "SELECT COUNT(*) AS NumberOfRow FROM ${Pre}niux_ams_statistics_01 WHERE DATE(time)='$datarow' AND hour=$hi";
						$result1 = $conn->query($sql1);
						$row1 = mysql_fetch_array($result1);
						if( $row1['NumberOfRow'] == 0 ){
							$sql1 = "INSERT INTO ${Pre}niux_ams_statistics_01 (time,hour,num01,num02,num03,num04,num05,num06,num07,num08,num09) VALUES ('$datarow','$hi','$NumberOfV','$NumberOfS','$NumberOfC','$NumberOfSny','$NumberOfSy','$NumberOfCny','$NumberOfCy','$NumberOfIp','$NumberOfPv')";
							$conn->query($sql1);
						}
					}
					////////////////////////
					$sql1 = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfV,COUNT(DISTINCT ip) AS NumberOfIp FROM ${Pre}niux_ams_counter WHERE DATE(time)='$datarow'";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					$NumberOfV = $row1['NumberOfV'];
					$NumberOfIp = $row1['NumberOfIp'];
					$sql1 = "SELECT COUNT(*) AS NumberOfS,COUNT(DISTINCT time) AS NumberOfPv FROM ${Pre}niux_ams_counter WHERE ac=1 and DATE(time)='$datarow'";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					$NumberOfS = $row1['NumberOfS'];
					$NumberOfPv = $row1['NumberOfPv'];
					$sql1 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfC FROM ${Pre}niux_ams_counter WHERE ac=2 and DATE(time)='$datarow'";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					$NumberOfC = $row1['NumberOfC'];
					$sql1 = "SELECT COUNT(*) AS NumberOfSny FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=0 and DATE(time)='$datarow'";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					$NumberOfSny = $row1['NumberOfSny'];
					$sql1 = "SELECT COUNT(*) AS NumberOfSy FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=1 and DATE(time)='$datarow'";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					$NumberOfSy = $row1['NumberOfSy'];
					$sql1 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCny FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=0 and DATE(time)='$datarow'";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					$NumberOfCny = $row1['NumberOfCny'];
					$sql1 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCy FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=1 and DATE(time)='$datarow'";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					$NumberOfCy = $row1['NumberOfCy'];
					///////////////////////
					$sql1 = "SELECT COUNT(*) AS NumberOfRow FROM ${Pre}niux_ams_statistics_01 WHERE DATE(time)='$datarow' AND hour = 24";
					$result1 = $conn->query($sql1);
					$row1 = mysql_fetch_array($result1);
					if( $row1['NumberOfRow'] == 0 ){
						$sql1 = "INSERT INTO ${Pre}niux_ams_statistics_01 (time,hour,num01,num02,num03,num04,num05,num06,num07,num08,num09) VALUES ('$datarow',24,'$NumberOfV','$NumberOfS','$NumberOfC','$NumberOfSny','$NumberOfSy','$NumberOfCny','$NumberOfCy','$NumberOfIp','$NumberOfPv')";
						$conn->query($sql1);
					}
					///////////////////////
					$sql3 = "SELECT DISTINCT gid FROM ${Pre}niux_ams_counter WHERE DATE(time)='$datarow'";
					$result3 = $conn->query($sql3);
					while( $row3 = mysql_fetch_array($result3) ){
						$gidrow = $row3['gid'];
						$sql33 = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfVv FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfVv = $row33['NumberOfVv'];
						$sql33 = "SELECT COUNT(*) AS NumberOfS FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=1 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfS = $row33['NumberOfS'];
						$sql33 = "SELECT COUNT(*) AS NumberOfSny FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=1 AND atyh=0 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfSny = $row33['NumberOfSny'];
						$sql33 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfC FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=2 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfC = $row33['NumberOfC'];
						$sql33 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCny FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=2 AND atyh=0 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfCny = $row33['NumberOfCny'];
						$sql33 = "SELECT COUNT(*) AS NumberOfRow FROM ${Pre}niux_ams_statistics_02 WHERE gid='$gidrow' AND　date='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						if( $row33['NumberOfRow'] == 0 ){
							$sql33 = "INSERT INTO ${Pre}niux_ams_statistics_02 (gid,date,num01,num02,num03,num04,num05,num06) VALUES ('$gidrow','$datarow','$NumberOfV','$NumberOfVv','$NumberOfS','$NumberOfC','$NumberOfSny','$NumberOfCny')";
							$conn->query($sql33);
						}
					}
					///////////////////////
					$sql3 = "SELECT DISTINCT gwid FROM ${Pre}niux_ams_counter WHERE gid<>gwid AND DATE(time)='$datarow'";
					$result3 = $conn->query($sql3);
					while( $row3 = mysql_fetch_array($result3) ){
						$gidrow = $row3['gwid'];
						$sql33 = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfVv FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfVv = $row33['NumberOfVv'];
						$sql33 = "SELECT COUNT(*) AS NumberOfS FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=1 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfS = $row33['NumberOfS'];
						$sql33 = "SELECT COUNT(*) AS NumberOfSny FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=1 AND atyh=0 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfSny = $row33['NumberOfSny'];
						$sql33 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfC FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=2 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfC = $row33['NumberOfC'];
						$sql33 = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCny FROM ${Pre}niux_ams_counter WHERE (gid='$gidrow' OR gwid='$gidrow') AND ac=2 AND atyh=0 AND DATE(time)='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						$NumberOfCny = $row33['NumberOfCny'];
						$sql33 = "SELECT COUNT(*) AS NumberOfRow FROM ${Pre}niux_ams_statistics_02 WHERE gid='$gidrow' AND　date='$datarow'";
						$result33 = $conn->query($sql33);
						$row33 = mysql_fetch_array($result33);
						if( $row33['NumberOfRow'] == 0 ){
							$sql33 = "INSERT INTO ${Pre}niux_ams_statistics_02 (gid,date,num01,num02,num03,num04,num05,num06) VALUES ('$gidrow','$datarow','$NumberOfV','$NumberOfVv','$NumberOfS','$NumberOfC','$NumberOfSny','$NumberOfCny')";
							$conn->query($sql33);
						}
					}
					///////////////////////
				}
			}
			if($nowtime>$myDate1 && $nowtime<$myDate2){
				$sql2 = "TRUNCATE TABLE ${Pre}niux_ams_counter";
				$conn->query($sql2);
			} else {
				$sql2 = "DELETE FROM ${Pre}niux_ams_counter WHERE DATE(time)<>'$today'";
				$conn->query($sql2);
			}
			//////////////////
		}
	}
}