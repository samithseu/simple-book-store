@if (session()->has('success'))
<span class="success-msg" onclick="document.querySelector('.success-msg').style.display='none'">
  {{session()->get('success')}}
</span>
@elseif(session()->has('error'))
<span class="error-msg" onclick="document.querySelector('.error-msg').style.display='none'">
  {{session()->get('error')}}
</span>
@endif
