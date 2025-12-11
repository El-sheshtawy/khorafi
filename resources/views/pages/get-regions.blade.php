<?php
if (!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2) {
    $name = "name_en";
    $body = "body_en";
} else {
    $name = "name_ar";
    $body = "body_ar";
}
?>
<select class="form-control" name="region">
    <option value="">...</option>
    @foreach($data as $val)
    <option value="{{$val->id}}">{{$val->$name}}</option>
    @endforeach
</select>