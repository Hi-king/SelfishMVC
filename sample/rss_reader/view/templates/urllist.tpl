<h1>Feeds</h1>
<ul>
{for $i=0 to count($feeds)-1}
<li>
  <a href="http://localhost:8080/selfish/index.php/show/?url={$feeds[$i]->getURL()}">{$feeds[$i]->getPage()->get_title()}</a>
</li>
{/for}
</ul>
