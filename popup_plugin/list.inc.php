<style>
    .list-item {
        display: grid;
        grid-template-columns: 200px 1fr 120px;
        width: 100%;
        background: #fafafa;
        box-sizing: border-box;
        border: solid 1px #ddd;
        padding: 5px;
    }


    .carList {
        width: 100%;
        box-sizing: border-box;
        margin: 0 !important;
        padding: 0 !important;
    }

    .btn {
        padding: 0.4rem 0.5rem;
        background: #000;
        display: inline-block;
        color: #fff !important;
        text-decoration: none !important;
    }

    .btn-list {
        margin-bottom: 10px;
    }
</style>

<h3>Popup List item</h3>



<div class=" btn-list ">
    <a href="<?php echo $SITEURL . $GSADMIN . '/load.php?id=popup_plugin&addnew'; ?>" class="btn btn-add">Add New</a>
</div>


<ul class="col-md-12 carList">

    <li class="list-item">
        <div class="title">
            <b> Name
            </b>
        </div>
        <div class="shortcode">
            <b> Shortcode</b>
        </div>
        <div class="list-btn">
            <b> Buttons
            </b>
        </div>
    </li>


    <?php

    foreach (glob(GSPLUGINPATH . 'popup_plugin/popuplist/*.json') as $item) {

        $name = pathinfo($item)['filename'];

        echo '<li class="list-item">
<div class="title">
<b>' . $name . '</b>
</div>

<div class="shortcode">

<code style="text-align:center;"> <b>Ckeditor:</b> [% popup=' . $name . ' %] <br> <b>Template</b> &#60;?php showPopup("' . $name . '");?&#62;
</code>
</div>

<div class="list-btn">
<a href="' . $SITEURL . $GSADMIN . '/load.php?id=popup_plugin&edit=' . $name . '" class="btn btn-edit">Edit</a>
<a href="' . $SITEURL . $GSADMIN . '/load.php?id=popup_plugin&delete=' . $name . '" onclick="return confirm(`Are you sure you want to delete this item?`);"  class="btn btn-del" style="background:red;">Delete</a>
</div>
</li>';
    }; ?>


</ul>