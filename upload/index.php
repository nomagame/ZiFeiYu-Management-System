<?php require_once "phpuploader/include_phpuploader.php" ?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>子非鱼素材上传系统</title>
	<meta http-equiv="cleartype" content="on" />
	<meta name="viewport" content="width=device-width" />

	<link rel="stylesheet" type="text/css" href="css/page.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="themes/light/light.css" />
	<link href="base.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="template-outside">

    <!-- To copy the form HTML, start here -->
    <div class="quform-outer quform-theme-light-light">
        <form class="quform" action="success.php" method="post" enctype="multipart/form-data" onclick="">

            <div class="quform-inner">
                <h3 class="quform-title">子非鱼素材上传系统</h3>
                <p class="quform-description">Zifeiyu File Upload System.</p>

                <div class="quform-elements">

                    <!-- Begin 2 column Group -->
                    <div class="quform-group-wrap quform-group-style-plain quform-group-alignment-left">
                        <div class="quform-group-elements">

                            <div class="quform-group-row quform-group-row-2cols">

                                <!-- Begin Text input element -->
                                <div class="quform-element quform-element-text">
                                    <div class="quform-spacer">
                                        <label for="name">姓名 <span class="quform-required">*</span></label>
                                        <div class="quform-input">
                                            <input id="name" type="text" name="name" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Text input element -->

                                <!-- Begin Text input element -->
                                <div class="quform-element quform-element-text">
                                    <div class="quform-spacer">
                                        <label for="email">电子邮箱 <span class="quform-required">*</span></label>
                                        <div class="quform-input">
                                            <input id="email" type="text" name="email" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Text input element -->

                            </div>

                        </div>
                    </div>
                    <!-- End 2 column Group -->

                    <!-- Begin Textarea element -->
                    <div class="quform-element quform-element-textarea quform-huge">
                        <div class="quform-spacer">
                            <label for="message">素材简介 <span class="quform-required">*</span></label>
                            <div class="quform-input">
                                <textarea id="message" name="message" style="height: 130px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End Textarea element -->

					<!-- Begin Upload element -->
                    <div class="demo">
                        <h2 align="center">请选择文件</h2>
                        <p align="center">请上传JPG/PNG/GIF/MP4/AVI/FLV/RAR/ZIP格式<span style="color:red">200M</span>以下的文件
		                  <p> 
		                  <center><?php
			                     $uploader=new PhpUploader();
			
			                      $uploader->MultipleFilesUpload=true;
			                      $uploader->InsertText="点击上传";
			
			                      $uploader->MaxSizeKB=10240000;	
			                      $uploader->AllowedFileExtensions="mp4,avi,flv,jpeg,jpg,gif,png,rar,zip";
			
			                      //Where'd the files go?
			                      $uploader->SaveDirectory="/root/ServerKit/uploadfiles";
		
			                      $uploader->Render();

		                  ?></center>
	               <script type='text/javascript'>
	               function CuteWebUI_AjaxUploader_OnTaskComplete(task)
	           {
		           var div=document.createElement("DIV");
		           div.innerHTML=task.FileName + " is uploaded!";
		           document.body.appendChild(div);
	           }
	               </script>	
            </p>	
	</div>
              
               </div>
           </div>
        </form>
    </div>
    <!-- To copy the form HTML, end here -->

</div>
</body>
</html>