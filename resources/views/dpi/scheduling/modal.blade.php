<div class="modal fade" id="modalScheduling{{$window->id}}" tabindex="-1" role="dialog" aria-labelledby="modalScheduling{{$window->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('dpi.newScheduling')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div>
            <h5>Info de la ventana</h5>
            <div>@lang('dpi.init_date'): {{$window->init_date}}</div>
              <div>@lang('dpi.duration'): {{$window->duration}}</div>
            <label>Hora óptima de inserción</label>
            <input type=text name='optimal_insertion_date' id="optimal_inertion_date">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
