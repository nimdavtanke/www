<!doctype html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=Content-Type content="text/html;charset=UTF-8">
    <link id="page_favicon" href="/favicon.ico" rel="icon" type="image/x-icon" />
    <meta property="og:title" content="NIMDA Group Ltd. — российская ИТ-компания, владеющая одноимённой системой в Сети и интернет-порталом.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="NIMDA Group Ltd.">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:description" content="NIMDA Group Ltd. — российская ИТ-компания, владеющая одноимённой системой в Сети и интернет-порталом.">

    <title>@yield("title")</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    @yield("assets_header")

</head>
<body>

    @yield("content")

    @yield("assets_footer")

    <nav class="text-center">
        &copy; 2017   <a href="https://nimda.pro"> NIMDA Group Ltd.</a>
    </nav>

</body>
</html>
