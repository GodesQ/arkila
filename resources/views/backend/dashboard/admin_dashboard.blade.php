@extends('layout.backend-layout.admin') 

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            Dashboard
                            <small>Arkila Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="admin/dashboard"
                                ><i data-feather="home"></i
                            ></a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="bg-warning card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center">
                                    <i
                                        data-feather="navigation"
                                        class="font-warning"
                                    ></i>
                                </div>
                            </div>
                            <div class="media-body col-8">
                                <span class="m-0">Earnings</span>
                                <h3 class="mb-0">
                                    ₱ <span class="counter">{{ $earnings_total }}</span
                                    ><small>Total</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="bg-secondary card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center">
                                    <i
                                        data-feather="box"
                                        class="font-secondary"
                                    ></i>
                                </div>
                            </div>
                            <div class="media-body col-8">
                                <span class="m-0">Products</span>
                                <h3 class="mb-0">
                                    <span class="counter">{{ $products_count }}</span
                                    ><small>Items</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="bg-primary card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center">
                                    <i
                                        data-feather="shopping-cart"
                                        class="font-primary"
                                    ></i>
                                </div>
                            </div>
                            <div class="media-body col-8">
                                <span class="m-0">Carts</span>
                                <h3 class="mb-0">
                                    <span class="counter">{{ $carts_count }}</span
                                    ><small>Items</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="bg-danger card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center">
                                    <i
                                        data-feather="file"
                                        class="font-danger"
                                    ></i>
                                </div>
                            </div>
                            <div class="media-body col-8">
                                <span class="m-0">Orders</span>
                                <h3 class="mb-0">
                                    <span class="counter">{{ $orders_count }}</span
                                    ><small>Items</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-xl-6 xl-100">-->
            <!--    <div class="card">-->
            <!--        <div class="card-header">-->
            <!--            <h5>Market Value</h5>-->
            <!--            <div class="card-header-right">-->
            <!--                <ul class="list-unstyled card-option">-->
            <!--                    <li>-->
            <!--                        <i class="icofont icofont-simple-left"></i>-->
            <!--                    </li>-->
            <!--                    <li><i class="view-html fa fa-code"></i></li>-->
            <!--                    <li>-->
            <!--                        <i-->
            <!--                            class="icofont icofont-maximize full-card"-->
            <!--                        ></i>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <i-->
            <!--                            class="icofont icofont-minus minimize-card"-->
            <!--                        ></i>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <i-->
            <!--                            class="icofont icofont-refresh reload-card"-->
            <!--                        ></i>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <i-->
            <!--                            class="icofont icofont-error close-card"-->
            <!--                        ></i>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="card-body">-->
            <!--            <div class="market-chart"></div>-->
            <!--            <div class="code-box-copy">-->
            <!--                <button-->
            <!--                    class="code-box-copy__btn btn-clipboard"-->
            <!--                    data-clipboard-target="#example-head"-->
            <!--                    title="Copy"-->
            <!--                >-->
            <!--                    <i class="icofont icofont-copy-alt"></i>-->
            <!--                </button>-->
            <!--                <pre><code class="language-html" id="example-head"><!-- Cod Box Copy begin -->
            <!--                <div> class="market-chart"></div>-->
                            <!-- Cod Box Copy end --></code></pre>
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-xl-12 xl-100">
                <div class="card">
                    <div class="card-header">
                        <h5>Latest Orders</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li>
                                    <i class="icofont icofont-simple-left"></i>
                                </li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li>
                                    <i
                                        class="icofont icofont-maximize full-card"
                                    ></i>
                                </li>
                                <li>
                                    <i
                                        class="icofont icofont-minus minimize-card"
                                    ></i>
                                </li>
                                <li>
                                    <i
                                        class="icofont icofont-refresh reload-card"
                                    ></i>
                                </li>
                                <li>
                                    <i
                                        class="icofont icofont-error close-card"
                                    ></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div
                            class="user-status table-responsive latest-order-table"
                        >
                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Order Total</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td class="digits">{{number_format($order->total, 2)}}</td>
                                            <td class="font-danger">
                                                {{$order->payment_type}}
                                            </td>
                                            <td class="digits">{{$order->status}}</td>
                                        </tr>
                                    @empty
                                    <td colspan="4">No Orders Found</td>
                                    @endforelse
                                </tbody>
                            </table>
                            <a href="/checkouts" class="btn btn-primary"
                                >View All Orders</a
                            >
                        </div>
                        <div class="code-box-copy">
                            <button
                                class="code-box-copy__btn btn-clipboard"
                                data-clipboard-target="#example-head1"
                                title=""
                                data-original-title="Copy"
                            >
                                <i class="icofont icofont-copy-alt"></i>
                            </button>
                            <pre
                                class="language-html"
                            ><code class=" language-html" id="example-head1">
                                <div class="user-status table-responsive latest-order-table">
                                    <table class="table table-bordernone">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Order Total</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="digits">$120.00</td>
                                                <td class="font-secondary">Bank Transfers</td>
                                                <td class="digits">Delivered</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="digits">$90.00</td>
                                                <td class="font-secondary">Ewallets</td>
                                                <td class="digits">Delivered</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td class="digits">$240.00</td>
                                                <td class="font-secondary">Cash</td>
                                                <td class="digits">Delivered</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td class="digits">$120.00</td>
                                                <td class="font-primary">Direct Deposit</td>
                                                <td class="digits">Delivered</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td class="digits">$50.00</td>
                                                <td class="font-primary">Bank Transfers</td>
                                                <td class="digits">Delivered</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection