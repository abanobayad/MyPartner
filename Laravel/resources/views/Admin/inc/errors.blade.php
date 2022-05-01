@if ($errors->any())
<br>
<ul class=" alert alert-danger list-unstyled mb-2 col-8 m-auto" style="text-align: center">
    @foreach ( $errors->all() as $error )
        <li>{{$error}}</li>
    @endforeach
</ul>
<br>
@endif
