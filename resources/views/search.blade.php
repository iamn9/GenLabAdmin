<form method = 'GET'>    
    <div class="input-group" >
        <input type="text" name="search" class="form-control pull-right" placeholder="Search" value='{!!$searchWord!!}'>
        <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
    </div>
	@if($searchWord != "")
        <br><font face="verdana">Showing search results for "<b>{{$searchWord}}</b>".</font>
    @endif
</form>