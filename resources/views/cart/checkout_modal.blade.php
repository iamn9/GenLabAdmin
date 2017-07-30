<style>
    .modal-dialog {
        position: absolute;
        top: 50px;
        right: 100px;
        bottom: 0;
        left: 100px;
        z-index: 10040;
        overflow: auto;
        overflow-y: auto;
    }
    .modal-content {
        position: relative;
        max-height: 400px;
        max-width: 700px;
        padding: 15px;
    }
</style>
<div id="myModal" class="modal">
  <div class='modal-dialog'>
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Modal Header</h2>
    </div>
    <div class="modal-body">
    <form method = 'GET' action = '/cart/{{$cart_id}}/checkout'>
        <div>
          <label>Select group members: </label>
          <select name="groupmembers[]" class="selectpicker" data-live-search="true" multiple>
              @foreach($students as $student)
                  <option value="{!!$student->id_no!!}">{!!$student->name!!}</option>
              @endforeach
          </select>
        </div>
        <div>
          <label>Select subject: </label>
          <select name="subject" class="selectpicker" data-live-search="true">
              <option value="Bio">Biology</option>
          </select>
        </div>
        <button class="btn btn-success">DONE</button>
    </form>
  </div>
 </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
</div>