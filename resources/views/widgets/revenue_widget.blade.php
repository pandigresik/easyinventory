<div class="col-sm-12 col-lg-12">
    <div class="card {{ $config['bgcolor'] ?? 'bg-gradient-warning' }}">
        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
                <div class="text-value-lg">9.823</div>
                <div>Members online</div>
            </div>
            <div class="btn-group">
                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="cil-settings"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="margin: 0px;"><a class="dropdown-item"
                        href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item"
                        href="#">Something else here</a></div>
            </div>
        </div>
        <div class="c-chart-wrapper mt-3 mx-3">
            <div class="chartjs-size-monitor">
                {!! $chart->container() !!}    
                {{ $chart->script() }}
            </div>                        
        </div>
    </div>
</div>