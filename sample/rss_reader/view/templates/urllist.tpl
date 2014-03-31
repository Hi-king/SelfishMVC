<h1>Feeds</h1>
<ul>
  {for $i=0 to count($feeds)-1}
  <li>
    <a href="http://localhost:8080/selfish/index.php/show/?url={$feeds[$i]->getURL()}">{$feeds[$i]->getPage()->get_title()}</a>
  </li>
  {/for}
  <li>
    <form method="GET" class="form-inline" action="/selfish/index.php/feeds/add/">
      <input type="text" name="url" />
      <input type="hidden" name="name" value="{$uid}" />
      <button type="submit" class="btn">add</button>
    </form>
  </li>
</ul>
