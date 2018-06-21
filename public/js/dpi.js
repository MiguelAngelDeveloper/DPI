$(document).ready(function(){
  //  $('[data-toggle=tooltip]').tooltip();
    $.datepicker.setDefaults($.datepicker.regional['{{ app()->getLocale() }}']);
    $.timepicker.setDefaults($.timepicker.regional['{{ app()->getLocale() }}']);
    /*
    $.datetimepicker.setLocale('{{ app()->getLocale() }}');
      $('#init_date').datetimepicker({
        step: 1
      });
      $('#duration').datetimepicker({
        defaultTime: '00:00',
        datepicker: false,
        format: 'H:i',
        step: 1
      });
      */
      /* attach a submit handler to the form */
      $('.spotSelect').multiSelect();
     $(".modalBreakForm").submit(function(event) {

         /* stop form from submitting normally */
         console.log(event.target);
         event.preventDefault();
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
        url = $(".modalBreakForm").attr('action');
        windowId = $(".modalBreakForm").find('input[name="windowId"]').val();
        event_type = $(".modalBreakForm").find('select[name="event_type"]').val();
        optimal_date = $(".modalBreakForm").find('input[name="optimal_insertion_date"]').val();
        spotSelect = $(".modalBreakForm").find('select[name="spotSelect[]"]').val();
        data = { optimal_insertion_date: optimal_date, windowId: windowId , spotSelect: spotSelect, event_type: event_type }
         $.ajax({
           type: "POST",
           dataType: "json",
           url : url,
           //here we set the data for the post based in our form
           data :  data,
           success:function(data){

               if(data.error === 0 ){ // all was ok
                 newBreak = "<div id=\"break"+data.breakId+"\"><button type=\"button\" class=\"btn btn-primary\">"
                 +"<p>Break Id: "+data.breakId + "</p>"
                 +"<p>Window Id: "+data.windowId + "</p>"
                 +"<p>Optimal Insertion Date: "+data.optimal_insertion_date+"</p>"
                 +"</button></div>"
                 $( "#window"+data.windowId ).append(newBreak);
                 $('#modalScheduling'+data.windowId).modal('hide');
               }else{
                   alert('ERROR:'+data.errormsg);
               }
           },
           timeout:10000
       });

     });

      $('#sch_init_date').datepicker({
        dateFormat: 'yy-mm-dd',
        controlType: 'select',
        oneLine: true
      });
      $('#init_date').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss',
        controlType: 'select',
        oneLine: true
      });
      $('#duration').timepicker();
      $('#duration_ad').timepicker({
        timeFormat: 'HH:mm:ss'
      });
      $('.optimal_insertion_date').timepicker({
        timeFormat: 'HH:mm:ss'
      });
});
