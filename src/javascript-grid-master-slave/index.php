<?php
$key = "Master / Slave";
$pageTitle = "ag-Grid Master Slave";
$pageDescription = "ag-Grid Sorting";
$pageKeyboards = "ag-Grid Sorting";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2 id="master-slave">Master / Slave</h2>

    <p>
        Grids can be configured such that events that happen in one are propagated to happen in another.
        When this is happening, the grid that is creating the event is called the master, and the grid that
        is consuming the event is called the slave.
    </p>

    <p>
        Using master / slave, you can have two grids have synced columns, such that column changes in
        one grid will be reflected in another grid. This is useful if you have two grids, one above the other,
        and you want the two of them to remain synced with regards their columns.
    </p>

    <h4 id="configuration">Configuration</h4>

    <p>
        To have on grid act as a slave to another, place it's grid options in the 'slaves' array of the first.
    </p>
    <pre><code>gridOptionsSlave = {
    // some grid options here
    };
gridOptionsMaster = {
    // some grid options here
    slaveGrids: [gridOptionsSlave]
}</code></pre>
    <p>It makes a bit more sense in the examples...</p>

    <h4 id="events">Events</h4>
    <p>
        The events which are fired as part of the master slave relationship are as follows:
        <ul>
        <li>Horizontal Scroll</li>
        <li>Column Hidden / Shown</li>
        <li>Column Moved</li>
        <li>Column Group Opened / Closed</li>
        <li>Column Resized</li>
        <li>Column Pinned</li>
    </ul>
    </p>

    <h4 id="event-propagation">Event Propagation</h4>

    <p>
        When a grid fires an event, it will be processed by all the slaves to that grid. However if
        a grid is acting within the context of a slave, it will not fire an event. For example, consider
        the grids A, B and C where B is a slave to A and C is a slave to B (ie A -> B -> C). If
        A gets a column resized, it will fire the event to B, but B will not fire the event to C. If
        C is also dependent on A, it needs to be set up directly. This stops cyclic dependencies
        between grids if two grids are acting as slaves to each other.
    </p>

    <h4 id="pivots">Pivots</h4>

    <p>
        The pivot functionality does not work with Master / Slave grids. This is because pivoting data changes
        the columns, which would make the master and slave grids incompatible, as they are no longer sharing
        the same set of columns.
    </p>
    
    <h4 id="demonstration-example">Demonstration Example</h4>

    <p>
        Below shows two grids acting as master and slave to each other (ie both are registered as slaves
        to the other grid). The following should be noted:
        <ul>
        <li>When either grid is scrolled horizontally, the other grid follows.</li>
        <li>Showing / hiding a column on either grid (via the checkbox) will show / hide the column
        on the other grid, despite the API been called on one grid only.</li>
        <li>When a column is resized on either grid, the other grid follows.</li>
        <li>When a column group is opened on either grid, the other grid follows.</li>
    </ul>
        The grids don't serve much purpose (why would you show the same grid twice???) however
        it demonstrates the features in an easy to understand way.
    </p>

    <show-example example="exampleMasterSlave"></show-example>

    <h4 id="a-wee-more-useful-example">A Wee More Useful Example</h4>

    <p>
        So why the hell would you want to do this anyway??? It's great for aligning grids that have
        different data but similar columns. Maybe you want to include a floating footer with 'summary' data.
        Maybe you have two sets of data, but one is aggregated differently to the other.
    </p>

    <p>
        This example is a bit more useful. In the bottom grid, we show a summary row. Also
        note the following:
        <li>The top grid has no horizontal scroll bar, suppressed via a grid option.</li>
        <li>The bottom grid has no header, suppressed via a grid option.</li>
        <li>sizeColumnsToFit is only called on the top grid, the bottom grid receives the new column widths as the slave.</li>
    </p>

    <show-example example="exampleFloatingFooter"></show-example>

    <h4 id="split-column-groups">Split Column Groups</h4>

    <p>
        It is possible that you have column groups that are split because of pinning or the
        order of the columns. The grid below has only two groups that are split, displayed
        as many split groups. The master/slave also works here in that a change to a split
        group will open / close all the instances of that group in both tables.
    </p>

    <show-example example="exampleMasterSlaveGroups"></show-example>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
