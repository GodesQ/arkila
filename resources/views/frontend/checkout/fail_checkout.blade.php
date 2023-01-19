@@extends('layout.frontend-layout.frontend')

@section('content')
<div class="page-body">
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="success-text">
                        <div class="checkmark">
                            Failed
                        </div>
                        <h2>Sorry</h2>
                        <p>Payment is Fail processsed, Please Try Again Submitting Payment.</p>
                        <p class="font-weight-bold">Transaction ID: {{ $data->txnid }}</p>
                        <p class="font-weight-bold">Reference NO: {{ $data->refno }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection