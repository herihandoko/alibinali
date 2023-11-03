@if(auth()->user()->status_profile == 0)
<div class="alert alert-danger alert-block" style="color:#ff0018 !important;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! clean('Informasi') !!}</strong>
    <p>{!! clean('Silahkan lengkapi data diri Anda pada menu Profile untuk mendapatkan Virtual Account Number pembayaran.') !!} <b><a href="{{ route('user.profile.index') }}">Lengkapi</a></b></p>
</div>
@endif