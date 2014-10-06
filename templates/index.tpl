{extends file="base.tpl"}
{block name="body"}
    <form action="" method="get">
        <label for="name">Username</label>
        <input type="text" maxlength=20 name="name"
               id="name" placeholder="username"/><br/>
        <label for="password">Password</label>
        <input type="password" maxlength="16"
               name="password" id="password" placeholder="password"/><br/>
        <input type="submit" value="submit" formaction="login.php"/>
        {*<input type="submit" value="create user" formaction="create_user.php"/>*}
    </form>
    <a href="/lucky.php">I'm lucky</a>
{/block}
{block name="script"}
    <script src="/static/global/js/sha3.js"></script>
    <script src="/static/global/js/jquery-1.11.1.min.js"></script>
    <script>
        $(":submit").click(function () {
            var password = $('#password');
            var hash = CryptoJS.SHA3(password.val(), {outputLength: 256});
            password.val(hash);
            var formaction = $(this).attr("formaction");
            var form = $('form');
            form.get(0).setAttribute('action', formaction);
            form.submit();
        });
    </script>
{/block}