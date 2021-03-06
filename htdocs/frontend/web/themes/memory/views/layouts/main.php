<?php

use common\components\M;

$themePath = $this->theme->baseUrl;
//M::printr($themePath, 'layout main of $themePath');

//M::printr($this->context, '$this');
//exit;
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta id="myViewport" name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">

	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
	<meta name="format-detection" content="telephone=no">

	<meta name="apple-mobile-web-app-capable" content="yes">

	<title><?= str_replace('"', '&#8243;', $this->context->page_title); ?></title>
    <?= Yii::$app->controller->renderPartial('@layouts/_seo_head'); ?>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
	      type="text/css">
	<link href="<?= $themePath ?>/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/assets/css/theme.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/vendor/plugins/select2/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/vendor/plugins/pnotify/pnotify.brighttheme.css" rel="stylesheet" type="text/css">
	<link href="<?= $themePath ?>/vendor/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<script type="text/javascript" src="<?= $themePath ?>/vendor/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?= $themePath ?>/vendor/jquery/jquery_ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?= $themePath ?>/vendor/jquery/jquery.tmpl.min.js"></script>
	<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/notifications/pnotify.min.js"></script>

	<link href="<?= $themePath ?>/vendor/plugins/jqueryContextMenu/dist/jquery.contextMenu.css" rel="stylesheet"
	      type="text/css">
	<script type="text/javascript"
	        src="<?= $themePath ?>/vendor/plugins/jqueryContextMenu/dist/jquery.ui.position.min.js"></script>

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?= $themePath ?>/assets/js/core/app.js"></script>

	<!-- SummerNote files -->
	<script src="/js/plugins/summernote/summernote.min.js?<?= time() ?>" type="text/javascript"></script>
	<link href="/js/plugins/summernote/summernote.css" rel="stylesheet" type="text/css">
	<!-- SummerNote files -->

	<!-- TinyMCE JS files and activation -- >
	<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/tinymce/tinymce.min.js"
	        referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '#mytextarea'
		});
	</script>
	<!-- TinyMCE JS files and activation -->

	<!-- CKEditor JS files - ->
	<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
	<!-- CKEditor JS files -->

</head>

<body>
<?php M::printr(__FILE__); ?>
<!--link href="<?= $themePath ?>/assets/css/all.css" rel="stylesheet"-->
<link href="<?= $themePath ?>/assets/css/theme.css" rel="stylesheet">

<div class="page-wrapper" style="Xpadding-bottom: 435px;">

    <?php /*/ ?>
    <svg style="position: absolute; width: 0; height: 0;" width="0" height="0" version="1.1"
         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <symbol viewBox="0 0 32 32" id="ico-tab-selected">
                <path d="M4.444 0v32l11.556-9.28 11.556 9.28v-32h-23.111z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-tab-un-selected">
                <path
                        d="M4.444 0v32l11.556-9.28 11.556 9.28v-32h-23.111zM26.014 28.907l-10.014-8.498-10.016 8.498v-27.36h20.030v27.36z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-envelope">
                <path
                        d="M28.093 3.733h-24.18c-2.163 0.011-3.913 1.767-3.913 3.932 0 0.002 0 0.003 0 0.005v16.65c0 0.004-0 0.008-0 0.013 0 2.165 1.749 3.922 3.911 3.934h24.175c2.163-0.012 3.913-1.768 3.913-3.933 0-0.005 0-0.010-0-0.015v-16.639c0-0.007 0-0.015 0-0.024 0-2.161-1.747-3.913-3.905-3.923zM30.219 24.32c0 0.003 0 0.007 0 0.011 0 1.176-0.951 2.129-2.125 2.133h-24.181c-1.175-0.005-2.125-0.958-2.125-2.133 0-0.004 0-0.008 0-0.011v-16.639c-0-0.003-0-0.007-0-0.011 0-1.175 0.95-2.128 2.124-2.133h24.174c1.175 0.004 2.126 0.958 2.126 2.133 0 0.004 0 0.008-0 0.011v16.639h0.006zM20.181 15.797l7.826-7.072c0.181-0.168 0.294-0.408 0.294-0.674 0-0.233-0.087-0.445-0.229-0.607-0.164-0.179-0.401-0.292-0.664-0.292-0.231 0-0.442 0.087-0.601 0.23l-10.792 9.759-2.106-1.899c-0.008-0.003-0.013-0.010-0.013-0.019 0-0.001 0-0.002 0-0.003-0.047-0.043-0.093-0.085-0.146-0.128l-8.567-7.723c-0.157-0.141-0.366-0.228-0.595-0.228-0.266 0-0.505 0.117-0.668 0.302-0.143 0.161-0.229 0.372-0.229 0.604 0 0.268 0.116 0.509 0.3 0.676l7.92 7.126-7.886 7.435c-0.173 0.167-0.281 0.401-0.281 0.66 0 0.239 0.092 0.457 0.242 0.62 0.165 0.172 0.396 0.282 0.653 0.287 0.237-0.002 0.451-0.095 0.611-0.246l8-7.541 2.172 1.952c0.151 0.139 0.354 0.224 0.577 0.224 0.007 0 0.013-0 0.020-0 0 0 0.002 0 0.003 0 0.228 0 0.435-0.085 0.593-0.225l2.231-2.015 7.958 7.616c0.163 0.162 0.387 0.262 0.635 0.262 0.497 0 0.9-0.403 0.9-0.9 0-0.268-0.117-0.508-0.302-0.673z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-basket">
                <path
                        d="M27.828 10.882h-23.668c-3.434 0.203-3.828 4.153-3.409 5.455l2.72 12.465c0.248 1.729 1.654 3.064 3.396 3.199l18.24 0.001c1.755-0.136 3.162-1.471 3.407-3.18l2.722-12.485c0.566-1.649-0.48-5.455-3.409-5.455zM10.929 25.865c0.001 0.017 0.001 0.036 0.001 0.056 0 0.708-0.574 1.281-1.281 1.281s-1.281-0.574-1.281-1.281c0-0.020 0-0.039 0.001-0.059l-0-8.328c-0.001-0.017-0.001-0.036-0.001-0.056 0-0.708 0.574-1.281 1.281-1.281s1.281 0.574 1.281 1.281c0 0.020-0 0.039-0.001 0.059l0 8.328zM17.12 25.865c0.001 0.017 0.001 0.036 0.001 0.056 0 0.708-0.574 1.281-1.281 1.281s-1.281-0.574-1.281-1.281c0-0.020 0-0.039 0.001-0.059l-0-8.328c-0.001-0.017-0.001-0.036-0.001-0.056 0-0.708 0.574-1.281 1.281-1.281s1.281 0.574 1.281 1.281c0 0.020-0 0.039-0.001 0.059l0 8.328zM23.323 25.865c0.001 0.017 0.001 0.036 0.001 0.056 0 0.708-0.574 1.281-1.281 1.281s-1.281-0.574-1.281-1.281c0-0.020 0-0.039 0.001-0.059l-0-8.328c-0.001-0.017-0.001-0.036-0.001-0.056 0-0.708 0.574-1.281 1.281-1.281s1.281 0.574 1.281 1.281c0 0.020-0 0.039-0.001 0.059l0 8.328zM16 2.661c2.954 0 5.477 2.289 6.498 5.513h2.658c-1.157-4.714-4.812-8.174-9.157-8.174s-8 3.46-9.169 8.175h2.658c1.022-3.225 3.545-5.514 6.511-5.514z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-menu-btn">
                <path
                        d="M1.92 3.84h28.16c1.060 0 1.92 0.86 1.92 1.92s-0.86 1.92-1.92 1.92h-28.16c-1.060 0-1.92-0.86-1.92-1.92s0.86-1.92 1.92-1.92zM1.92 24.32h28.16c1.060 0 1.92 0.86 1.92 1.92s-0.86 1.92-1.92 1.92h-28.16c-1.060 0-1.92-0.86-1.92-1.92s0.86-1.92 1.92-1.92zM1.92 14.080h28.16c1.060 0 1.92 0.86 1.92 1.92s-0.86 1.92-1.92 1.92h-28.16c-1.060 0-1.92-0.86-1.92-1.92s0.86-1.92 1.92-1.92z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-search">
                <path
                        d="M31.178 27.401l-6.944-6.943c-0.036-0.036-0.080-0.063-0.118-0.097 1.354-2.033 2.16-4.532 2.16-7.219 0-7.257-5.883-13.14-13.14-13.14s-13.14 5.883-13.14 13.14c0 7.257 5.883 13.14 13.14 13.14 2.691 0 5.192-0.809 7.275-2.196-0.015 0.068 0.011 0.112 0.048 0.148l6.944 6.944c0.487 0.505 1.169 0.819 1.924 0.819 1.475 0 2.671-1.196 2.671-2.671 0-0.756-0.314-1.439-0.819-1.925zM13.142 21.728c-4.74 0-8.582-3.842-8.582-8.582s3.842-8.582 8.582-8.582c4.74 0 8.582 3.842 8.582 8.582-0.002 4.738-3.844 8.577-8.582 8.577-0.001 0-0.001 0-0.002 0z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-certificate">
                <path
                        d="M5.999 7h20c0.552 0 1-0.448 1-1s-0.448-1-1-1h-20c-0.552 0-1 0.448-1 1s0.448 1 1 1zM5.999 11h10.001c0.011 0 0.024 0.001 0.037 0.001 0.552 0 1-0.448 1-1s-0.448-1-1-1c-0.013 0-0.026 0-0.039 0.001l-9.999-0c-0.536 0.021-0.963 0.46-0.963 1s0.427 0.979 0.961 1zM5.999 15h6.001c0.011 0 0.024 0.001 0.037 0.001 0.552 0 1-0.448 1-1s-0.448-1-1-1c-0.013 0-0.026 0-0.039 0.001l-5.999-0c-0.536 0.021-0.963 0.46-0.963 1s0.427 0.979 0.961 1zM21.999 19c0 0 0.001 0 0.001 0 1.105 0 2.001-0.896 2.001-2.001s-0.896-2.001-2.001-2.001c-1.105 0-2.001 0.896-2.001 2.001 0.002 1.104 0.896 1.998 1.999 2.001zM31 0h-29.999c-0 0-0.001 0-0.001 0-0.552 0-0.999 0.447-0.999 0.999 0 0 0 0 0 0v20c0.001 0.552 0.448 1 1 1h16v9c0 0.552 0.448 1 1 1 0.226 0 0.435-0.075 0.602-0.201l3.396-2.548 3.4 2.55c0.165 0.125 0.374 0.2 0.6 0.2 0.552 0 1-0.447 1-1v-9h4c0.552-0.002 0.999-0.448 1-1v-20c-0.002-0.551-0.449-0.997-1-0.999zM18.147 15.495l-0.175-0.821 0.8-0.259c0.306-0.101 0.543-0.338 0.642-0.637l0.261-0.807 0.821 0.177c0.063 0.014 0.135 0.022 0.209 0.022 0.259 0 0.495-0.098 0.672-0.259l0.622-0.563 0.623 0.563c0.177 0.16 0.413 0.259 0.672 0.259 0.074 0 0.146-0.008 0.216-0.023l0.816-0.175 0.259 0.8c0.101 0.306 0.338 0.543 0.637 0.642l0.807 0.261-0.177 0.821c-0.014 0.063-0.022 0.135-0.022 0.209 0 0.259 0.098 0.495 0.259 0.673l0.556 0.622-0.557 0.623c-0.16 0.177-0.258 0.413-0.258 0.672 0 0.074 0.008 0.146 0.023 0.215l0.175 0.816-0.8 0.257c-0.306 0.101-0.543 0.338-0.642 0.637l-0.261 0.808-0.821-0.177c-0.064-0.015-0.138-0.023-0.213-0.023-0.258 0-0.493 0.098-0.669 0.259l-0.622 0.563-0.623-0.563c-0.176-0.16-0.411-0.259-0.669-0.259-0 0-0.001 0-0.001 0-0.075 0.001-0.147 0.009-0.217 0.024l-0.815 0.175-0.257-0.8c-0.101-0.306-0.338-0.543-0.637-0.642l-0.807-0.259 0.175-0.822c0.014-0.063 0.023-0.136 0.023-0.211 0-0.258-0.098-0.493-0.258-0.671l-0.556-0.622 0.557-0.623c0.16-0.176 0.258-0.411 0.258-0.669 0-0.075-0.008-0.148-0.024-0.218zM22.599 27.2c-0.165-0.125-0.374-0.2-0.6-0.2s-0.435 0.075-0.603 0.202l-2.398 1.797v-5.821c0.032 0.004 0.068 0.006 0.105 0.006s0.073-0.002 0.109-0.007l1.201-0.258 0.914 0.828c0.177 0.16 0.413 0.259 0.671 0.259s0.495-0.098 0.672-0.259l0.913-0.827 1.203 0.259c0.032 0.004 0.068 0.006 0.106 0.006s0.074-0.002 0.11-0.007l-0.004 5.82zM29.998 19.999h-1.82c0.004-0.032 0.006-0.068 0.006-0.105s-0.002-0.074-0.006-0.109l-0.258-1.2 0.826-0.914c0.16-0.177 0.258-0.412 0.258-0.671s-0.098-0.494-0.258-0.671l-0.826-0.913 0.259-1.205c0.014-0.063 0.022-0.136 0.022-0.21 0-0.443-0.287-0.818-0.686-0.95l-1.18-0.38-0.378-1.173c-0.134-0.405-0.509-0.693-0.952-0.693-0.074 0-0.147 0.008-0.216 0.023l-1.198 0.258-0.914-0.826c-0.177-0.16-0.413-0.259-0.671-0.259s-0.495 0.098-0.672 0.259l-0.913 0.826-1.205-0.259c-0.063-0.014-0.135-0.022-0.209-0.022-0.443 0-0.818 0.287-0.951 0.686l-0.38 1.18-1.173 0.378c-0.405 0.133-0.693 0.509-0.693 0.951 0 0.075 0.008 0.147 0.024 0.217l0.258 1.198-0.826 0.914c-0.16 0.177-0.259 0.412-0.259 0.671s0.098 0.494 0.259 0.671l0.826 0.913-0.259 1.205c-0.004 0.032-0.006 0.068-0.006 0.105s0.002 0.074 0.006 0.109l-13.822-0.004v-17.999h28v17.999z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-product-in-basket">
                <path d="M26.197 2.581l-14.802 15.040-5.593-5.677-5.802 5.894 11.395 11.582 20.605-20.945z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-slider-control">
                <path
                        d="M17.486 9.395v0c0.264-0.247 0.62-0.398 1.011-0.399 0.001 0 0.002 0 0.003 0 0.827 0 1.497 0.67 1.497 1.497 0 0.438-0.188 0.831-0.487 1.105l-0.001 0.001-4.793 4.394 4.793 4.395c0.298 0.274 0.484 0.666 0.484 1.102 0 0.826-0.669 1.495-1.495 1.495-0.39 0-0.746-0.15-1.012-0.395l0.001 0.001-6-5.497c-0.3-0.275-0.487-0.668-0.487-1.106s0.187-0.831 0.486-1.105zM16 0c8.837 0 16 7.163 16 16s-7.163 16-16 16c-8.837 0-16-7.163-16-16s7.163-16 16-16zM16 28.999c7.18 0 13-5.82 13-13s-5.82-13-13-13c-7.18 0-13 5.82-13 13 0 0 0 0.001 0 0.001 0.009 7.176 5.824 12.991 12.999 12.999z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-arrow">
                <path
                        d="M24.485 17.554l-13.801 13.745c-0.409 0.403-0.97 0.651-1.589 0.651s-1.181-0.249-1.59-0.652c-0.406-0.405-0.658-0.965-0.658-1.584s0.252-1.18 0.658-1.585l12.212-12.16-12.212-12.16c-0.402-0.405-0.65-0.962-0.65-1.577 0-1.237 1.002-2.239 2.239-2.239 0.621 0 1.184 0.253 1.589 0.662l13.801 13.73c0.405 0.406 0.656 0.966 0.658 1.584 0 0.005 0 0.009 0 0.014 0 0.615-0.252 1.171-0.658 1.571z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-stock">
                <path
                        d="M20.091 9.044c-0.107-0.061-0.235-0.097-0.372-0.097-0.276 0-0.519 0.147-0.652 0.368l-7.444 12.651c-0.061 0.103-0.097 0.226-0.097 0.358 0 0.272 0.152 0.508 0.376 0.628 0.111 0.061 0.238 0.096 0.374 0.096 0.001 0 0.002 0 0.004 0 0.275 0 0.516-0.146 0.65-0.364l7.446-12.651c0.061-0.103 0.097-0.226 0.097-0.358 0-0.272-0.153-0.509-0.378-0.629zM14.088 14.938c0.285-0.463 0.454-1.023 0.454-1.623 0-0.302-0.043-0.594-0.123-0.87-0.241-0.838-0.809-1.537-1.556-1.95-0.504-0.284-1.086-0.446-1.706-0.446-0.313 0-0.616 0.041-0.904 0.118-0.853 0.22-1.575 0.769-2.023 1.503-0.293 0.478-0.462 1.039-0.462 1.639 0 0.302 0.043 0.593 0.122 0.87 0.241 0.838 0.809 1.537 1.556 1.95 0.502 0.284 1.083 0.446 1.702 0.446 0 0 0 0 0 0 0.314-0 0.619-0.042 0.909-0.118 0.853-0.221 1.576-0.772 2.022-1.508zM10.216 14.88c-0.424-0.234-0.74-0.621-0.875-1.086-0.044-0.154-0.068-0.316-0.068-0.483 0-0.333 0.094-0.644 0.257-0.909 0.249-0.407 0.65-0.711 1.124-0.832 0.159-0.043 0.328-0.065 0.502-0.065 0.345 0 0.668 0.090 0.949 0.247 0.415 0.229 0.73 0.616 0.863 1.081 0.044 0.154 0.068 0.316 0.068 0.483 0 0.333-0.094 0.644-0.257 0.908-0.249 0.408-0.65 0.712-1.124 0.834-0.16 0.043-0.329 0.066-0.504 0.066-0.346 0-0.67-0.091-0.951-0.25zM22.536 15.866c-0.487-0.276-1.069-0.438-1.689-0.438-0.313 0-0.616 0.041-0.905 0.119-0.853 0.22-1.575 0.769-2.021 1.503-0.294 0.477-0.463 1.037-0.463 1.637 0 0.302 0.043 0.595 0.123 0.871 0.241 0.838 0.809 1.537 1.556 1.95 0.502 0.284 1.083 0.446 1.701 0.446 0 0 0.001 0 0.001 0s0.001 0 0.002 0c0.313 0 0.617-0.041 0.906-0.118 0.853-0.22 1.575-0.769 2.021-1.503 0.294-0.477 0.463-1.037 0.463-1.637 0-0.302-0.043-0.595-0.123-0.871-0.241-0.838-0.809-1.537-1.556-1.95zM22.475 19.592c-0.254 0.414-0.655 0.718-1.128 0.84-0.16 0.043-0.329 0.067-0.504 0.067-0.344 0-0.667-0.090-0.946-0.249-0.415-0.228-0.73-0.615-0.865-1.079-0.044-0.153-0.068-0.315-0.068-0.482 0-0.333 0.094-0.645 0.256-0.91 0.249-0.407 0.65-0.711 1.124-0.832 0.159-0.042 0.328-0.065 0.501-0.065 0.001 0 0.003 0 0.004 0s0.002 0 0.003 0c0.343 0 0.664 0.090 0.942 0.247 0.415 0.229 0.731 0.616 0.865 1.081 0.044 0.153 0.067 0.314 0.067 0.48 0 0.333-0.093 0.645-0.256 0.91zM31.343 16c0.039-0.612 0.147-1.184 0.319-1.727 0.199-0.524 0.323-1.188 0.323-1.881 0-0.476-0.058-0.939-0.168-1.381-0.473-1.044-1.226-1.931-2.167-2.562-0.475-0.348-0.871-0.716-1.222-1.123-0.294-0.433-0.546-0.919-0.74-1.433-0.381-1.175-1.037-2.123-1.896-2.835-0.929-0.552-2.036-0.873-3.218-0.873-0.042 0-0.084 0-0.126 0.001-0.608-0.018-1.194-0.103-1.756-0.247-0.499-0.202-0.976-0.453-1.419-0.751-0.855-0.736-2.008-1.194-3.268-1.194s-2.413 0.458-3.302 1.216c-0.41 0.275-0.887 0.526-1.392 0.723-0.556 0.15-1.142 0.234-1.744 0.252-0.047-0-0.090-0.001-0.132-0.001-1.182 0-2.288 0.321-3.237 0.881-0.84 0.703-1.496 1.651-1.849 2.736-0.221 0.605-0.473 1.090-0.775 1.539-0.344 0.391-0.74 0.758-1.173 1.079-0.982 0.657-1.736 1.545-2.202 2.589-0.118 0.442-0.176 0.906-0.176 1.384 0 0.692 0.123 1.355 0.349 1.969 0.177 0.457 0.287 1.031 0.287 1.631s-0.11 1.174-0.311 1.704c-0.202 0.541-0.325 1.204-0.325 1.896 0 0.477 0.059 0.941 0.169 1.385 0.473 1.043 1.226 1.931 2.167 2.56 0.475 0.348 0.871 0.716 1.222 1.123 0.293 0.433 0.545 0.918 0.74 1.432 0.381 1.176 1.037 2.124 1.896 2.836 0.932 0.553 2.041 0.874 3.226 0.874 0.040 0 0.079-0 0.118-0.001 0.607 0.017 1.193 0.101 1.754 0.245 0.5 0.202 0.978 0.453 1.421 0.751 0.855 0.736 2.008 1.193 3.268 1.193s2.413-0.458 3.302-1.216c0.409-0.275 0.886-0.527 1.391-0.724 0.557-0.15 1.143-0.235 1.747-0.25 0.044 0 0.083 0.001 0.122 0.001 1.185 0 2.294-0.322 3.246-0.883 0.838-0.704 1.494-1.652 1.848-2.736 0.222-0.605 0.474-1.090 0.776-1.54 0.343-0.391 0.739-0.759 1.173-1.079 0.982-0.658 1.736-1.545 2.202-2.589 0.117-0.441 0.175-0.904 0.175-1.38 0-0.693-0.123-1.357-0.349-1.972-0.144-0.45-0.252-1.017-0.291-1.604zM29.452 18.19c0.169 0.436 0.267 0.94 0.267 1.467 0 0.218-0.017 0.432-0.049 0.641-0.359 0.642-0.866 1.188-1.478 1.585-0.615 0.455-1.136 0.951-1.591 1.502-0.406 0.573-0.748 1.211-1.007 1.891-0.244 0.79-0.633 1.414-1.145 1.912-0.59 0.291-1.283 0.46-2.015 0.46-0.052 0-0.104-0.001-0.156-0.003-0.8 0.027-1.568 0.147-2.301 0.352-0.677 0.252-1.322 0.58-1.917 0.977-0.5 0.522-1.241 0.858-2.061 0.858s-1.562-0.336-2.094-0.879c-0.562-0.376-1.206-0.704-1.888-0.953-0.727-0.208-1.495-0.329-2.287-0.355-0.060 0.001-0.112 0.002-0.164 0.002-0.733 0-1.426-0.17-2.043-0.472-0.485-0.487-0.874-1.111-1.089-1.81-0.288-0.77-0.63-1.408-1.042-1.994-0.449-0.538-0.97-1.034-1.544-1.462-0.652-0.425-1.159-0.97-1.511-1.612-0.040-0.207-0.057-0.42-0.057-0.637 0-0.528 0.098-1.034 0.276-1.5 0.223-0.624 0.358-1.377 0.358-2.162s-0.135-1.538-0.382-2.238c-0.154-0.39-0.252-0.895-0.252-1.424 0-0.217 0.016-0.429 0.048-0.637 0.361-0.642 0.868-1.187 1.479-1.585 0.614-0.456 1.135-0.951 1.591-1.501 0.405-0.573 0.747-1.212 1.007-1.891 0.244-0.79 0.633-1.414 1.144-1.912 0.591-0.291 1.286-0.46 2.020-0.46 0.051 0 0.101 0.001 0.152 0.002 0.8-0.027 1.568-0.147 2.301-0.352 0.677-0.252 1.322-0.58 1.917-0.977 0.5-0.521 1.241-0.857 2.060-0.857s1.561 0.336 2.093 0.877c0.562 0.376 1.207 0.704 1.889 0.953 0.728 0.208 1.495 0.329 2.287 0.355 0.059-0.001 0.109-0.002 0.16-0.002 0.734 0 1.428 0.17 2.046 0.472 0.486 0.487 0.875 1.11 1.090 1.81 0.288 0.77 0.63 1.409 1.042 1.995 0.449 0.538 0.97 1.033 1.544 1.461 0.652 0.424 1.159 0.97 1.51 1.612 0.041 0.209 0.058 0.423 0.058 0.641 0 0.527-0.098 1.031-0.277 1.495-0.222 0.624-0.356 1.378-0.356 2.162s0.134 1.538 0.38 2.238z"></path>
            </symbol>
            <symbol viewBox="0 0 34 32" id="ico-arrow-type">
                <path
                        d="M19.68 0.415c-0.282-0.297-0.679-0.483-1.12-0.483s-0.839 0.185-1.119 0.482c-0.282 0.297-0.454 0.698-0.454 1.139s0.173 0.842 0.454 1.139l11.361 11.652h-27.233c-0.868 0.007-1.569 0.713-1.569 1.582 0 0.010 0 0.020 0 0.029s-0 0.021-0 0.033c0 0.873 0.699 1.582 1.568 1.599l27.234 0-11.362 11.631c-0.281 0.3-0.453 0.704-0.453 1.149s0.173 0.849 0.454 1.15c0.281 0.297 0.678 0.482 1.119 0.482s0.839-0.185 1.119-0.482l14.054-14.413c0.29-0.291 0.47-0.693 0.47-1.137s-0.179-0.846-0.47-1.137z"></path>
            </symbol>
            <symbol viewBox="0 0 52 32" id="ico-look">
                <path
                        d="M51.6 17.090c0.216-0.305 0.345-0.684 0.345-1.094 0-0.445-0.153-0.854-0.408-1.178-7.857-9.83-16.337-14.818-25.217-14.818-15.060 0-25.54 14.294-25.96 14.898-0.227 0.306-0.363 0.691-0.363 1.108 0 0.44 0.152 0.845 0.406 1.164 7.857 9.842 16.337 14.83 25.217 14.83 15.060 0 25.52-14.294 25.98-14.91zM25.62 28.29c-7.4 0-14.62-4.146-21.46-12.308 2.68-3.228 11.2-12.286 22.16-12.286 7.4 0 14.6 4.146 21.46 12.308-2.68 3.234-11.2 12.292-22.16 12.292zM25.96 6.59c-0.048-0.001-0.104-0.001-0.16-0.001-5.191 0-9.4 4.209-9.4 9.4s4.209 9.4 9.4 9.4c5.191 0 9.399-4.208 9.4-9.399 0-0.019 0-0.041 0-0.063 0-5.121-4.126-9.278-9.236-9.328zM25.96 21.694c-0.030 0.001-0.065 0.001-0.1 0.001-3.148 0-5.7-2.552-5.7-5.7s2.552-5.7 5.7-5.7c3.148 0 5.7 2.551 5.7 5.699 0 0.013 0 0.029 0 0.044 0 3.105-2.5 5.627-5.597 5.662z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-fb">
                <path fill="#3b5998" style="fill: var(--color1, #3b5998)"
                      d="M16 0c8.837 0 16 7.164 16 16 0 8.837-7.163 16-16 16s-16-7.163-16-16c0-8.836 7.163-16 16-16z"></path>
                <path fill="#fff" style="fill: var(--color2, #fff)"
                      d="M17.948 11.015h2.062v-3.046h-2.424v0.011c-2.937 0.104-3.539 1.755-3.592 3.489h-0.006v1.521h-2v2.983h2v7.996h3.014v-7.996h2.469l0.477-2.983h-2.945v-0.919c0-0.586 0.39-1.056 0.945-1.056z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-vk">
                <path fill="#4d76a1" style="fill: var(--color3, #4d76a1)"
                      d="M32 16c0 8.837-7.163 16-16 16s-16-7.163-16-16c0-8.837 7.163-16 16-16s16 7.163 16 16z"></path>
                <path fill="#fff" style="fill: var(--color2, #fff)"
                      d="M15.396 23.017h1.256c0 0 0.379-0.042 0.573-0.25 0.178-0.192 0.173-0.552 0.173-0.552s-0.025-1.685 0.758-1.933c0.771-0.244 1.761 1.629 2.81 2.349 0.793 0.545 1.396 0.426 1.396 0.426l2.806-0.039c0 0 1.468-0.090 0.772-1.244-0.057-0.094-0.405-0.854-2.086-2.414-1.759-1.633-1.524-1.369 0.596-4.193 1.291-1.72 1.807-2.77 1.645-3.22-0.154-0.428-1.103-0.315-1.103-0.315l-3.159 0.020c0 0-0.234-0.032-0.408 0.072-0.17 0.102-0.279 0.339-0.279 0.339s-0.5 1.331-1.167 2.463c-1.407 2.389-1.969 2.515-2.199 2.366-0.535-0.346-0.401-1.389-0.401-2.13 0-2.315 0.351-3.28-0.684-3.53-0.343-0.083-0.596-0.138-1.474-0.147-1.127-0.012-2.081 0.003-2.621 0.268-0.359 0.176-0.637 0.568-0.468 0.591 0.209 0.028 0.682 0.127 0.932 0.469 0.324 0.44 0.312 1.43 0.312 1.43s0.186 2.725-0.434 3.064c-0.426 0.232-1.010-0.242-2.264-2.409-0.643-1.11-1.128-2.337-1.128-2.337s-0.094-0.229-0.26-0.352c-0.203-0.149-0.485-0.196-0.485-0.196l-3.002 0.020c0 0-0.451 0.013-0.616 0.209-0.147 0.174-0.012 0.535-0.012 0.535s2.35 5.498 5.011 8.269c2.44 2.54 5.211 2.374 5.211 2.374v0z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-place">
                <path
                        d="M23.91 3.276v0c-4.368-4.368-11.45-4.368-15.819 0v0c-3.936 3.936-4.379 11.347-1.039 15.801l8.948 12.923 8.948-12.923c3.34-4.454 2.897-11.865-1.039-15.801zM16.109 14.769c-2.039 0-3.692-1.653-3.692-3.692s1.653-3.692 3.692-3.692 3.692 1.653 3.692 3.692-1.653 3.692-3.692 3.692z"></path>
            </symbol>
            <symbol viewBox="0 0 59 32" id="ico-fish">
                <path
                        d="M14.765 9.836c-1.638-4.327-5.748-7.348-10.563-7.348-0.882 0-1.74 0.101-2.563 0.293-0.638 0.146-1.192 0.696-1.356 1.395-0.179 0.755-0.279 1.606-0.279 2.482 0 3.872 1.975 7.283 4.973 9.281-0.599 0.455-1.157 0.915-1.668 1.422-2.037 2.016-3.299 4.814-3.299 7.906 0 0.877 0.101 1.729 0.293 2.547 0.152 0.638 0.705 1.188 1.407 1.348 0.759 0.179 1.616 0.28 2.497 0.28 4.816 0 8.926-3.020 10.54-7.27 3.124 3.836 7.273 6.792 12.047 8.378 10.577-5.675 17.71-16.206 18.599-28.469-2.966-1.374-6.423-2.106-10.051-2.106-8.296 0-15.698 3.827-20.537 9.812zM59.124 15.182c-2.207-4.777-5.668-8.656-9.965-11.314l-0.129-0.064c-1.321 11.651-7.59 21.617-16.622 27.876 0.83 0.21 1.94 0.282 3.066 0.282 10.443 0 19.448-6.157 23.583-15.039 0.177-0.392 0.242-0.664 0.242-0.95s-0.065-0.559-0.18-0.802zM52.001 16.161c-1.37-0.009-2.477-1.122-2.477-2.493 0-1.377 1.116-2.493 2.493-2.493s2.493 1.116 2.493 2.493c0 0.001 0 0.002 0 0.002-0.003 1.376-1.119 2.49-2.495 2.49-0.006 0-0.011-0-0.017-0z"></path>
            </symbol>
            <symbol viewBox="0 0 33 32" id="ico-disp1">
                <path
                        d="M0 24.275h7.903v7.725h-7.903v-7.725zM0 12.138h7.903v7.723h-7.903v-7.723zM0 0h7.903v7.723h-7.903v-7.723zM12.424 24.275h7.903v7.725h-7.903v-7.725zM12.424 12.138h7.903v7.723h-7.903v-7.723zM12.424 0h7.903v7.723h-7.903v-7.723zM24.835 24.275h7.903v7.725h-7.903v-7.725zM24.835 12.138h7.903v7.723h-7.903v-7.723zM24.835 0h7.903v7.723h-7.903v-7.723z"></path>
            </symbol>
            <symbol viewBox="0 0 45 32" id="ico-disp2">
                <path
                        d="M-0.014 24.275h7.903v7.725h-7.903v-7.725zM-0.014 12.138h7.903v7.723h-7.903v-7.723zM-0.014 0h7.903v7.723h-7.903v-7.723zM12.41 24.275h33.085v7.725h-33.085v-7.725zM12.41 12.138h33.085v7.723h-33.085v-7.723zM12.41 0h33.085v7.723h-33.085v-7.723zM24.821 32v-7.725zM24.821 19.861v-7.723zM24.821 7.723v-7.723z"></path>
            </symbol>
            <symbol viewBox="0 0 25 32" id="ico-load">
                <path
                        d="M0.082 17.115c-0.052-0.422-0.081-0.911-0.081-1.407 0-6.673 5.353-12.096 11.998-12.209l0.011-3.283c0.007-0.121 0.107-0.217 0.23-0.217 0.056 0 0.107 0.020 0.146 0.052l6.726 4.955c0.051 0.040 0.083 0.101 0.083 0.17s-0.032 0.13-0.082 0.17l-6.72 4.955c-0.039 0.032-0.090 0.052-0.146 0.052-0.123 0-0.223-0.096-0.23-0.217l-0-3.273c-4.8 0.087-8.658 3.998-8.658 8.811 0 2.091 0.728 4.012 1.945 5.523 0.212 0.267 0.349 0.63 0.349 1.026 0 0.929-0.753 1.682-1.682 1.682-0.534 0-1.009-0.248-1.317-0.636-1.367-1.696-2.29-3.798-2.565-6.098zM19.5 10.818c1.114 1.368 1.822 3.107 1.919 5.006 0.008 0.152 0.012 0.305 0.012 0.46 0 4.821-3.853 8.741-8.647 8.851l-0.010-3.272c-0.008-0.121-0.108-0.216-0.231-0.216-0.055 0-0.106 0.019-0.145 0.051l-6.726 4.954c-0.051 0.040-0.083 0.101-0.083 0.17s0.032 0.13 0.082 0.17l6.719 4.955c0.040 0.033 0.091 0.053 0.147 0.053 0.123 0 0.223-0.096 0.23-0.218l0-3.283c5.445-0.080 10.018-3.724 11.497-8.698 0.334-1.12 0.513-2.308 0.513-3.538 0-0.49-0.028-0.973-0.084-1.448-0.273-2.297-1.193-4.395-2.575-6.107-0.293-0.367-0.768-0.616-1.301-0.616-0.928 0-1.681 0.753-1.681 1.681 0 0.395 0.137 0.759 0.365 1.046z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-zoom">
                <path
                        d="M13.027 26.055c0 0 0.001 0 0.001 0 3.238 0 6.199-1.187 8.471-3.15l8.768 8.799c0.184 0.184 0.437 0.297 0.718 0.297 0.561 0 1.015-0.454 1.015-1.015 0-0.28-0.114-0.534-0.298-0.718l-8.785-8.785c1.933-2.258 3.11-5.213 3.11-8.443 0-7.188-5.827-13.015-13.015-13.015s-13.015 5.827-13.015 13.015c0 7.188 5.827 13.015 13.015 13.015 0.005 0 0.010 0 0.015 0zM13.027 2.027c6.075 0 11 4.925 11 11s-4.925 11-11 11c-6.075 0-11-4.925-11-11 0.006-6.073 4.927-10.994 10.999-11zM9.107 14.042h2.551v2.552c0.018 0.547 0.466 0.984 1.015 0.984s0.998-0.437 1.015-0.983l0-2.554h2.552c0.547-0.018 0.984-0.466 0.984-1.015s-0.437-0.998-0.983-1.015l-2.554-0v-2.552c-0.018-0.547-0.466-0.984-1.015-0.984s-0.998 0.437-1.015 0.982l-0 2.554h-2.551c-0.547 0.018-0.984 0.466-0.984 1.015s0.437 0.998 0.982 1.015z"></path>
            </symbol>
            <symbol viewBox="0 0 32 32" id="ico-info">
                <path
                        d="M16 32c-8.837 0-16-7.163-16-16s7.163-16 16-16c8.837 0 16 7.163 16 16-0.010 8.832-7.168 15.99-15.999 16zM16 4.046c-0.001 0-0.001 0-0.002 0-6.602 0-11.954 5.352-11.954 11.954s5.352 11.954 11.954 11.954c6.602 0 11.954-5.352 11.954-11.954-0.010-6.597-5.355-11.943-11.951-11.954zM15.758 8.503c1.047 0.001 1.895 0.85 1.895 1.897s-0.849 1.897-1.897 1.897-1.897-0.849-1.897-1.897c0-1.048 0.849-1.897 1.897-1.897 0.001 0 0.002 0 0.002 0zM18.619 23.497h-5.239v-2.537h0.96v-4.32h-0.946v-2.537h4.265v6.857h0.96v2.537z"></path>
            </symbol>
            <symbol viewBox="0 0 30 32" id="ico-like">
                <path
                        d="M29.046 17.88c0.599-0.863 0.956-1.932 0.956-3.084 0-0.020-0-0.039-0-0.059 0-0.004 0-0.011 0-0.019 0-1.348-0.57-2.562-1.481-3.416-0.892-0.904-2.127-1.463-3.492-1.463-0.009 0-0.019 0-0.028 0h-3.437c0.568-1.068 0.911-2.331 0.938-3.672 0.005-0.114 0.008-0.238 0.008-0.363 0-1.169-0.255-2.278-0.712-3.275-0.418-0.811-1.109-1.49-1.954-1.9-0.852-0.403-1.821-0.632-2.844-0.632-0.046 0-0.091 0-0.137 0.001 0.003-0-0.001-0-0.005-0-0.681 0-1.299 0.275-1.747 0.72-0.567 0.55-0.989 1.246-1.204 2.028-0.255 0.892-0.453 1.692-0.607 2.472-0.077 0.63-0.326 1.19-0.699 1.646q-0.951 1.014-2.085 2.454c-0.793 1.123-1.673 2.101-2.657 2.964l-5.371 0.016c-0.012-0-0.027-0-0.041-0-0.675 0-1.286 0.275-1.727 0.72-0.452 0.43-0.732 1.035-0.732 1.706 0 0.012 0 0.024 0 0.036l-0 12.318c-0 0.010-0 0.022-0 0.035 0 0.671 0.281 1.276 0.731 1.704 0.442 0.446 1.053 0.721 1.728 0.721 0.014 0 0.029-0 0.043-0l5.624 0c1.031 0.194 1.935 0.457 2.801 0.796 0.99 0.378 2.401 0.81 3.844 1.166 1.377 0.338 2.638 0.498 3.936 0.498 0.016 0 0.032-0 0.048-0h2.518c0.085 0.004 0.185 0.006 0.286 0.006 1.59 0 3.043-0.586 4.156-1.553 0.848-1.907 1.809-4.445 2.653-7.036 0.174-0.906 0.152-1.191 0.11-1.468 0.47-0.754 0.746-1.699 0.746-2.709 0-0.007 0-0.014-0-0.020 0-0.016 0-0.036 0-0.057 0-0.456-0.060-0.898-0.172-1.318zM4.628 26.72c-0.226 0.222-0.536 0.36-0.878 0.36-0.687 0-1.245-0.553-1.252-1.239 0-0.001 0-0.002 0-0.002 0-0.338 0.143-0.643 0.371-0.858 0.227-0.223 0.537-0.36 0.88-0.36s0.653 0.137 0.879 0.36c0.228 0.216 0.37 0.521 0.37 0.859 0 0 0 0.001 0 0.001s0 0.001 0 0.002c0 0.344-0.142 0.655-0.37 0.877zM27.082 16.32c-0.144 0.479-0.544 0.837-1.036 0.919 0.208 0.253 0.376 0.554 0.476 0.884 0.121 0.338 0.194 0.707 0.204 1.093 0 0.009 0 0.014 0 0.019 0 0.903-0.399 1.713-1.030 2.263 0.217 0.382 0.347 0.837 0.348 1.323-0.003 0.519-0.129 1.007-0.35 1.438-0.195 0.414-0.514 0.762-0.909 0.996 0.047 0.323 0.082 0.689 0.085 1.063 0 2.143-1.25 3.223-3.75 3.223h-2.362c-2.432-0.122-4.712-0.625-6.83-1.451-0.006-0.019-0.194-0.087-0.388-0.142-0.342-0.127-0.574-0.207-0.724-0.247-0.182-0.075-0.41-0.15-0.643-0.211-0.347-0.109-0.595-0.189-0.783-0.229s-0.4-0.080-0.644-0.12c-0.183-0.035-0.396-0.056-0.613-0.060l-0.633-0v-12.32h0.624c0.253-0.001 0.491-0.060 0.703-0.164 0.288-0.147 0.544-0.32 0.775-0.52 0.263-0.236 0.513-0.456 0.749-0.676 0.27-0.267 0.525-0.547 0.765-0.841 0.301-0.359 0.527-0.619 0.689-0.819s0.368-0.48 0.616-0.8 0.4-0.52 0.45-0.58q1.074-1.29 1.504-1.74c0.539-0.58 0.942-1.294 1.154-2.085q0.368-1.295 0.608-2.435c0.091-0.634 0.357-1.194 0.747-1.644 0.113-0.013 0.248-0.022 0.385-0.022 0.834 0 1.585 0.356 2.11 0.924 0.402 0.705 0.639 1.547 0.639 2.444 0 0.126-0.005 0.251-0.014 0.375-0.102 1.128-0.438 2.174-0.957 3.103-0.477 0.844-0.812 1.883-0.913 2.99l6.866 0.030c0.681 0.008 1.295 0.29 1.738 0.74 0.465 0.429 0.757 1.040 0.762 1.719-0.023 0.575-0.175 1.109-0.428 1.581z"></path>
            </symbol>
            <symbol viewBox="0 0 30 32" id="ico-dislike">
                <path
                        d="M0.954 14.12c-0.598 0.861-0.956 1.928-0.956 3.079 0 0.015 0 0.029 0 0.044-0 0.009-0 0.022-0 0.035 0 1.349 0.57 2.565 1.482 3.42 0.892 0.904 2.127 1.462 3.492 1.462 0.009 0 0.019-0 0.028-0h3.437c-0.568 1.068-0.911 2.331-0.938 3.672-0.005 0.114-0.008 0.238-0.008 0.363 0 1.169 0.255 2.278 0.712 3.275 0.418 0.811 1.109 1.49 1.954 1.9 0.852 0.403 1.821 0.633 2.844 0.633 0.046 0 0.091-0 0.137-0.001-0.004 0 0 0 0.004 0 0.682 0 1.299-0.275 1.747-0.72 0.567-0.55 0.989-1.246 1.204-2.028 0.255-0.892 0.453-1.692 0.607-2.472 0.076-0.629 0.325-1.19 0.697-1.646q0.955-1.014 2.087-2.454c0.793-1.123 1.673-2.101 2.657-2.964l5.371-0.016c0.012 0 0.027 0 0.041 0 0.675 0 1.286-0.275 1.727-0.72 0.452-0.43 0.732-1.035 0.732-1.706 0-0.012-0-0.024-0-0.036l0-12.318c0-0.010 0-0.022 0-0.035 0-0.671-0.281-1.276-0.731-1.704-0.442-0.446-1.054-0.721-1.729-0.721-0.014 0-0.028 0-0.042 0l-5.624-0c-1.031-0.194-1.935-0.457-2.801-0.796-0.989-0.377-2.401-0.81-3.843-1.165-1.378-0.338-2.639-0.499-3.937-0.499-0.016 0-0.032 0-0.048 0h-2.518c-0.085-0.004-0.185-0.006-0.286-0.006-1.59 0-3.043 0.586-4.156 1.553-0.848 1.907-1.809 4.445-2.653 7.036-0.174 0.906-0.152 1.191-0.11 1.468-0.472 0.755-0.748 1.702-0.748 2.713 0 0.005 0 0.011 0 0.016-0 0.014-0 0.032-0 0.049 0 0.458 0.061 0.903 0.174 1.325zM25.372 5.28c0.226-0.222 0.536-0.36 0.878-0.36 0.687 0 1.245 0.553 1.252 1.239 0 0.001 0 0.002 0 0.002 0 0.338-0.143 0.643-0.371 0.858-0.227 0.223-0.537 0.36-0.88 0.36s-0.653-0.137-0.879-0.36c-0.228-0.215-0.37-0.518-0.37-0.855 0-0.002 0-0.003 0-0.005s0-0.003 0-0.005c0-0.343 0.142-0.653 0.37-0.874zM2.918 15.68c0.144-0.479 0.543-0.837 1.036-0.919-0.204-0.255-0.371-0.555-0.475-0.882-0.122-0.339-0.194-0.709-0.205-1.094-0-0.009-0-0.014-0-0.019 0-0.903 0.399-1.713 1.030-2.263-0.217-0.382-0.347-0.837-0.348-1.323 0.003-0.519 0.129-1.007 0.35-1.438 0.195-0.414 0.514-0.762 0.909-0.996-0.048-0.322-0.083-0.689-0.087-1.062-0-2.143 1.252-3.224 3.752-3.224h2.362c2.432 0.122 4.712 0.625 6.83 1.451 0.007 0.019 0.195 0.088 0.389 0.142 0.341 0.127 0.573 0.207 0.723 0.247 0.182 0.075 0.41 0.15 0.643 0.211 0.347 0.109 0.593 0.189 0.783 0.229s0.4 0.080 0.644 0.12c0.183 0.035 0.396 0.056 0.613 0.060l0.627 0v12.3h-0.624c-0.255 0.009-0.492 0.075-0.703 0.184-0.289 0.147-0.545 0.32-0.778 0.52-0.261 0.236-0.511 0.456-0.747 0.676-0.27 0.267-0.525 0.547-0.765 0.841-0.303 0.359-0.527 0.619-0.689 0.819s-0.368 0.48-0.616 0.8-0.4 0.52-0.45 0.58q-1.074 1.29-1.504 1.74c-0.54 0.579-0.943 1.293-1.154 2.086q-0.368 1.294-0.608 2.434c-0.091 0.634-0.356 1.194-0.745 1.644-0.113 0.013-0.248 0.022-0.385 0.022-0.834 0-1.585-0.356-2.11-0.924-0.404-0.706-0.64-1.549-0.64-2.447 0-0.125 0.005-0.249 0.014-0.371 0.1-1.128 0.436-2.174 0.957-3.103 0.479-0.844 0.814-1.884 0.916-2.991l-6.862-0.030c-0.681-0.008-1.295-0.29-1.738-0.74-0.466-0.429-0.757-1.040-0.762-1.719 0.023-0.575 0.175-1.109 0.428-1.581z"></path>
            </symbol>
            <symbol viewbox="0 0 36 32" id="ico-send">
                <path fill="#fff" style="fill: var(--color1, #fff)"
                      d="M36.039 0.084c-0.096-0.081-0.221-0.13-0.357-0.13-0.083 0-0.161 0.018-0.231 0.050l-35.137 15.602c-0.185 0.079-0.313 0.259-0.313 0.469 0 0.207 0.123 0.384 0.3 0.464l9.948 4.666c0.069 0.032 0.15 0.051 0.235 0.051 0.121 0 0.233-0.038 0.325-0.102l9.667-6.906-7.59 7.462c-0.095 0.092-0.153 0.22-0.153 0.362 0 0.014 0.001 0.027 0.002 0.041l0.755 9.405c0.020 0.215 0.168 0.391 0.367 0.452 0.054 0.017 0.113 0.027 0.173 0.027 0.162-0 0.308-0.069 0.41-0.179l5.279-5.852 6.524 2.98c0.069 0.033 0.149 0.052 0.234 0.052 0.078 0 0.152-0.016 0.219-0.045 0.138-0.058 0.247-0.173 0.296-0.315l9.196-28.016c0.016-0.047 0.025-0.101 0.025-0.158 0-0.151-0.067-0.287-0.172-0.38z"></path>
            </symbol>
            <symbol viewbox="0 0 22 32" id="ico-lock">
                <path fill="#fff" style="fill: var(--color1, #fff)"
                      d="M19.938 13.596h-15.319v-3.823c0.030-3.546 2.912-6.41 6.463-6.41 3.173 0 5.811 2.286 6.359 5.301 0.144 0.85 0.842 1.46 1.682 1.46 0.938 0 1.699-0.761 1.699-1.699 0-0.098-0.008-0.195-0.024-0.288-0.411-2.334-1.61-4.345-3.308-5.786-1.723-1.467-3.957-2.352-6.397-2.352-5.418 0-9.817 4.364-9.874 9.769l-0 3.986c-0.715 0.247-1.22 0.915-1.22 1.7 0 0.032 0.001 0.064 0.003 0.095l-0 5.468c0 6.118 4.959 11.077 11.077 11.077s11.077-4.959 11.077-11.077v-5.472c-0.049-1.090-0.945-1.956-2.044-1.956-0.061 0-0.12 0.003-0.18 0.008zM13.188 25.548c0.005 0.019 0.007 0.040 0.007 0.062 0 0.149-0.121 0.27-0.27 0.27-0.005 0-0.009-0-0.014-0l-3.615 0c-0.004 0-0.008 0-0.013 0-0.15 0-0.271-0.121-0.271-0.271 0-0.021 0.002-0.042 0.007-0.062l0.579-3.041c-0.443-0.399-0.72-0.975-0.72-1.615 0-1.217 0.987-2.204 2.204-2.204s2.204 0.987 2.204 2.204c-0 0.623-0.263 1.185-0.683 1.581z"></path>
            </symbol>
        </defs>
    </svg>
    <?php //*/ ?>

	<!-- HEADER START -->
    <?= Yii::$app->controller->renderPartial('@layouts/_header'); ?>
	<!-- HEADER STOP -->

	<!-- CONTENT START main -->
	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Begin: Content -->
            <?php echo $content; ?>
			<!-- End: Content -->
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->
	<!-- CONTENT STOP -->

	<div class="scroll-top-btn" style="display: none;">
		<svg class="svg-icon ico-slider-control">
			<use xmlns:xlink="http://www.w3.org/1999/xlink"
			     xlink:href="/themes/fishmen/assets/css/symbols.svg#ico-slider-control"></use>
		</svg>
	</div>
    <?= Yii::$app->controller->renderPartial('@layouts/_footer.php'); ?>
</div>

<script>
	$(document).ready(function () {
		$(".styled").uniform();

		$('.summernote').summernote();
		$('.summernote-height').summernote({
			height: 400
		});

		//обработка изменения поля summernote
		$('body')
			.on('change keyup click', '.note-editor', function (e) {
				var contentSummerNote;
				if ($(this).hasClass('codeview')) {
					contentSummerNote = $(this).find('.note-codable').val();
				} else {
					contentSummerNote = $(this).find('.note-editable').html();
				}
				$(this).siblings('textarea').val(contentSummerNote);
			})
		;

		$('#modal').on('hidden.bs.modal', function () {
			$('#modal .modal-container').empty();
			$('#modal').removeData();
		});
	});

</script>

<script type="text/javascript"
        src="<?= $themePath ?>/vendor/plugins/jqueryContextMenu/dist/jquery.contextMenu.js"></script>

<!-- FancyTree files -->
<script type="text/javascript" src="<?= $themePath ?>/vendor/plugins/fancytree/jquery.fancytree-all.min.js"></script>
<script type="text/javascript"
        src="<?= $themePath ?>/vendor/plugins/fancytree/extensions/jquery.fancytree.childcounter.js"></script>
<script type="text/javascript"
        src="<?= $themePath ?>/vendor/plugins/fancytree/extensions/jquery.fancytree.columnview.js"></script>
<script type="text/javascript"
        src="<?= $themePath ?>/vendor/plugins/fancytree/extensions/jquery.fancytree.dnd.js"></script>
<script type="text/javascript"
        src="<?= $themePath ?>/vendor/plugins/fancytree/extensions/jquery.fancytree.edit.js"></script>
<script type="text/javascript"
        src="<?= $themePath ?>/vendor/plugins/fancytree/extensions/jquery.fancytree.filter.js"></script>
<!-- /FancyTree files -->

<script type="text/javascript"
        src="<?= $themePath ?>/vendor/plugins/serializeJSON/jquery.serializejson.min.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/vendor/plugins/select2/select2.min.js"></script>

<!-- Core JS files -->
<script type="text/javascript" src="<?= $themePath ?>/assets/js/keymaster.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/vendor/plugins/pnotify/pnotify.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/functions.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/vendor/plugins/liTranslit/js/jquery.liTranslit.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/loaders/blockui.min.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/ui/nicescroll.min.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/ui/drilldown.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/editors/summernote/summernote.min.js"></script>
<script type="text/javascript" src="<?= $themePath ?>/assets/js/plugins/forms/editable/editable.min.js"></script>
<!-- /core JS files -->

</body>
</html>