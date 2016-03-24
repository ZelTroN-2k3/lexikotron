{if $alphabet|@count}
    <nav>
        <ul class="pagination">
            {if $pagination }
                {foreach from=$alphabet item=char}
                    {if $char == $current}
                        <li class="active"><a href="#" title="{$char}">{$char}</a></li>
                    {else}
                        <li><a href="{$link->getModuleLink('lexikotron', 'lexipage')}?k={$char}" title="{$char}">{$char}</a></li>
                    {/if}
                {/foreach}
            {else}
                {foreach from=$alphabet item=char}
                    <li><a href="#k_{$char}" title="{$char}">{$char}</a></li>
                {/foreach}
            {/if}
        </ul>
    </nav>
{/if}