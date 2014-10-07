<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="/index.php" class="navbar-brand">Secure web</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                {if isset($smarty.session.username)}
                    <li><p class="navbar-text">Hello, {$smarty.session.username}</p></li>
                    <li><p class="navbar-text"><a href="/logout.php">logout</a></p></li>
                {/if}
            </ul>
        </div>
    </div>
</nav>