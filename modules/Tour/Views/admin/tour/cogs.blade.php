<div class="panel">
    <div class="panel-title"><strong>{{__("COGS")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label">{{__("COGS Package")}}</label>
            <div class="">
                <select id="cogs_id" name="cogs_id" class="form-control">
                    <option value="">{{__("-- Please Select --")}}</option>
                    @foreach($cogs_packages as $key => $val)
                    <option value="{{ $val->id }}" data-harga="{{ $val->hpp->total_hpp }}" @if($val->id == $row->cogs_id) selected @endif>{{ $val->nama_makanan }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $('select#cogs_id').change(function (data) {
        var price = $(this).find(':selected').data('harga');
        $('input#tour_price').val(price);
    });
    $('select#cogs_id').select2();
</script>
@endpush