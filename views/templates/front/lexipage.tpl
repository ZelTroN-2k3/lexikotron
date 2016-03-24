<h1>{$title} {$pagination}</h1>

{include file="$pagination_templates"}

{if $pagination }
    <div class="list-group">
        {foreach from=$filtered_list item=glossary}
            <div class="list-group-item">
                <p class="list-group-item-heading"><b>{$glossary.name}</b></p>
                <p class="list-group-item-text">{$glossary.description}</p>
            </div>
        {/foreach}
    </div>
{else}
    {foreach from=$filtered_list key=k item=v}
        <h2 id="k_{$k}">{$k}</h2>
        <div class="list-group">
            {foreach from=$v item=glossary}
                <div class="list-group-item">
                    <p class="list-group-item-heading"><b>{$glossary.name}</b></p>
                    <p class="list-group-item-text">{$glossary.description|nl2br}</p>
                </div>
            {/foreach}
        </div>
    {/foreach}
{/if}

{include file="$pagination_templates"}