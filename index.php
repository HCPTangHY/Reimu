<!doctype html>
<?php
session_start();
if(!isset($_SESSION["uid"])){
	header("Location:/login");
	exit();
}else{
	$uid=intval($_SESSION["uid"]);
}
require_once($_SERVER["DOCUMENT_ROOT"]."includes/user.class.php");
$user=new User();
$user->updateObj(uid:$uid);
$display=$user->GetInfo();
if(file_exists($_SERVER["DOCUMENT_ROOT"]."storage/avatar/".$uid.".gif")){
	$avatar=$uid.".gif";
}elseif(file_exists($_SERVER["DOCUMENT_ROOT"]."storage/avatar/".$uid.".png")){
	$avatar=$uid.".png";
}else{
	$avatar="0.png";
}
if(file_exists($_SERVER["DOCUMENT_ROOT"]."storage/bg/".$uid.".jpg")){
	$bg=$uid.".jpg";
}else{
	$bg="0.jpg";
}
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>个人面板 - Reimu</title>
<link href="/css/bootstrap.min.css" rel="stylesheet" />
<link href="/css/index.css" rel="stylesheet" />
<script type="application/javascript" src="/js/bootstrap.bundle.min.js"></script> 
<script type="application/javascript" src="/js/jquery-3.6.0.min.js"></script> 
<script type="application/javascript" src="/js/index.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow" role="navigation">
	<div class="container-fluid">
		<a class="navbar-brand" href="/"><img class="logo" src="/storage/reimu/logo.svg" /></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<u1 class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="#">近期活动</a></li>
					<li class="nav-item"><a class="nav-link" href="#">核心委员会</a></li>
					<li class="nav-item dropdown"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 我的资料 <b class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li><a  class="dropdown-item" href="#">修改头像</a></li>
							<li class="divider"></li>
							<li><a  class="dropdown-item" href="#">退出登录</a></li>
						</ul>
					</li>
				</u1>
			</div>
	</div>
</nav>
<main>
	<div class="container">
		
		<div class="row">
			<div class="col-12">
				<div class="my-3 p-4 text-white rounded user-card shadow" style="background: url(/storage/bg/<?php echo($bg); ?>) center no-repeat;">
					<h1 class="text-shadow"><img src="/storage/avatar/<?php echo($avatar); ?>" class="rounded-circle mx-2 p-1 img-shadow" style="max-height: 96px"><?php echo($user->name); ?></h1>
					<p class="lead text-shadow">用户名：<?php echo($user->username); ?></p>
					<hr class="my2">
					<p class="text-shadow"><?php echo($user->sign); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-3 border border-dark p-2 p-md-3 mb-auto rounded">
				<div class="nav nav-pills flex-column" id="pills-tab" role="tablist" aria-orientation="vertical">
					<button class="nav-link active" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">个人资料</button>
					<button class="nav-link" id="avatar-tab" data-bs-toggle="pill" data-bs-target="#avatar-panel" type="button" role="tab" aria-controls="avatar-panel" aria-selected="false">修改头像</button>
					<button class="nav-link" id="bg-tab" data-bs-toggle="pill" data-bs-target="#bg-panel" type="button" role="tab" aria-controls="bg-panel" aria-selected="false">名片背景</button>
					<button class="nav-link" id="pass-tab" data-bs-toggle="pill" data-bs-target="#pass-panel" type="button" role="tab" aria-controls="pass-panel" aria-selected="false">修改密码</button>
					<button class="nav-link">退出登录</button>
				</div>
			</div>
			<div class="col-9">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
							<h4> 个人资料 </h4>
						<div class="my-4">
							<form id="information">
							<div class="mb-3 row">
								<label class="col-3 col-form-label" for="username">用户名</label>
								<div class="col-9">
									<input type="text" class="form-control-plaintext" id="username" readonly value="<?php echo($user->username); ?>" aria-describedby="usernameHelp" />
								</div>
								<label id="usernameHelp" class="form-text">用户名不可更改</label>
							</div>
							<div class="mb-3 row">
								<label class="col-3 col-form-label" for="username">姓名</label>
								<div class="col-9">
									<input type="text" class="form-control-plaintext" id="name" readonly value="<?php echo($user->name); ?>" aria-describedby="nameHelp" />
								</div>
								<label id="usernameHelp" class="form-text">姓名不可更改</label>
							</div>
							<div class="mb-3">
								<label class="form-label" for="identity">身份证号</label>
								<input type="text" class="form-control" id="identity" placeholder="我们会保护您的隐私" aria-describedby="identityHelp" value="<?php echo($user->identity); ?>">
								<label id="identityHelp" class="form-text"></label>
							</div>
							<div class="mb-3">
								<label class="form-label" for="sex">性别</label>
								<select class="form-select" form="information" id="sex">
									<option id="sex0" value="0" <?php if($user->sex==0){echo("selected");} ?>>---建议使用生物学性别---</option>
									<option id="sex1" value="1" <?php if($user->sex==1){echo("selected");} ?>>男</option>
									<option id="sex2" value="2" <?php if($user->sex==2){echo("selected");} ?>>女</option>
									<option id="sex3" value="3" <?php if($user->sex==3){echo("selected");} ?>>魂魄妖梦</option>
								</select>
							</div>
							<hr class="my-4">
							<div class="mb-3">
								<label class="form-label" for="email">邮箱</label>
								<input type="text" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo("$user->email"); ?>" />
								<label class="form-text" id="emailHelp"></label>
								<input class="form-check-input" type="checkbox" id="email_display" <?php if($display["email"]==1){echo("checked");} ?> />
								<label class="form-check-label" for="email_display">在名片展示</label>
							</div>
							<div class="mb-3">
								<label class="form-label" for="phone">手机</label>
								<input type="text" class="form-control" id="phone" aria-describedby="phoneHelp" value="<?php echo("$user->phone"); ?>" />
								<label class="form-text" id="phoneHelp"></label>
								<input class="form-check-input" type="checkbox" id="phone_display" <?php if($display["phone"]==1){echo("checked");} ?> />
								<label class="form-check-label" for="phone_display">在名片展示</label>
							</div>
							<div class="mb-3">
								<label class="form-label" for="qq">QQ</label>
								<input type="text" class="form-control" id="qq" aria-describedby="qqHelp" value="<?php echo("$user->qq"); ?>" />
								<label class="form-text" id="qqHelp"></label>
								<input class="form-check-input" type="checkbox" id="qq_display" <?php if($display["qq"]==1){echo("checked");} ?> />
								<label class="form-check-label" for="qq_display">在名片展示</label>
							</div>
								<hr class="my-4">
							<div class="mb-3">
								<label for="sign" class="form-label">个性签名</label>
								<input type="text" id="sign" class="form-control" placeholder="一句话的个性签名" aria-describedby="signHelp" value="<?php echo("$user->sign"); ?>" />
								<label class="form-text" id="signHelp">不可超过100字</label>
							</div>
							<div class="mb-3">
								<label for="introductin" class="form-label">个人简介</label>
								<textarea class="form-control" id="introduction" aria-describedby="introHelp" rows="4"><?php echo("$user->introduction"); ?></textarea>
								<label class="form-text" id="introHelp"></label>
							</div>
							</form>
							<div class="row justify-content-end">
								<button class="btn btn-primary col-3 col-md-2" onClick="updateInfo();">保存</button>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="avatar-panel" role="tabpanel" aria-labelledby="avatar-tab">
					</div>
					<div class="tab-pane fade" id="bg-panel" role="tabpanel" aria-labelledby="avatar-tab">
					</div>
					<div class="tab-pane fade" id="pass-panel" role="tabpanel" aria-labelledby="avatar-tab">
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<footer style="bottom: 0; width: 100%">
	<div class="container-fluid bg-dark text-white" style="height: 48px;z-index:-999">
		<h5 class="px-auto text-center">Reimu</h5>
	</div>
</footer>
</body>
</html>
