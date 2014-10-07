<!DOCTYPE html>
<html>
<head lang="en">
    <meta name="author" content="I.Sergiichuk">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/static/global/icon/favicon.ico"/>
    <link href="/static/global/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/global/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/static/global/css/theme.css" rel="stylesheet">
    {block name="style"}{/block}
    <title>{$title|capitalize}</title>
</head>
<body>
{block name="header"}
    {include file='header.tpl'}
{/block}
{block name="messages"}
    {include file='messages.tpl'}
{/block}
<div class="container">
    {block name="body"}

    {/block}
</div>
{block name="footer"}
    {include file='footer.tpl'}
{/block}
</body>
<script src="/static/global/js/jquery-1.11.1.min.js"></script>
<script src="/static/global/js/bootstrap.min.js"></script>
{block name="scripts"}{/block}
</html>