<!-- 
  The code file has been adapted from the following sources:
  1. JQuery Range Slider - https://jqueryui.com/slider/#range
  This function loads a jquery slider and adjusts the values of hidden form fields on the index.php page on slider change.
-->
<?php

if(isset($_SESSION["minPrice"]) && isset($_SESSION["maxPrice"])) {
  $min = $_SESSION["minPrice"];
  $max = $_SESSION["maxPrice"];
} else {
  $min = 10000;
  $max = 250000;
}

?>
<!-- Jquery slider dependencies-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
// (1. JQuery Slider) Function to initiate slider
$( function() {
  $("#slider-range").slider({
    range: true,
    min: 10000,
    max: 250000,
    step: 5000,
    values: [<?php echo $min; ?>, <?php echo $max; ?>],
    change: function(event, ui) {
      document.getElementById('min').value = $('#slider-range').slider("values")[0];
      document.getElementById('max').value = $('#slider-range').slider("values")[1];
    },
    slide: function( event, ui ) {
      $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
    }  
  });
  $("#amount").val( "$" + $("#slider-range").slider( "values", 0) +
    " - $" + $("#slider-range").slider("values", 1));
});
// End of (1)
</script>