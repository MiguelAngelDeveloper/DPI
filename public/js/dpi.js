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
         const formData = new FormData(event.target);
         event.preventDefault();
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
        url = $(".modalBreakForm").attr('action');
        windowId = formData.get('windowId');
        data = $('#modalBreakForm'+windowId).serializeArray();
        console.log(data);
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
