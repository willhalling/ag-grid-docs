<?php

$pageTitle = "React tutorial: using ag-Grid";
$pageDescription = "React tutorial: using ag-Grid";
$pageKeyboards = "react, ag-Grid, grid, data grid";

include('../includes/mediaHeader.php');
?>

<link inline rel="stylesheet" href="../documentation-main/documentation.css">
<script src="../documentation-main/documentation.js"></script>


<div class="row">
    <div class="col-md-12" style="padding-top: 20px; padding-bottom: 20px;">
        <h1><img src="../images/react_large.png" width="80"/> React datagrid: using ag-Grid tutorial</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-9">

        <h1>Intro</h1>
        <p>
            In this blog post, I am going to explain how to create a React datagrid with ag-Grid.
            Check out the demo to view the end result. We will be working from a React boilerplate so
            we can quickly get to work with building a JavaScript datagrid using ag-Grid.
        </p>
        <p>
            I am going to focus on a subject close to my heart: Leeds United football club. We will replicate the
            features of the notable players table found on
            <a href="https://en.wikipedia.org/wiki/List_of_Leeds_United_F.C._players#Notable_players">Wikipedia</a>.
            And add a new feature, <i>quick filtering</i>, so we can search by keyword.
        </p>

        <p>The following features will be included:</p>

        <ul>
            <li><strong>Cell Rendering</strong>- for the nationality flags</li>
            <li><strong>Filtering</strong>- for columns</li>
            <li><strong>Quick Filtering</strong>- to search by keyword</li>
        </ul>

        <p>This tutorial assumes you have at least, a basic understanding of ReactJS.</p>

        <h2>Theme</h2>

        <pre>&lt;div ag-grid="gridOptions" class="ag-blue"&gt;&lt;/div&gt;</pre>


        <!--
        <p>If you're looking for a JavaScript data grid for your React app, then look no further than ag-Grid.
        ag-Grid is packed with extensive features such as filtering, selection, tree data and cell rendering.</p>
        -->


    </div>

    <div class="col-md-3">

        <div>
            <a href="https://twitter.com/share" class="twitter-share-button"
               data-url="https://www.ag-grid.com/git-color/"
               data-text="Git on the Command Line - Improving the Experience" data-via="seanlandsman"
               data-size="large">Tweet</a>
            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + '://platform.twitter.com/widgets.js';
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, 'script', 'twitter-wjs');</script>
        </div>

        <div style="font-size: 14px; background-color: #dddddd; padding: 15px;">

            <p><img src="../images/will_upd.png" width="100%"/></p>
            <p style="font-weight: bold;">
                Will Halling
            </p>
            <p>
                Will has over ten years experience working with Front End technologies. Will has worked on various
                high-profile projects in the Banking, Travel, Government and Advertisement sectors. He understands
                the importance of developing industry-leading responsive user interfaces.
            </p>
            <p>
                Currently work on ag-Grid full time.
            </p>

            <div>
                <a href="https://twitter.com/willhallinguk" class="twitter-follow-button" data-show-count="false"
                   data-size="large">@willhallinguk</a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + '://platform.twitter.com/widgets.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'twitter-wjs');</script>
            </div>

        </div>

    </div>

</div>

<hr/>

<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'aggrid';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments
        powered by Disqus.</a></noscript>
<hr/>

<footer class="license">
    © ag-Grid Ltd 2015-2016
</footer>

<?php
include('../includes/mediaFooter.php');
?>
