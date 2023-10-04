@if(count($errors)>0)
@foreach ($errors->all() as $error)
<p
  style="width: 100%; padding: 1em; text-align: center; color: white; background-color: rgb(184, 0, 0); font-weight: bold; margin-bottom: 1em; border-radius: .5em">
  {{ $error }}
</p>
@endforeach
@endif