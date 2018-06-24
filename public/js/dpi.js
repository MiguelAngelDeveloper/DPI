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
      $('.optimal_insertion_date').timepicker({
        timeFormat: 'HH:mm:ss'
      });
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
                 var newBreak = $("<li>");
                 newBreak.attr("id", "break"+data.breakId);
                 newBreak.addClass("list-group-item");
                 var innerDiv = $("<dl>");
                 innerDiv.addClass('dl-horizontal');
                 var dt1 = $("<dt>");
                 dt1.text(data.str_break_position_in_window);
                 var dt2 = $("<dt>");
                 dt2.text(data.str_optimal_insertion_date);
                 var dt3 = $("<dt>");
                 dt3.text(data.str_ad_pos_in_break);
                 var dt4 = $("<dt>");
                 dt4.text(data.str_ad_name);
                 var dt5 = $("<dt>");
                 dt5.text(data.str_ad_duration);
                 var dd1 = $("<dd>");
                 dd1.text(data.break_position_in_window);
                 var dd2 = $("<dd>");
                 dd2.text(data.optimal_insertion_date);
                 var dd3 = $("<dd>");
                 dd3.text(data.ad_pos_in_break);
                 var dd4 = $("<dd>");
                 dd4.text(data.ad_name);
                 var dd5 = $("<dd>");
                 dd5.text(data.ad_duration);
                 innerDiv.append(dt1);
                 innerDiv.append(dd1);
                 innerDiv.append(dt2);
                 innerDiv.append(dd2);
                 innerDiv.append(dt3);
                 innerDiv.append(dd3);
                 innerDiv.append(dt4);
                 innerDiv.append(dd4);
                 innerDiv.append(dt5);
                 innerDiv.append(dd5);
                 newBreak.append(innerDiv);
/*
                 newBreak = "<div id=\"break"+data.breakId+"\"><button type=\"button\" class=\"btn btn-primary\">"
                 +"<p>Break Id: "+data.breakId + "</p>"
                 +"<p>Window Id: "+data.windowId + "</p>"
                 +"<p>Optimal Insertion Date: "+data.optimal_insertion_date+"</p>"
                 +"</button></div>"
                 */
                 $( "#breaksw"+data.windowId+">ul" ).append(newBreak);
                  $( "#breaksw"+data.windowId).addClass("show");
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
});
