{extends file="base.tpl"}
{block name="body"}
    <a href="/create_user.php" class="btn btn-block btn-default">Add user</a>
    <h4>Users in system:</h4>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$user_list item=user}
            <tr>
                <td>{$user->getId()|escape}</td>
                <td>{$user->getName()|escape}</td>
                <td>{$user->getEmail()|escape}</td>
                <td>{$user->getPassword()|escape}</td>
                <td><a href="/change_user.php?user_id={$user->getId()}">change</a></td>
                <td><a class="delete_link" href="/delete_user.php?user_id={$user->getId()}">delete</a></td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="6">No items found</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/block}
{block name="scripts"}
    <script>
        $(".delete_link").on('click', function () {
            var answer = confirm("Do you really want to delete this user?");
            if (answer == true) {
                window.location.replace(this.prop("href"));
            }
            return false;
        });
    </script>
{/block}