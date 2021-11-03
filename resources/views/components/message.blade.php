<div class="box-msg">
   @if (session()->get('session_empty'))
       <p class="alert alert-danger">{{session('session_empty')}}</p>
   @endif
</div>  