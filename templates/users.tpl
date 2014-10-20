{extends file="base.tpl"}
{block name="body"}
    <h5>Users in system:</h5>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Password</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$user_list item=user}
            <tr>
                <td>{$user->getId()}</td>
                <td>{$user->getName()}</td>
                <td>{$user->getPassword()}</td>
                {*TODO make valid links*}
                <td><a href="#">change</a></td>
                <td><a href="#">delete</a></td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="5">No items found</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/block}