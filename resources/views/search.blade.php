<form method = 'GET'>
    @if($searchWord != "")
        Showing search results for "<b>{{$searchWord}}</b>".
    @endif
    <div class="input-group" >
        <input type="text" name="search" class="form-control pull-right" placeholder="Search" value='{!!$searchWord!!}'>
        <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>