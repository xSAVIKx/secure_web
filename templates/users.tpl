{extends file="base.tpl"}
{block name="body"}
    <h5>Users in system:</h5>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Password</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$user_list item=user}
            <tr>
                <td>{$user->getId()}</td>
                <td>{$user->getName()}</td>
                <td>{$user->getPassword()}</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="3">No items found</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{/block}