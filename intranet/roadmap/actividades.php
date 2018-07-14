        <span class="list-group-item"><strong>Actividades Pendientes:</strong><ul class="list-group">
        	<div class="panel-group" id="accordion">
        		<div class="panel panel-default">

        			<div class="panel-heading" style="height: 35px;">
        				<h4 class="panel-title">
        					<div class="col-md-8 col-sm-8 col-xs-8">
        						<a data-toggle="collapse" data-parent="#accordion" href="#collapse">ITEM</a>
        					</div>
        					<div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;  padding-top: 4px;">
        						<div class="progress">
        							<div class="progress-bar" role="progressbar" aria-valuenow="80"
        							aria-valuemin="0" aria-valuemax="80" style="width:80%">
        							80%
        						</div>
        					</div>
        				</div>
        			</h4>
        		</div>

        		<div id="collapse" class="panel-collapse collapse">
        			<div>
        				<div class="well" style="max-height: 300px;overflow: auto;">
        					<ul class="list-group checked-list-box">
        						<li class="list-group-item clist" data-checked="true">Llamar a Propietario</li>
        						<li class="list-group-item clist" data-checked="true">Tarea 2</li>
        						<li class="list-group-item clist">Local Alquilado</li>
        					</ul>
        					<span class="clist"><input type="text" class="form-control" placeholder="Nueva Tarea" name="task"></span>
        				</div>
        			</div>
        		</div>  
        	</div>
        </div>
    </ul>
</span>


<?php
require "../sec/libcon.php";
$db = new Db();
$condicion = 1;
$query = "SELECT valor1, valor2, valueorden FROM intranet_roadmap_meta where id = ".$condicion.";"; 
$results = $db->mysql->query($query); 
  
if($results->num_rows) { 
    while($row = $results->fetch_object()) { 
        $title = $row->valor1; 
        $description = $row->valor2; 
        $id = $row->valueorden; 
      
echo '<div class="item">'; 
  
$data = <<<EOD 
<h4> $Title </h4> 
<p> $description </p> 
  
<input type="hidden" name="id" id="id" value="$id" /> 
  
<div class="options"> 
    <a class="deleteEntryAnchor" href="delete.php?id=$id">D</a> 
    <a class="editEntry" href="#">E</a> 
</div> 
EOD; 
          
echo $data; 
echo '</div>'; 
    } // end while 
} else { 
    echo "<p>There are zero items. Add one now!</p>"; 
}



?>
<script type="text/javascript">
$(function () {
    $('.list-group.checked-list-box .list-group-item').each(function () {
        
        // Settings
        var $widget = $(this),
            $checkbox = $('<input type="checkbox" class="hidden" />'),
            color = ($widget.data('color') ? $widget.data('color') : "primary"),
            style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };
            
        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        // Event Handlers
        $widget.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });
          

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $widget.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $widget.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$widget.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $widget.addClass(style + color + ' active');
            } else {
                $widget.removeClass(style + color + ' active');
            }
        }

        // Initialization
        function init() {
            
            if ($widget.data('checked') == true) {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
            }
            
            updateDisplay();

            // Inject the icon if applicable
            if ($widget.find('.state-icon').length == 0) {
                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
        }
        init();
    });
    
    $('#get-checked-data').on('click', function(event) {
        event.preventDefault(); 
        var checkedItems = {}, counter = 0;
        $("#check-list-box li.active").each(function(idx, li) {
            checkedItems[counter] = $(li).text();
            counter++;
        });
        $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
    });
});
</script>