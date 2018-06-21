<div class="modal fade" id="modalScheduling{{$window->id}}" tabindex="-1" role="dialog" aria-labelledby="modalScheduling{{$window->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('dpi.newScheduling')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form id="modalBreakForm" class="modalBreakForm" action="{{ URL::to('/scheduling/saveBreak') }}" method="POST" autocomplete = "off">
      <div class="modal-body">
        <div class="container">
          <div>
              <h5>Info de la ventana</h5>
            <dl class="dl-horizontal">
              <dt>@lang('dpi.init_date'): </dt>
              <dd>{{$window->init_date}}</dd>
              <dt>@lang('dpi.duration'): </dt>
              <dd>{{$window->duration}}</dd>
            </dl>
            <div class="form-group">
              <label for="optimal_inertion_date" class="title mr-1">@lang('dpi.hoi')</label>
              <input type=text name='optimal_insertion_date' id="optimal_inertion_date">
              <input type=hidden name="windowId" value={{$window->id}}>
            </div>
            <div class="form-group">
              <label for="spotSelect" class="title mr-1">@lang('dpi.ads')</label>
              <select multiple="multiple" class="spotSelect" id="spotSelect" name="spotSelect[]">
                @foreach($spots as $spot)
                    <option value="{{$spot->id}}">{{$spot->name}} [{{ $spot->duration }}]</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('dpi.close')</button>
        <button type="submit" class="btn btn-primary">@lang('dpi.savescheduling')</button>
      </div>
  </form>
    </div>
  </div>
</div>
