<!DOCTYPE HTML>
<html lang="kr">
  <head>
    <!-- Force latest IE rendering engine or ChromeFrame if installed -->
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta charset="utf-8">
    <title>Skyseed Admin tool</title>
    <meta name="description" content="hi, we are skyseed!">
    <meta name="viewport" content="width=device-width">
    <?php require_once('parts/import_css.php') ?>
    <style type="text/css">
      .preview {
      margin: 2em;
      }
    </style>

  </head>
  <body>
    <?php require_once ('parts/header.php') ?>
    <div class="container">
      <div class="row">
	<div class="span3 bs-docs-sidebar">
	  <ul class="nav nav-list bs-docs-sidenav affix-top">
	    <li class="active"><a href="slider.php">slider setting</a></li>
	    <li><a href="event.php">event</a></li>
	    <li><a href="#">consult</a></li>
	    <!--<li><a href="#">image upload</a></li>
	    <li><a href="#">image upload</a></li>-->
	  </ul>
	</div>
	<?php //require_once ('parts/navigation.php') ?>  
	<div class="contents span9">
	  <div class="preview">
	    <span class="buttons">
	      <div class="btn-group btn-group-vertical">
		<input id="move-up" class="btn span1" type="button" value="Up" />
		<input id="move-down" class="btn span1" type="button" value="Down" />
	      </div>
	      <div class="btn-group">
		<input id="submit" class="btn btn-primary" type="button" value="submit" />
		<input id="delete" class="btn btn-danger" type="button" value="delete" />
	      </div>
	    </span>
	    <select id="list-box" multiple="multiple" size="5">
	    </select>	
	  </div>
	  <?php require_once ('parts/fileUpload_form.php') ?>
	</div>
      </div>
    </div>
  </body>
  <?php require_once ('parts/fileUpload_templete.php') ?>
  <?php require_once ('parts/import_js.php') ?>
  <script type="text/javascript" charset="utf-8">
    var originalItems;
    
    $(document).ready(function() {
    
    // save the original items, we will need this for Resetting
    originalItems = $("#list-box option");
    
    // assign the click event for the Move Up button
    $("#move-up").click(moveUp);
    
    // assign the click event for the Move Down button
    $("#move-down").click(moveDown);

    // assign the click event for the Move Up button
    $("#submit").click(reorderItems);
    
    // assign the click event for the Move Down button
    $("#delete").click(deleteItem);
    
    refreshItems();
    
    });

    function reorderItems() {
    var order = [];
    var i;
    
    $("#list-box > option").each(function(index){
    order[index] = $(this).attr("value");//$("#list-box option").index(index).val();
    });

    var orderData = [];
    orderData['type'] = 'reorder_items';
    orderData['data'] = order;

    console.log($(orderData));
    $.post("request.php", { 'type': 'reorder_items', 'data[]': order });
    }

    function refreshItems() {
    $.ajax({
    url:'request.php',
    type: 'GET',
    data: "type=load_items",
    processData: false,
    success: function(res){
    var i;
    var json = JSON.parse(res);
    $("#list-box").empty();
    for(i = 0; i < json.length; i++){
		   $("#list-box").append("<option value='" + json[i]['slide_id'] + "'>" + json[i]['name'] + "</option>");
		   }
		   }
		   });
		   }

		   function deleteItem() {
		   var slide_id = $("#list-box option:selected").attr("value");
		   $("#list-box option:selected").remove();
		   $.ajax({
		   url:'request.php',
		   type: 'GET',
		   data: "type=delete_item&slide_id=" + slide_id.toString(),
		   processData: false,
		   success: function(res){
		   refreshItems();
		   alert("delete item successfully.");
		   }
		   });
		   }
		   
		   // Moving up the selected items
		   function moveUp() {
		   // get all selected items and loop through each
		   $("#list-box option:selected").each(function() {
		   var listItem = $(this);
		   var listItemPosition = $("#list-box option").index(listItem) + 1;
		   
		   // when the item is already at the topmost,
		   // we do not need to move it up anymore
		   if (listItemPosition == 1) return false;
		   
		   // the following will move the item up
		   // this inserts the listItem over the element before it
		   listItem.insertBefore(listItem.prev());
		   });
		   }
		   
		   // Moving down the selected items
		   function moveDown() {
		   // get the number of items
		   // we will need this later to determine
		   // if the item is at the bottommost already
		   var itemsCount = $("#list-box option").length;
		   
		   // for move down, we will need to start moving down items
		   //   from the bottom
		   // we get the selected items, reverse it then then loop each item
		   $($("#list-box option:selected").get().reverse()).each(function() {
		   var listItem = $(this);
		   var listItemPosition = $("#list-box option").index(listItem) + 1;
		   
		   // when the item is already at the bottommost,
		   //we do not need to move it down anymore
		   if (listItemPosition == itemsCount) return false;
		   
		   // the following will move down the item
		   // this inserts the listItem below the element after it
		   listItem.insertAfter(listItem.next());
		   });
		   }
		   </script>
</html>
