@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
    <button type="button" class="close" data-dismiss="alert"  aria-label="Close">
        <span class="text-white" aria-hidden="true">&times;</span>
      </button>
</div>
@endif
