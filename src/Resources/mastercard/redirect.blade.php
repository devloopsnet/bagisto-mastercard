<form id="MasterCardPaymentForm" action="{{ $url }}" method="post">
    @foreach($data as $key => $value)
        <input type="hidden" name="{{ str_replace('_','.',$key) }}" value="{{ $value }}">
    @endforeach
</form>
<script type="text/javascript">
    document.getElementById('MasterCardPaymentForm').submit();
</script>
