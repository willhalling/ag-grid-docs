<?php
$key = "Column Filter";
$pageTitle = "ag-Grid Filtering";
$pageDescription = "ag-Grid Filtering";
$pageKeyboards = "ag-Grid Filtering";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<p>

    <h2 id="filtering">Column Filter</h2>

    <p>
        Data in ag-Grid can be filtered in the following ways:
        <ol>
            <li><b>Column Filter</b>: A column filter is associated with a column and filters data based
            on the value of that column only. The column filter is accessed via the column's menu and
            may also have a <i>floating filter</i> element if floating filters are turned on.</li>
            <li><a href="../javascript-grid-filter-quick/"><b>Quick Filter</b></a>: The quick filter is a simple text filter that filters across all columns.</li>
            <li><a href="../javascript-grid-filter-external/"><b>External Filter</b></a>: External filters is a way for your application to apply bespoke
            filtering with no restriction to the columns.</li>
        </ol>
        Column filters are tied to a column. Quick filter and external filter
        are not tied to a column. This section of the documentation talks about column filters only.
        For quick filter and external filter, see the relevant sections of the documentation.
    </p>

    <p>
        You have two options for filtering, one is use one of the default built-in filters (easy but restricted to
        what's provided), or bake your own custom filters (no restrictions, build what you want, but takes more time).
    </p>

    <h3 id="enable-filtering">Enable Filtering</h3>

    <p>
        Enable filtering by setting grid property <i>enableFilter=true</i>. This turns on filtering on all columns.
        To turn off filtering for particular columns, set <i>suppressFilter=true</i> on the individual column definition.
    </p>

    <p>
        When a filter is active on a column, the filter icon appears before the column name in the header.
    </p>

<pre>
gridOptions = {
    <span class="codeComment">// turn on filtering</span>
    enableFilter: true,
    ...
    columnDefs = [
        {headerName: "Athlete", field: "athlete", filter: 'text'}, <span class="codeComment">// text filter</span>
        {headerName: "Age",     field: "age",     filter: 'number'}, <span class="codeComment">// number filter</span>
        {headerName: "Sport",   field: "sport",   suppressFilter: true} <span class="codeComment">// NO filter</span>
    ]
}</pre>

    <h3 id="default-built-in-filters">Filter Types</h3>

    <p>
        The following filter options can be set for a column definition:
    </p>

    <table class="table">
        <tr>
            <th>Filter</th>
            <th>Description</th>
        </tr>
        <tr>
            <th>number</th>
            <td>A <a href="../javascript-grid-filter-number/">Number Filter</a> for number comparisons.</td>
        </tr>
        <tr>
            <th>text</th>
            <td>A <a href="../javascript-grid-filter-text/">Text Filter</a> for string comparisons.</td>
        </tr>
        <tr>
            <th>date</th>
            <td>A <a href="../javascript-grid-filter-date/">Date Filter</a> for date comparisons.</td>
        </tr>
        <tr>
            <th>set</th>
            <td>A <a href="../javascript-grid-filter-set/">Set Filter</a>, influenced by how filters work in
                Microsoft Excel. This is an ag-Grid-Enterprise
                feature.</td>
        </tr>
        <tr>
            <th>-custom-</th>
            <td>A <a href="../javascript-grid-filter-component/">Filter Component</a> where you can provide
            you own filter written in a framework of your choice.</td>
        </tr>
    </table>

    <p>
        If no filter type is specified, the default is 'text' for ag-Grid (free versions) and 'set'
        for ag-Grid Enterprise.
    </p>

    <h3 id="filter-parameters">Filter Parameters</h3>

    <p>
        Each filter can take additional filter params by setting <i>colDef.filterParams</i>.
        What parameters each filter type takes is explained in the section on each filter.
        As an example, the following sets parameters for the text filter.
    </p>

    <pre>
columnDefinition = {

    headerName: 'Athlete',
    field: 'athlete'

    <span class="codeComment">// set the column to use text filter</span>
    filter: 'text',

    <span class="codeComment">// pass in additional parameters to the text filter</span>
    filterParams: {apply: true, newRowsAction: 'keep'}
}</pre>

    <h3 id="built-in-filters-example">Built In Filters Example</h3>

    <p>
        The example below demonstrates:
        <ul>
        <li>Three filter types 1) text filter, 2) number filter and 3) date filter.</li>
        <li>Using the <i>ag-header-cell-filtered</i> class, which is applied to the header
            cell when the header is filtered. By default, no style is applied to this class, the example shows
            applying a different color background to this style.</li>
        <li>'suppressFilter' is set on Total to hide the filter on this column</li>
    </ul>
    </p>

    <show-complex-example example="example1.html"
                          sources="{
                                [
                                    { root: './', files: 'example1.html,example1.js' }
                                ]
                              }"
                          plunker="https://embed.plnkr.co/PZ1kJCiQOerXr36cbTZ4/"
                          exampleheight="500px">
    </show-complex-example>


    <h3 id="apply-function">Apply Function</h3>

    <p>
        If you want the user to hit an 'Apply' button before the filter is actioned, add <i>apply=true</i>
        to the filter parameters. The example below shows this in action for the first three columns.
    </p>

    <p>
        This is handy if the filtering operation is taking a long time (usually it doesn't), or if doing
        server side filtering (thus preventing unnecessary calls to the server).
    </p>

    <h3 id="events">Filter Events</h3>

    <p>
        Filtering results in the following events getting emitted:
        <table class="table">
            <tr>
                <th>filterChanged</th>
                <td>
                    Filter has changed, grid also listens for this and updates the model.
                </td>
            </tr>
            <tr>
                <th>beforeFilterChanged</th>
                <td>
                    Filter has changed, grid has not updated.
                </td>
            </tr>
            <tr>
                <th>afterFilterChanged</th>
                <td>
                    Filter has changed, grid has updated.
                </td>
            </tr>
            <tr>
                <th>filterModified</th>
                <td>
                    Gets called when filter has been modified but <i>filterChanged</i>
                    not necessarily called. This is useful when
                    using an apply button inside the filter, as this event fires
                    when the filter is modified, and then <i>filterChanged</i>
                    is fired when the apply button is pressed.
                </td>
            </tr>
        </table>
    </p>

    <h3 id="filter-and-events-example">Example: Apply Button and Filter Events</h3>

    <p>
        The example below also demonstrates using the apply button and filter events as follows:
        <ul>
            <li>onFilterModified gets called when the filter changes regardless of the apply button.</li>
            <li>onBeforeFilterChanged gets called before a new filter is applied.</li>
            <li>onAfterFilterChanged gets called after a new filter is applied.</li>
        </ul>
    </p>

    <show-complex-example example="exampleFilterApply.html"
                          sources="{
                                [
                                    { root: './', files: 'exampleFilterApply.html,exampleFilterApply.js' }
                                ]
                              }"
                          plunker="https://embed.plnkr.co/eIdTwdmysRxmhyOZJFbP/"
                          exampleheight="500px">
    </show-complex-example>

    <h3 id="filtering-animation">Filtering Animation</h3>

    <p>
        To enable animation of the rows after filtering, set grid property <i>animateRows=true</i>.
    </p>

    <h3 id="accessing-filter-component-instances">Accessing Filter Component Instances</h3>

    <p>
        It is possible to access the filter components directly if you want to interact with the specific
        filter. This also works for your own custom filters, where you can
        get a reference to the underlying filtering instance (ie what was created after ag-Grid called 'new'
        on your filter). You get a reference to the filter instance by calling <code>api.getFilterInstance(colKey)</code>.
    </p>
    <pre><span class="codeComment">// Get a reference to the name filter instance</span>
var nameFilterInstance = api.getFilterInstance('name');</pre>
    <p>
        All of the methods in the IFilter interface (described above) are present, assuming the underlying
        filter implements the method. Your custom filters can add their own methods here that ag-Grid will
        not use but your application can use. What these extra methods do is up to you and between your
        customer filter and your application.
    </p>



    <h3>Example Filter API</h3>

    <p>
        The example below shows controlling the country and age filters via the API.
    </p>

    <p>
        The example also shows 'gridApi.destroyFilter(col)' which completely destroys a filter. Use this is if you want
        a filter to be created again with new initialisation values.
    </p>

    <p>
        (Note: the example uses the <a href="../javascript-grid-filter-set/">enterprise set filter</a>).
    </p>

    <show-complex-example example="exampleFilterApi.html"
                          sources="{
                                [
                                    { root: './', files: 'exampleFilterApi.html,exampleFilterApi.js' }
                                ]
                              }"
                          plunker="https://embed.plnkr.co/5EyeTra5sahkg43TnL5L/"
                          exampleheight="500px">
    </show-complex-example>

    <h4 id="reset_filters">Reset Individual Filters</h4>

    <p>You can reset a filter to it's original state by getting the filter instance and then performing the action that makes sense for the filter type.</p>

    <p>For all the filter types the sequence would be:</p>
    <ul>
        <li><code>var filterComponent = gridOptions.api.getFilterInstance('filter_name');</code></li>
        <li>perform reset action for filter type</li>
        <li><code>gridOptions.api.onFilterChanged();</code></li>
    </ul>

    <p>The following are the appropriate methods for the corresponding filter types:</p>
    <table class="table">
        <tr>
            <th>Filter Type</th>
            <th>Action</th>
        </tr>
        <tr>
            <th>number</th>
            <th><code>filterComponent.setFilter(null);</code></th>
        </tr>
        <tr>
            <th>text</th>
            <th><code>filterComponent.setFilter(null);</code></th>
        </tr>
        <tr>
            <th>set</th>
            <th><code>filterComponent.selectEverything();</code></th>
        </tr>
    </table>

    <h4>Reset All Filters</h4>
    <p>You can reset all filters by doing the following:</p>
    <pre>
gridOptions.api.setFilterModel(null);
</pre>

    <h3 id="get_set_filter_model">Get / Set All Filter Models</h3>

    <p>
        It is possible to get and set the state of <b>all</b> the filters via the api methods <i>gridOptions.api.getFilterModel</i>
        and <i>gridOptions.api.setFilterModel</i>. These methods manage the filters states via the <i>getModel</i> and <i>setModel</i>
        methods of the individual filters.
    </p>
    <p>
        This is useful if you want to save the filter state and apply it at a later
        state. It is also useful for server side filtering, where you want to pass the filter state to the
        server.
    </p>

    <h4>Example Get / Set All Filter Models</h4>

    <p>
        The example below shows getting and setting all the filter models in action. The 'save' and 'restore' buttons
        mimic what you would do to save and restore the state of the filters. The big button (Name = 'Mich%'... etc)
        shows how you can hand craft a model and then set that into the filters.
    </p>

    <p>
        (Note: the example uses the <a href="../javascript-grid-filter-set/">enterprise set filter</a>).
    </p>

    <show-complex-example example="exampleFilterModel.html"
                          sources="{
                                [
                                    { root: './', files: 'exampleFilterModel.html,exampleFilterModel.js' }
                                ]
                              }"
                          plunker="https://embed.plnkr.co/KDZENKpqCaPZWq8lNQU5/"
                          exampleheight="500px">
    </show-complex-example>

<h3>Server Side Filtering</h3>

<p>
    Some of the row models
    (<a href="/javascript-grid-pagination/">pagination</a> and
    <a href="/javascript-grid-virtual-paging/">infinite scrolling</a>)
    have further information on how to implement server side filtering.
    For details on this, see the the sections
    <a href="/javascript-grid-pagination/">pagination</a> and
    <a href="/javascript-grid-virtual-paging/">infinite scrolling</a>.
</p>
</div>

<?php include '../documentation-main/documentation_footer.php';?>
